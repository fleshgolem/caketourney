<?php
class SettingsController extends AppController {

	var $name = 'Settings';
	var $helpers = array('Text','Bbcode');
	var $paginate = array(
		'limit' => 20,
        
	);
	function beforeFilter()
    {
		
        parent::beforeFilter();
		
	}
	
	function index() {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('controller' => 'news','action'=>'index'));
		}
		$this->Settings->recursive = 1;
		$this->set('Settings', $this->paginate());
	}

	

	function add() {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('controller' => 'news','action'=>'index'));
		}
		
		if (!empty($this->data)) {
			$this->Setting->create();
			$date = date_create('now');
			
			$this->data['Setting']['created']= $date->format('Y-m-d H:i:s');
			if ($this->Setting->save($this->data)) {
				$this->Session->setFlash(__('The setting has been created', true));
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be created. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('controller' => 'news','action'=>'index'));
		}
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid setting', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Setting->saveField('pair',$this->data['Setting']['pair'])) {
				
				$date = date_create('now');
				$this->Setting->saveField('modified',$date->format('Y-m-d H:i:s'));
				$this->Session->setFlash(__('The setting has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, $id);
		}
	}

	
}
?>