<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
class KOTournamentsController extends AppController {
	var $helpers = array('Race','Bracket');
	var $name = 'KOTournaments';
	function report_match($match_id, $player1_score, $player2_score)
	{
		
		//get corresponding tournament
		$match = $this->KOTournament->Round->Match->findById($match_id);
		$round = $this->KOTournament->Round->findById($match['Round']['id']);
		$tournament_id = $round['Tournament']['id'];
		
		//Check if draw was reported
		if ($player1_score == $player2_score)
		{
			//annull result
			$this->KOTournament->Round->Match->id = $match['Match']['id'];
			$this->KOTournament->Round->Match->saveField('player1_score',0);
			$this->KOTournament->Round->Match->saveField('player2_score',0);
			$this->KOTournament->Round->Match->saveField('open',1);
			$this->Session->setFlash(__('Invalid result, no draws in KO Tournaments', true));
			$this->redirect(array('controller' => 'Matches', 'action' => 'view',$match_id));
		}
		if ($player1_score > $player2_score)
		{
			$winner_id = $match['Match']['player1_id'];
		}
		else
		{
			$winner_id = $match['Match']['player2_id'];
		}
		//Advance Winner
		$roundnumber=$match['Round']['number'];
		$nextround=$this->KOTournament->Round->find('first',array('conditions'=>array('Round.number'=>$roundnumber+1,'Round.tournament_id'=>$tournament_id)));
		$nextmatchnumber=floor($match['Match']['number_in_round']/2);
		$nextplayernumber=$match['Match']['number_in_round']%2+1;
		$nextmatch=$this->KOTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextround['Round']['id'],'Match.number_in_round'=>$nextmatchnumber)));
		$this->KOTournament->Round->Match->id=$nextmatch['Match']['id'];
		$this->KOTournament->Round->Match->saveField('player'.$nextplayernumber.'_id',$winner_id);
		$this->redirect(array('controller' => 'KOTournaments', 'action' => 'view',$tournament_id));
	}
		
	function index() {
		$this->redirect(array('controller'=>'tournaments','action' => 'index'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tournament', $this->KOTournament->find('first', array('conditions'=>array('id' => $id), 'recursive' => 3)));
	}

	function start_random($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

			$this->data['KOTournament']['current_round']=0;
			if ($this->KOTournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				//Create first round with random matchups
				shuffle($this->data['User']['User']);
				$playerlist = $this->data['User']['User'];
				$this->create_matchups($playerlist);
				$this->redirect(array('action' => 'determine_gamecount', $this->KOTournament->id));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->KOTournament->read(null, $id);
			
		}
		$options['joins'] = array(
			array('table' => 'signups',
			'alias' => 'Signup',
			'type' => 'LEFT',
			'conditions' => array(
				'User.id = Signup.user_id',
			)));
		$options['conditions'] = array('Signup.tournament_id'=>$id);
		$options['fields'] = array('User.id', 'User.username');
		$users = $this->KOTournament->User->find('list',$options);
		if (empty($users))
			$users = $this->KOTournament->User->find('list',array('fields' => array('User.id', 'User.username')));
		$this->set(compact('users'));
	}
	function start_seeded($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

			$this->data['KOTournament']['current_round']=0;
			if ($this->KOTournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				//Create first round with random matchups
				$this->redirect(array('action' => 'seed', $this->KOTournament->id));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->KOTournament->read(null, $id);
			
		}
		$options['joins'] = array(
			array('table' => 'signups',
			'alias' => 'Signup',
			'type' => 'LEFT',
			'conditions' => array(
				'User.id = Signup.user_id',
			)));
		$options['conditions'] = array('Signup.tournament_id'=>$id);
		$options['fields'] = array('User.id', 'User.username');
		$users = $this->KOTournament->User->find('list',$options);
		if (empty($users))
			$users = $this->KOTournament->User->find('list',array('fields' => array('User.id', 'User.username')));
		$this->set(compact('users'));
	}
	
	function generate_seeded($seeded_players,$name)
	{
		$this->KOTournament->create();
		$this->data['KOTournament']['typeField']='KO';
		$this->data['KOTournament']['typeAlias']=0;
		$this->data['KOTournament']['name']=$name;
		if ($this->KOTournament->save($this->data)) {
			$this->create_matchups($seeded_players);
		}
		return $this->KOTournament->id;
	}
		
	function determine_gamecount($id)
	{
		if (!empty($this->data)) {
			 
			$rounds=$this->KOTournament->Round->findAllByTournamentId($id);
			foreach($rounds as $round)
			{
				$i = $round['Round']['number'];
				foreach($round['Match'] as $match)
				{
					$this->KOTournament->Round->Match->id=$match['id'];
					$this->KOTournament->Round->Match->saveField('games',$this->data['bestof'][$i]);
				}
			}
			$this->redirect(array('action' => 'view', $id));
		}
		if (empty($this->data)) {
			$this->data = $this->KOTournament->read(null, $id);
			
		}
	$this->set('tournament', $this->KOTournament->read(null, $id));
	}
		
	function seed($id = null)
	{
		if (!empty($this->data)) {
			//find possible errors
			if(count($this->data['playerpos'])>count(array_unique($this->data['playerpos'])))
			{
				$this->Session->setFlash(__('Please don\'t enter any position twice', true));
				$this->redirect($this->referer());
			}
			
			$playerlist = array();
			foreach ($this->data['playerpos'] as $i=>$pos)
			{
				if($pos>count($this->data['playerpos']))
				{
					$this->Session->setFlash(__('Maximum position is '.count($this->data['playerpos']), true));
					$this->redirect($this->referer());
				}
				//$player=$this->KOTournament->User->findById($i);
				//$playerlist[$pos-1]=$player['User'];
				$playerlist[$pos-1]=$i;
				
			}
			$this->create_matchups($playerlist);
			$this->redirect(array('action' => 'determine_gamecount', $this->KOTournament->id));
		}
		if (empty($this->data)) {
			$this->data = $this->KOTournament->read(null, $id);
		}
		$this->set('tournament', $this->KOTournament->read(null, $id));
	}	
	function create_matchups ($playerlist)
	{
		$players = count($playerlist);
		$Rounds = new RoundsController;
		$Rounds->ConstructClasses();
		$roundnumber = ceil(log($players,2));
		//Create Matchups

		//Byes first
		$matchups = array(array());
		$cutoff = pow(2,$roundnumber) - $players; 
		for ($i=0; $i< $cutoff;$i++)
		{
			$matchups[$i][0]=$playerlist[$i];
	
			$matchups[$i][1]=null;
		}
		//Regular matches next
		for ($i = 0; $i < $players-$cutoff; $i+=2)
		{
			$matchups[($i/2)+$cutoff][0]=$playerlist[($i/2)+$cutoff];
			$matchups[($i+1)/2+$cutoff][1]=$playerlist[$players-($i/2)-1];
		}
		$Rounds->generate_with_matchups($this->KOTournament->id,0,(pow(2,$roundnumber))/2,1,$matchups);
		//Create further Rounds
		for($i=1;$i<$roundnumber;$i++)
		{
			$Rounds->generate($this->KOTournament->id,$i,(pow(2,($roundnumber-$i)))/2,1);
		}
		
		//Fill Byes for round 2
		if ($cutoff > 0)
		{
			$Matches = new MatchesController;
			$Matches->ConstructClasses();
			$round2 = $this->KOTournament->Round->find('first',array('conditions'=>array('Round.number'=>1,'Round.tournament_id'=>$this->KOTournament->id)));
			
			$matches = $this->KOTournament->Round->Match->find('all',array('conditions'=>array('Match.round_id'=>$round2['Round']['id']),'order'=>array('Match.number_in_round')));
			
			for ($i=0; $i< $cutoff;$i++)
			{
				$match = $matches[floor($i/2)];
				$this->KOTournament->Round->Match->id = $match['Match']['id'];
				$playernumber = $match['Match']['number_in_round']%2+1;
				$this->KOTournament->Round->Match->saveField('player'.(($i%2)+1).'_id',$playerlist[$i]);
				
				
			}
		}
	}
	

}
?>