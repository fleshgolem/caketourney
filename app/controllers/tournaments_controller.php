<?php
App::import('Controller', 'KOTournaments');
class TournamentsController extends AppController {

	var $name = 'Tournaments';
	function beforeFilter()
    {
		$this->Auth->allow('index');
		$this->Auth->allow('view');
		
        parent::beforeFilter();
		
	}
	function report_match($match_id, $player1_score, $player2_score)
	{
		
		//get corresponding tournament
		$match = $this->Tournament->Round->Match->findById($match_id);
		$round = $this->Tournament->Round->findById($match['Round']['id']);
		$tournament_id = $round['Tournament']['id'];
		$tournament = $this->Tournament->findById($tournament_id);
		if($tournament['Tournament']['ranked'])
		{
			$this->update_elo($match['Match']['player1_id'],$match['Match']['player2_id'],$player1_score, $player2_score);
		}
		//pass on to the right controller
		if($tournament['Tournament']['typeAlias']==0)
		{
			$KOTournaments = new KOTournamentsController;
			$KOTournaments->ConstructClasses();
			
			$KOTournaments->report_match($match_id,$player1_score,$player2_score);
		}
	}
	
	function update_elo($player1_id, $player2_id, $player1_score, $player2_score)
	{
		//Get old elo
		$player1 = $this->Tournament->User->findById($player1_id);
		$player2 = $this->Tournament->User->findById($player2_id);
		
		$player1_elo = $player1['User']['elo'];
		$player2_elo = $player2['User']['elo'];
		
		//Set winning coefficient
		if ($player1_score > $player2_score)
		{	
			$r1 = 1;
			$r2 = 0;
		}
		if ($player1_score < $player2_score)
		{	
			$r1 = 0;
			$r2 = 1;
		}
		if ($player1_score == $player2_score)
		{	
			$r1 = 0.5;
			$r2 = 0.5;
		}
		
		//Calculate new elo
		$k = 15;
		$player1_expect = 1/(1+pow(10,($player2_elo-$player1_elo)/400));
		$player2_expect = 1/(1+pow(10,($player1_elo-$player2_elo)/400));
		
		$player1_new_elo = $player1_elo + $k*($r1-$player1_expect);
		$player2_new_elo = $player2_elo + $k*($r2-$player2_expect);
		
		$this->Tournament->User->id = $player1_id;
		$this->Tournament->User->saveField('elo',$player1_new_elo);
		
		$this->Tournament->User->id = $player2_id;
		$this->Tournament->User->saveField('elo',$player2_new_elo);
	}
	function index() {
		$this->Tournament->recursive = 0;
		$this->set('tournaments', $this->paginate());
	}

	function view($id = null) {
		//redirect to right tourney type
		if ($this->Tournament->field('current_round')==-1)
		{
			$this->redirect(array('action' => 'view_signups',$id));
		}
		if ($this->Tournament->field('typeField') == 'KO' OR $this->Tournament->field('typeField') == 'SKO')
		{
			$this->redirect(array('controller'=> 'KOTournaments','action' => 'view',$id));
		}
		if ($this->Tournament->field('typeField') == 'Swiss')
		{
			$this->redirect(array('controller'=> 'SwissTournaments','action' => 'view',$id));
		}
		/*if (!$id) {
			$this->Session->setFlash(__('Invalid tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tournament', $this->Tournament->read(null, $id));*/
	}
	function view_signups($id)
	{
		$this->Tournament->id = $id;
		$this->set('id',$id);
		$this->set('name',$this->Tournament->field('name'));
		$signups = $this->Tournament->Signup->find('all',array('conditions'=>array('tournament_id'=>$id)));
		$this->set('signups',$signups);
		$current_user = $this->Session->read('Auth.User.id');
		$signed_up = $this->Tournament->Signup->find('first',array('conditions'=>array('tournament_id'=>$id,'user_id'=>$current_user)));
		$this->set('signed_up',$signed_up);
	}
	
	function sign_up($id)
	{
		$current_user = $this->Session->read('Auth.User.id');
		$this->Tournament->Signup->create();
		$this->data['Signup']['tournament_id'] = $id;
		$this->data['Signup']['user_id'] = $current_user;
		if ($this->Tournament->Signup->save($this->data))
		{
				$this->Session->setFlash(__('Signed Up', true));
				$this->redirect(array('action' => 'view_signups',$id));
		}
		
	}
	function unsign($id)
	{
		$current_user = $this->Session->read('Auth.User.id');
		$signup = $this->Tournament->Signup->find('first',array('conditions'=>array('tournament_id'=>$id,'user_id'=>$current_user)));
		if ($this->Tournament->Signup->delete($signup['Signup']['id']))
		{
				$this->Session->setFlash(__('Unsigned', true));
				$this->redirect(array('action' => 'view_signups',$id));
		}
		$this->redirect(array('action' => 'index'));
	}
	function start($id)
	{
		$this->Tournament->id=$id;
		if ($this->Tournament->field('typeField') == 'KO' )
		{
			$this->redirect(array('controller'=> 'KOTournaments','action' => 'start_random',$id));
		}
		if($this->Tournament->field('typeField') == 'SKO')
		{
			$this->redirect(array('controller'=> 'KOTournaments','action' => 'start_seeded',$id));
		}
		if ($this->Tournament->field('typeField') == 'Swiss')
		{
			$this->redirect(array('controller'=> 'SwissTournaments','action' => 'start',$id));
		}
		
	}
	function add() {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
		//debug($this->data);
			$this->Tournament->create();
			$this->data['Tournament']['current_round']=-1;
			switch ($this->data['Tournament']['typeAlias']){
				case 0:
					$this->data['Tournament']['typeField']='KO';
					break;
				case 1:
					$this->data['Tournament']['typeField']='SKO';
					break;
				case 2:
					$this->data['Tournament']['typeField']='Swiss';
			}
			
			if ($this->Tournament->save($this->data)) {
				$this->Session->setFlash(__('The tournament has been saved', true));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
		}
		
	}

	function edit($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tournament->save($this->data)) {
				$this->Session->setFlash(__('The tournament has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tournament->read(null, $id);
		}
		$users = $this->Tournament->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tournament', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tournament->delete($id)) {
			$this->Session->setFlash(__('Tournament deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tournament was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>