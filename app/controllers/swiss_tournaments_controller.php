<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
class SwissTournamentsController extends AppController {

	var $name = 'SwissTournaments';

	function index() {
		$this->SwissTournament->recursive = 0;
		$this->set('swissTournaments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid swiss tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('swissTournament', $this->SwissTournament->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SwissTournament->create();
			$this->data['TypeAlias'] = 1;
			$this->data['TypeField'] = 'Swiss';
			$this->data['current_round'] = 0;
			if ($this->SwissTournament->save($this->data)) {
				$this->Session->setFlash(__('The swiss tournament has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The swiss tournament could not be saved. Please, try again.', true));
			}
		}
		$users = $this->SwissTournament->User->find('list');
		$this->set(compact('users'));
	}
	function finish_round($tournament_id, $round_id)
	{
		$matches = $this->SwissTournament->Round->Match->findAllByRound_id($round_id);
		
		foreach ($matches as $match)
		{
			if ($match['Match']['player1_score'] > $match['Match']['player2_score'])
			{
				$this->report_win($match_id,$match['Match']['player1_id'],$match['Match']['player2_id'],$tournament_id);
			}
			if ($match['Match']['player1_score'] < $match['Match']['player2_score'])
			{
				$this->report_win($match_id,$match['Match']['player2_id'],$match['Match']['player1_id'],$tournament_id);
			}
			if ($match['Match']['player1_score'] == $match['Match']['player2_score'])
			{
				$this->report_draw($match_id,$match['Match']['player1_id'],$match['Match']['player2_id'],$tournament_id);
			}
		}
		$this->SwissTournament->id = $tournament_id;
		$current_round = $this->SwissTournament->field('current_round');
		$current_round++;
		$this->SwissTournament->saveField('current_round',$current_round);
		$this->pair_round($current_round,$tournament_id);
	}
	function report_win($match_id,$winner_id,$loser_id,$tournament_id)
	{
		$winner_ranking = $this->Tournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$winner_id)));		
		$loser_ranking = $this->Tournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$loser_id)));
			
		$winner_elo = $winner_ranking['Ranking']['elo'];
		$loser_elo = $loser_ranking['Ranking']['elo'];
		
		//TODO: calculate new elo
		$winner_new_elo =1;
		$loser_new_elo =1;
		
		$this->Tournament->Ranking->id=$winner_ranking['Ranking']['id'];
		$this->Tournament->Ranking->saveField ('match_points',$winner_ranking['Ranking']['match_points']+2);
		$this->Tournament->Ranking->saveField ('elo', $winner_new_elo);
		$this->Tournament->Ranking->saveField ('wins',$winner_ranking['Ranking']['wins']+1);

		
		$this->Tournament->Ranking->id=$loser_ranking['Ranking']['id'];
		$this->Tournament->Ranking->saveField ('elo', $loser_new_elo);
		$this->Tournament->Ranking->saveField ('defeats',$loser_ranking['Ranking']['defeats']+1);
	}
	function report_draw($match_id,$player1_id,$player2_id,$tournament_id)
	{
		$player1_ranking = $this->Tournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$player1_id)));		
		$player2_ranking = $this->Tournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$player2_id)));
			
		$player1_elo = $player1_ranking['Ranking']['elo'];
		$player2_elo = $player2_ranking['Ranking']['elo'];
		
		//TODO: calculate new elo
		$player1_new_elo =1;
		$player2_new_elo =1;
		
		$this->Tournament->Ranking->id=$player1_ranking['Ranking']['id'];
		$this->Tournament->Ranking->saveField ('match_points',$player1_ranking['Ranking']['match_points']+1);
		$this->Tournament->Ranking->saveField ('elo', $player1_new_elo);
		
		$this->Tournament->Ranking->id=$player2_ranking['Ranking']['id'];
		$this->Tournament->Ranking->saveField ('match_points',$player2_ranking['Ranking']['match_points']+1);
		$this->Tournament->Ranking->saveField ('elo', $player2_new_elo);
	}
	function pair_round($round_number, $tournament_id)
	{
		//TODO: retrieve players sorted by ranking
		//$ranked_players=$this->SwissTourne
		$round_id = $round['Round']['id'];

		$matchups = $this->pair_rest($ranked_players,$round_id,$tournament_id);
		
		$round = $this->SwissTournament->Round->find('first',array('conditions'=>array('Round.number'=>$round_number,'Round.tournament_id'=>$tournament_id)));

		//Put players in matches
		foreach ($matchups as $i=>$matchup)
		{
			$match= $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.number_in_round'=>$i,'Match.round_id'=>$round_id)));
			$this->SwissTournament->Round->Match->id = $match['Match']['id'];
			$this->SwissTournament->Round->Match->saveField('player1_id',$matchup[0]);
			$this->SwissTournament->Round->Match->saveField('player2_id',$matchup[1]);
		}
	}
	
	function pair_rest($unpaired_players,$round_id,$tournament_id)
	{
		
		//Get player to pair, remove from array
		$player_to_pair = array_shift($unpaired_players);
		//Check if last player left, award bye if possible, backtrack otherwise
		if (count($unpaired_players)==0)
			{
			$rank=$this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.user_id'=>$player_to_pair['User']['id'],'Ranking.tournament_id'=>$tournament_id)));
			if ($rank['Ranking']['bye'])
			{
				return false;
			}
			else
			{
				//Set bye flag
				$this->SwissTournament->Ranking->id=$rank['Ranking']['id'];
				$this->SwissTournament->Ranking->saveField('bye',1);
				//Put bye match in matchups
				$matchups=array(array());
				$matchup=array();
				$matchup[0]=$player_to_pair['User']['id'];
				$matchup[1]=null;
				array_push($matchups,$matchup);
				return $matchups;
			}
		}
		//Check if only one opponent is left, try to pair
		if (count($unpaired_players)==1)
		{
			$opponent = array_shift($unpaired_players);
			$match1 = $this->SwissTournament->find('first',array('conditions'=>array('round_id'=>$round_id,'player1_id'=>$player_to_pair['User']['id'],'player2_id'=>$opponent['User']['id'])));
			$match2 = $this->SwissTournament->find('first',array('conditions'=>array('round_id'=>$round_id,'player2_id'=>$player_to_pair['User']['id'],'player1_id'=>$opponent['User']['id'])));
			if($match1 OR $match2)
			{
				//Match already played, pairing failed -> backtrack
				return false;
			}
			else
			{
				//Put paired match in matchups, finish pairing
				$matchups=array(array());
				$matchup=array();
				$matchup[0]=$player_to_pair['User']['id'];
				$matchup[1]=$oppoent['User']['id'];
				array_push($matchups,$matchup);
				return $matchups;
			}
		}
		//more than one opponent left
		//find scoregroup
		$rank=$this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.user_id'=>$player_to_pair['User']['id'],'Ranking.tournament_id'=>$tournament_id)));
		$score=$rank['Ranking']['match_points'];
		$scoregroup=$this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.mach_point'=>$score,'Ranking.tournament_id'=>$tournament_id)));
		//TODO:remove self from scoregroup
		if (count($scoregroup)==0)
		{
			//player floats, find next lower scoregroup
			while($score>=0)
			{
				$score--;
				$scoregroup=$this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.mach_point'=>$score,'Ranking.tournament_id'=>$tournament_id)));
				if(count($scoregroup)>0)
				{
					//group found, stop searching
					break;
				}
			}
		}
		shuffle($scoregroup);
		
		//find opponent in scoregroup
		foreach($scoregroup as $rank)
		{
			$opponent = $this->SwissTournament->User->findById($rank['Ranking']['user_id'];
			
			//check if match already played or player already paired
			$match1 = $this->SwissTournament->find('first',array('conditions'=>array('round_id'=>$round_id,'player1_id'=>$player_to_pair['User']['id'],'player2_id'=>$opponent['User']['id'])));
			$match2 = $this->SwissTournament->find('first',array('conditions'=>array('round_id'=>$round_id,'player2_id'=>$player_to_pair['User']['id'],'player1_id'=>$opponent['User']['id'])));
			if(!$match1 AND !$match2 AND in_array($opponent,$unpaired_players))
			{
				//TODO: remove  opp from unpaired players, save key
				$matchups = $this->pair_rest($unpaired_players,$round_id,$tournament_id);
				if ($matchups)
				{
					//pairing successful, pair this match
					$matchup=array();
					$matchup[0]=$player_to_pair['User']['id'];
					$matchup[1]=$opponent['User']['id'];
					array_push($matchups,$matchup);
					return $matchups;
				}
				else
				{
					//TODO:put opp back in array
				}
			}
			
		}
		//All possible pairings failed -> backtrack
		return false;
	}
	
	function create_rounds($players)
	{
		//TODO: How many rounds to play exactly?
		$playernumber = count($players);
		$roundnumber = ceil(log($playernumber,2));
		
		shuffle($players);
		//Get random matchups for first round
		$matchups = array(array());
		
		for ($i = 0; i>$playernumber;$i++)
			{
			$matchups[floor($i/2)][$i%2]=$players[$i];
			}
		$Rounds = new RoundsController;
		$Rounds->ConstructClasses();
		
		$Rounds->generate_with_matchups($this->SwissTournament->id,0,count($matchups),3,$matchups);
		//Create further rounds
		for ($i = 1; $i < $roundnumber; $i++)
		{
			$Rounds->generate($this->SwissTournament->id,0,count($matchups),3);
		}
	}
		
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid swiss tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SwissTournament->save($this->data)) {
				$this->Session->setFlash(__('The swiss tournament has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The swiss tournament could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SwissTournament->read(null, $id);
		}
		$users = $this->SwissTournament->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for swiss tournament', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SwissTournament->delete($id)) {
			$this->Session->setFlash(__('Swiss tournament deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Swiss tournament was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>