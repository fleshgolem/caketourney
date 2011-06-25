<?php
class InvitationsController extends AppController {

	var $name = 'Invitations';
	
	function index ()
	{
		$invitations = $this->Invitation->findAllByUserId($this->Auth->user('id'));
		$this->set('invitations',$invitations);
	}
	
	function accept ($id = null)
	{
		$invitation = $this->Invitation->read(null, $id);
		$this->Invitation->Team->id =  $invitation['Invitation']['team_id'];
		$team_type = $this->Invitation->Team->field('team_type');
		$team = $this->Invitation->Team->read(null,$invitation['Invitation']['team_id']);
		$teamsize = count($team['User']);
		if(($team_type == '2v2' && $teamsize >= 2) || ($team_type == '3v3' && $teamsize >= 3)|| ($team_type == '4v4' && $teamsize >= 4))
		{
			$this->Session->setFlash(__('Team is full', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if(!$invitation['Invitation']['user_id'] == $this->Auth->user('id'))
		{
			$this->Session->setFlash('Access denied');
			$this->redirect(array('action'=>'index'));
			
		}
		$this->Invitation->Team->bindModel(array('hasMany'=>array('UsersTeams')));
		$this->Invitation->Team->UsersTeams->create();
		$this->data['UsersTeams']['team_id'] =  $invitation['Invitation']['team_id'];
		$this->data['UsersTeams']['user_id'] = $invitation['Invitation']['user_id'];
		$this->Invitation->delete();
		if($this->Invitation->Team->UsersTeams->save ($this->data))
		{
			$this->Session->setFlash('Invitation accepted!');
			$this->redirect(array('controller'=>'teams','action'=>'view', $this->data['UsersTeams']['team_id']));
		}
		$this->redirect(array('action'=>'index'));
		
	}
	
	function decline ($id = null)
	{
		$this->Invitation->delete();
	}
}
?>