<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
class KOTournamentsController extends AppController {
	var $helpers = array('Race');
	var $name = 'KOTournaments';
	function report_match($match_id, $player1_score, $player2_score)
	{
		
		//get corresponding tournament
		$match = $this->KOTournament->Round->Match->findById($match_id);
		$tournament_id = $match['Round']['Tournament']['id'];
		$tournament = $this->KOTournament->findById($tournament_id);
		
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
		$this->set('tournament', $this->KOTournament->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->KOTournament->create();
			$this->data['KOTournament']['typeField']='KO';
			$this->data['KOTournament']['typeAlias']=0;
			debug($this->data);
			if ($this->KOTournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			//Create first round with random matchups
			
			shuffle($this->data['User']['User']);
			$players = count($this->data['User']['User']);
			
			$Rounds = new RoundsController;
			$Rounds->ConstructClasses();
			$roundnumber = ceil(log($players,2));
			//Create Matchups
			
			//Byes first
			$matchups = array(array());
			$cutoff = pow(2,$roundnumber) - $players; 
			for ($i=0; $i< $cutoff;$i++)
			{
				$matchups[$i][0]=$this->data['User']['User'][$i];
				$matchups[$i][1]=null;
			}
			//Regular matches next
			for ($i = 0; $i < $players-$cutoff; $i++)
			{
				$matchups[floor($i/2)+$cutoff][$i%2]=$this->data['User']['User'][$i+$cutoff];
			}

			$Rounds->generate_with_matchups($this->KOTournament->id,0,(pow(2,$roundnumber))/2,3,$matchups);
			//Create further Rounds
			for($i=1;$i<$roundnumber;$i++)
			{
				$Rounds->generate($this->KOTournament->id,$i,(pow(2,($roundnumber-$i)))/2,3);
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
					$this->KOTournament->Round->Match->saveField('player'.(($i%2)+1).'_id',$this->data['User']['User'][$i]);
					
					
				}
			}
			$this->redirect(array('action' => 'view', $this->KOTournament->id));
		}
		$users = $this->KOTournament->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
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