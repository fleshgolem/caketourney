<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Race');
 
    /**
     * Runs automatically before the controller action is called
     */
    function beforeFilter()
    {
        $this->Auth->allow('register');
        parent::beforeFilter();
		
		}
 
    /**
     * Registration page for new users
     */
    function register()
    {
        if (!empty($this->data)) {
            $this->User->create();
			//Set admin flag if no admin in system yet
			if (!$this->User->findByAdmin())
			{
				$this->data['User']['admin']=1;
			}
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('Your account has been created.', true));
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Your account could not be created.', true));
            }
        }
    }
 
   /**
     * Ran directly after the Auth component has executed
     */
    function login()
    {
        // Check for a successful login
        if (!empty($this->data) && $id = $this->Auth->user('id')) {
 
            // Set the lastlogin time
            $fields = array('lastlogin' => date('Y-m-d H:i:s'), 'modified' => false);
            $this->User->id = $id;
            $this->User->save($fields, false, array('lastlogin'));
 
            // Redirect the user
            $url = array('controller' => 'users', 'action' => 'account');
            //if ($this->Session->check('Auth.redirect')) {
            //    $url = $this->Session->read('Auth.redirect');
            //}
			$this->User->id = $this->Auth->user('id');
 
			// Load the user (avoid populating $this->data)
			$current_user = $this->User->findById($id);
			$this->Session->write('current_user', $current_user);
            $this->redirect($url);
        }
    }
 
	function account()
    {
		// Set User's ID in model which is needed for validation
        $this->User->id = $this->Auth->user('id');
 
        // Load the user (avoid populating $this->data)
        $current_user = $this->User->findById($this->User->id);
		$this->set('current_user', $current_user);
        $this->User->useValidationRules('ChangePassword');
        $this->User->validate['password_confirm']['compare']['rule'] =
            array('password_match', 'password', false);
 
        $this->User->set($this->data);
		
		if (!empty($this->data) && empty($this->data['User']['password'] )) {
           
			$this->User->saveField('bnetaccount', $this->data['User']['bnetaccount']);
			$this->User->saveField('bnetcode', $this->data['User']['bnetcode']);
			$this->User->saveField('race', $this->data['User']['race']);
            $this->Session->setFlash('Your data has been updated');
            $this->redirect(array('controller'=>'tournaments' , 'action' => 'index'));
        }
		
        if (!empty($this->data) && $this->User->validates()) {
            $password = $this->Auth->password($this->data['User']['password']);
            $this->User->saveField('password', $password);
			$this->User->saveField('bnetaccount', $this->data['User']['bnetaccount']);
			$this->User->saveField('bnetcode', $this->data['User']['bnetcode']);
			$this->User->saveField('race', $this->data['User']['race']);
            $this->Session->setFlash('Your data has been updated');
            $this->redirect(array('controller'=>'tournaments' , 'action' => 'index'));
        }
    }
    /**
     * Log a user out
     */
    function logout()
    {
		$this->Session->delete('current_user');
       return $this->redirect($this->Auth->logout());
    }
	function index() {
		
		$this->User->id = $this->Auth->user('id');
 
        // Load the user (avoid populating $this->data)
        $current_user = $this->User->findById($this->User->id);
		
		$this->User->recursive = 0;
		
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function open_matches()
	{
		$id = $this->Auth->user('id');
		
		$matches = $this->User->Match->find('all',array('recursive'=>2,'conditions'=>array('Match.open'=>1,'OR'=>array('Match.player1_id'=>$id,'Match.player2_id'=>$id))));
		$this->set('matches',$matches);
	}

	function edit($id = null) {
		
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$success = 1;
			foreach ($this->data['User'] as $key=>$field)
				{
				if (!$this->User->saveField($key,$field)) $success=0;
				}
			if ($success) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>