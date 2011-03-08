<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
class KOTournamentsController extends AppController {

	var $name = 'KOTournaments';
	function index() {
		$this->redirect(array('controller'=>'tournaments','action' => 'index'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tournament', $this->Tournament->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->KOTournament->create();
			if ($this->KOTournament->save($this->data)) {
				$this->Session->setFlash(__('The tournament has been saved', true));
				
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
			//Create Rounds
			
			$Rounds = new RoundsController;
			$Rounds->ConstructClasses();
			$Matches = new MatchesController;
				$Matches->ConstructClasses();
			$players = count($this->data['User']['User']);
			$roundnumber = ceil(log($players,2));
			debug($players);
			for($i=0;$i<$roundnumber;$i++)
			{
				$Rounds->generate($this->KOTournament->id,$i,2^($roundnumber-$i),3);
				
				$games_per_match = 3;				
				
				//$id is number of last round, compensate here
				
			}
			$id = $Rounds->Round->getLastInsertId();
			//Generate Matches
			for($i=0;$i<$roundnumber;$i++)
			{
				$matchcount = (pow(2,$roundnumber-$i))/2;
				debug("a");

				for ($j = 0; $j<$matchcount ; $j++)
				{

					debug($id-$roundnumber+$i+1);
					//$Matches->generate($id-$j,$j,$games_per_match);
				}
			}
			//$this->redirect(array('controller'=> 'tournaments','action' => 'index'));
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