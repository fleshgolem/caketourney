<?php
class TeamsController extends AppController {

	var $name = 'Teams';

	function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}
	
	function statistics($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('team', $this->Team->read(null, $id));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('team', $this->Team->read(null, $id));
		$this->Team->bindModel(array('hasMany'=>array('UsersTeams')));
		$in_team =$this->Team->UsersTeams->find('count',array('conditions'=>array('user_id'=>$this->Auth->user('id'),'team_id'=>$id)));
		$this->set('in_team',$in_team);
		$members = $this->Team->find('all', array(
							'conditions'=>array('Team.id'=>$id),
							'contain'=>array(
								
								'User'=> array('fields' => array('id', 'username', 'race', 'elo', 'division')),
								'Leader'=> array('fields' => array('id', 'username', 'race', 'elo', 'division')),
								
								)
							));
		
		$this->set('members',$members);
		
		
		
		
	}
	
	function leave($id)
	{
		$this->Team->id = $id;
		$leader_id = $this->Team->field('leader_id');
		if($leader_id == $this->Auth->user('id'))
		{
			$this->Session->setFlash(__('Cannot leave as teamleader', true));
			$this->redirect(array('action' => 'view', $id));
		}
		$this->Team->bindModel(array('hasMany'=>array('UsersTeams')));
		$UTentry =$this->Team->UsersTeams->find('first',array('conditions'=>array('user_id'=>$this->Auth->user('id'),'team_id'=>$id)));
		if ($UTentry)
		{
			$this->Team->UsersTeams->id = $UTentry['UsersTeams']['id'];
			$this->Team->UsersTeams->delete();
			$this->redirect(array('action' => 'view', $id));
		}
		else
		{
			$this->Session->setFlash(__('Not part of this team', true));
			$this->redirect(array('action' => 'view', $id));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Team->create();
			$date = date_create('now');
			$this->data['Team']['date_created'] =$date->format('Y-m-d H:i:s');
			$this->data['Team']['leader_id'] = $this->Auth->user('id');
			$this->data['User']['id'] = $this->Auth->user('id');
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		$leaders = $this->Team->Leader->find('list');
		$users = $this->Team->User->find('list');
		$this->set(compact('leaders', 'users'));
	}
	function kick_member($team_id, $user_id)
	{
		$this->Team->id = $team_id;
		$leader_id = $this->Team->field('leader_id');
		if($leader_id == $user_id)
		{
			$this->Session->setFlash(__('Cannot kick leader', true));
			$this->redirect(array('action' => 'view', $team_id));
		}
		$this->Team->bindModel(array('hasMany'=>array('UsersTeams')));
		$UTentry =$this->Team->UsersTeams->find('first',array('conditions'=>array('user_id'=>$user_id,'team_id'=>$team_id)));
		$this->Team->UsersTeams->id = $UTentry['UsersTeams']['id'];
		$this->Team->UsersTeams->delete();
		$this->redirect(array('action' => 'view', $team_id));

	}
	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		$team = $this->Team->read(null, $id);
		if (!$this->Session->read('Auth.User.admin') || !$team['Team']['leader_id']==$this->Auth->user('id'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Team->read(null, $id);
		}

		$this->Team->Leader->bindModel(array('hasOne'=>array('UsersTeams')));
		$leaders = $this->Team->Leader->find('list',array('recursive'=>0,'conditions'=>array('UsersTeams.team_id'=>$id)));
		$users = $this->Team->User->find('list');
		$this->set(compact('leaders', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$team = $this->Team->read(null, $id);
		if (!$this->Session->read('Auth.User.admin') || !$team['Team']['leader_id']==$this->Auth->user('id'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Team->delete($id)) {
			$this->Session->setFlash(__('Team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function manage ($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$team = $this->Team->read(null, $id);
		if (!$this->Session->read('Auth.User.admin') || !$team['Team']['leader_id']==$this->Auth->user('id'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data))
		{
			$team_type = $this->Team->field('team_type');
			$team = $this->Team->read(null,$id);
			$teamsize = count($team['User']);

			if(($team_type == '2v2' && $teamsize >= 2) || ($team_type == '3v3' && $teamsize >= 3)|| ($team_type == '4v4' && $teamsize >= 4))
			{
				$this->Session->setFlash(__('Team is full', true));
				$this->redirect(array('action'=>'view',$id));
			}
			$this->Team->Invitation->create();
			$this->data['Invitation']['team_id'] = $id;
			if ($this->Team->Invitation->save($this->data))
			{
				$this->Session->setFlash(__('Player invited', true));
			}
		}
		$this->set('team_id',$id);
		$users = $this->Team->User->find('list',array('order'=>'User.username ASC'));
		$this->Team->User->bindModel(array('hasOne' => array('UsersTeams')));
		$members = $this->Team->User->find('all',array('conditions'=>array('UsersTeams.team_id'=>$id)));
		$this->set(compact('users'));
		$this->set('members',$members);
		$this->data=$this->Team->read(null,$id);
	}
	
	function invite ($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$team = $this->Team->read(null, $id);
		if (!$this->Session->read('Auth.User.admin') || !$team['Team']['leader_id']==$this->Auth->user('id'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data))
		{
			$team_type = $this->Team->field('team_type');
			$team = $this->Team->read(null,$id);
			$teamsize = count($team['User']);

			if(($team_type == '2v2' && $teamsize >= 2) || ($team_type == '3v3' && $teamsize >= 3)|| ($team_type == '4v4' && $teamsize >= 4))
			{
				$this->Session->setFlash(__('Team is full', true));
				$this->redirect(array('action'=>'view',$id));
			}
			$this->Team->Invitation->create();
			$this->data['Invitation']['team_id'] = $id;
			if ($this->Team->Invitation->save($this->data))
			{
				$this->Session->setFlash(__('Player invited', true));
				$this->redirect(array('action'=>'view',$id));
			}
		}
		$this->set('team_id',$id);
		$users = $this->Team->User->find('list',array('order'=>'User.username ASC'));
		$this->Team->User->bindModel(array('hasOne' => array('UsersTeams')));
		$members = $this->Team->User->find('all',array('conditions'=>array('UsersTeams.team_id'=>$id)));
		$this->set(compact('users'));
		$this->set('members',$members);
		$this->data=$this->Team->read(null,$id);
	}
	
	function my_teams ()
	{
		$this->Team->bindModel(array('hasOne'=>array('UsersTeams')));
		$my_teams =$this->Team->find('all',array('conditions'=>array('UsersTeams.user_id'=>$this->Auth->user('id'))));
		$this->set('my_teams',$my_teams);
	}
	
	function upload_logo($team_id)
	{	
		// Set User's ID in model which is needed for validation
        //$this->User->id = $this->Auth->user('id');
		
        // Load the user (avoid populating $this->data)
        //$current_user = $this->User->findById($this->User->id);
		if (!$team_id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		$team = $this->Team->read(null, $team_id);
		
		if (!$this->Session->read('Auth.User.admin') || !$team['Team']['leader_id']==$this->Auth->user('id'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
           	//debug($this->data);
			/*$this->User->saveField('avatar_name', $this->data['User']['file']['name']);
			$this->User->saveField('avatar_type', $this->data['User']['file']['type']);
			$this->User->saveField('avatar_size', $this->data['User']['file']['size']);*/

			if ($this->Team->save($this->data,false))
				$this->Session->setFlash('Your teamlogo has been updated');
            else
				$this->Session->setFlash('Invalid File');
			

            $this->redirect(array('controller' => 'teams', 'action' => 'view',$team_id ));
        }
		
		if (empty($this->data))
		{
			$this->data = $this->Team->read(null, $team_id);
		}
	}
}
?>