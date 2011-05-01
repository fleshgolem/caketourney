<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
App::import('Controller', 'KOTournaments');
class SwissTournamentsController extends AppController {

	var $name = 'SwissTournaments';
	var $helpers = array('Race');
	function index() {
		$this->SwissTournament->recursive = 0;
		$this->set('swissTournaments', $this->paginate());
	}

	function view($id = null) {
		$current_user = $this->Auth->user('id');
		if (!$id) {
			$this->Session->setFlash(__('Invalid swiss tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		//Check if user is participating
		$this->SwissTournament->bindModel(array('hasOne' => array('UsersTournament')));
		$in_tournament = $this->SwissTournament->find('first',array('conditions'=>array('SwissTournament.id'=>$id,'UsersTournament.user_id'=>$current_user)));
		$this->set('in_tournament', $in_tournament);
		$this->set('tournament', $this->SwissTournament->read(null, $id));
		$this->set('ranking', $this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$id),'order'=>array('Ranking.match_points DESC','Ranking.elo DESC'))));
	}
	function settings($id=null){
		$current_user = $this->Auth->user('id');
		if (!empty($this->data)) {
			if($this->SwissTournament->Ranking->save($this->data))
			{
				$this->Session->setFlash(__('Settings saved', true));
			}
		}
		else {
			$this->data=$this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.user_id'=>$current_user,'Ranking.tournament_id'=>$id)));
		}
	}
	function start($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
			$this->data['SwissTournament']['current_round'] = 0;

			
			if ($this->SwissTournament->save($this->data)) {
				foreach($this->data['User']['User'] as $user)
				{
					$this->SwissTournament->Ranking->create();
					$this->data['Ranking']['tournament_id']=$this->SwissTournament->id;
					$this->data['Ranking']['user_id']=$user;
					$this->data['Ranking']['elo']=1000;
					$this->SwissTournament->Ranking->save($this->data);
				}
				$this->create_rounds($this->data['SwissTournament']['roundnumber'],$this->data['User']['User'],$this->data['SwissTournament']['bestof']);
				$this->Session->setFlash(__('The swiss tournament has been saved', true));
				$this->redirect(array('action' => 'view',$this->SwissTournament->id));
				
			} else {
				$this->Session->setFlash(__('The swiss tournament could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SwissTournament->read(null, $id);
			
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
		//$this->KOTournament->User->bindModel(array('hasMany' => array('Signup' => array('conditions'=>array('Signup.tournament_id'=>$id,'Signup.user_id'=>'User.id')))));
		$users = $this->SwissTournament->User->find('list',$options);
		if (empty($users))
			$users = $this->SwissTournament->User->find('list',array('fields' => array('User.id', 'User.username')));
		
		$this->set(compact('users'));
	}
	
	function finish_round($tournament_id)
	{
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->SwissTournament->id = $tournament_id;
		$current_round = $this->SwissTournament->field('current_round');
		$round = $this->SwissTournament->Round->find('first',array('conditions'=>array('Round.number'=>$current_round,'Round.tournament_id'=>$tournament_id)));
		$round_id=$round['Round']['id'];
		$matches = $this->SwissTournament->Round->Match->findAllByRoundId($round_id);
		foreach ($matches as $match)
		{
			$match_id= $match['Match']['id'];
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
		
		//check if max number of rounds played
		$this->SwissTournament->User->bindModel(array('hasOne' => array('UsersTournament')));
		$players = $this->SwissTournament->User->find('all',array('conditions'=>array('UsersTournament.tournament_id'=>$tournament_id)));
		$current_round++;
		$this->SwissTournament->saveField('current_round',$current_round);
		
		//check if max round reached
		
		$roundnumber = $this->SwissTournament->Round->find('count',array('conditions'=>array('tournament_id'=>$tournament_id)));
		if ($current_round<$roundnumber)
		{
			//Move on to next round
			$this->pair_round($current_round,$tournament_id);
			$this->redirect(array('action' => 'view',$tournament_id));
		}
		else
		{
			//generate playoffs
			$this->redirect(array('action' => 'playoffs',$tournament_id));
		}
	}
	function playoffs($id)
	{
		if (!empty($this->data))
		{
			$KO = new KOTournamentsController;
			$KO->ConstructClasses();
			$seeds=array();
			$ranked_players = $this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$id),'order'=>array('Ranking.match_points DESC','Ranking.elo DESC')));
			for($i=0;$i<$this->data['SwissTournament']['cutoff'];$i++)
			{
				$seeds[$i]=$ranked_players[$i]['Ranking']['user_id'];
			}
			$this->SwissTournament->id=$id;
			$name = $this->SwissTournament->field('name');
			$name .= ' Playoffs';


			$id = $KO->generate_seeded($seeds,$name);
			$this->Session->setFlash(__('Playoffs created', true));
			$this->redirect(array('controller'=>'KOTournaments','action' => 'determine_gamecount',$id));
		}
		if (empty($this->data))
		{
			$this->data=$this->SwissTournament->read(null,$id);
			
		}
	}
	function report_win($match_id,$winner_id,$loser_id,$tournament_id)
	{
		$winner_ranking = $this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$winner_id)));		
		$loser_ranking = $this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$loser_id)));
			
		$winner_elo = $winner_ranking['Ranking']['elo'];
		$loser_elo = $loser_ranking['Ranking']['elo'];
		

		$k = 15;
		$winner_expect = 1/(1+pow(10,($loser_elo-$winner_elo)/400));
		$loser_expect = 1/(1+pow(10,($winner_elo-$loser_elo)/400));
		
		$winner_new_elo = $winner_elo + $k*(1-$winner_expect);
		$loser_new_elo = $loser_elo + $k*(-$loser_expect);
		$this->SwissTournament->Ranking->id=$winner_ranking['Ranking']['id'];

		$this->SwissTournament->Ranking->saveField ('match_points',$winner_ranking['Ranking']['match_points']+2);
		$this->SwissTournament->Ranking->saveField ('elo', $winner_new_elo);
		$this->SwissTournament->Ranking->saveField ('wins',$winner_ranking['Ranking']['wins']+1);

		
		$this->SwissTournament->Ranking->id=$loser_ranking['Ranking']['id'];
		$this->SwissTournament->Ranking->saveField ('elo', $loser_new_elo);
		$this->SwissTournament->Ranking->saveField ('defeats',$loser_ranking['Ranking']['defeats']+1);
	}
	function report_draw($match_id,$player1_id,$player2_id,$tournament_id)
	{
		$player1_ranking = $this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$player1_id)));		
		$player2_ranking = $this->SwissTournament->Ranking->find('first',array('conditions'=>array('Ranking.tournament_id'=>$tournament_id,'Ranking.user_id'=>$player2_id)));
			
		$player1_elo = $player1_ranking['Ranking']['elo'];
		$player2_elo = $player2_ranking['Ranking']['elo'];
		
		$k = 15;
		$player1_expect = 1/(1+pow(10,($player2_elo-$player1_elo)/400));
		$player2_expect = 1/(1+pow(10,($player1_elo-$player2_elo)/400));
		
		$player1_new_elo = $player1_elo + $k*(0.5-$player1_expect);
		$player2_new_elo = $player2_elo + $k*(0.5-$player2_expect);
		
		$this->SwissTournament->Ranking->id=$player1_ranking['Ranking']['id'];
		$this->SwissTournament->Ranking->saveField ('match_points',$player1_ranking['Ranking']['match_points']+1);
		$this->SwissTournament->Ranking->saveField ('elo', $player1_new_elo);
		$this->SwissTournament->Ranking->saveField ('draws',$player1_ranking['Ranking']['draws']+1);
		
		$this->SwissTournament->Ranking->id=$player2_ranking['Ranking']['id'];
		$this->SwissTournament->Ranking->saveField ('match_points',$player2_ranking['Ranking']['match_points']+1);
		$this->SwissTournament->Ranking->saveField ('elo', $player2_new_elo);
		$this->SwissTournament->Ranking->saveField ('draws',$player2_ranking['Ranking']['draws']+1);
	}
	function pair_round($round_number, $tournament_id)
	{
		
		//retrieve players sorted by ranking
		$ranked_players = $this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.away'=>'0','Ranking.tournament_id'=>$tournament_id),'order'=>array('Ranking.match_points DESC','Ranking.elo DESC')));
		$round = $this->SwissTournament->Round->find('first',array('conditions'=>array('Round.number'=>$round_number,'Round.tournament_id'=>$tournament_id)));
		$round_id = $round['Round']['id'];
		//award bye, if odd number of players

		if(count($ranked_players)%2==1)
		{
			for ($i = 0;$i<count($ranked_players);$i++)
			{
				$player_to_bye = $ranked_players[count($ranked_players)-1-$i];
				if($player_to_bye['Ranking']['bye']==0)
				{
					
					unset($ranked_players[count($ranked_players)-1-$i]);
					$matchups = $this->pair_rest($ranked_players,$round_id,$tournament_id);
					if($matchups)
					{
						//Bye and pairings found
						
						//Set bye flag
						$this->SwissTournament->Ranking->id=$player_to_bye['Ranking']['user_id'];
						$this->SwissTournament->Ranking->saveField('bye',1);
						
						//Put bye match in matchups
						$matchup=array();
						$matchup[0]=$player_to_bye['Ranking']['user_id'];
						$matchup[1]=null;
						array_push($matchups,$matchup);
						break;
					}
					else
					{
						//Pairing failed, award bye to someone else and try again
						$ranked_players[$i] =$player_to_bye;
					}
				}
			}
		}
		else
		{
			//even players, no bye, just pair
			$matchups = $this->pair_rest($ranked_players,$round_id,$tournament_id);
		}
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
		//Check if only one opponent is left, try to pair
		if (count($unpaired_players)==1)
		{
			$opponent = array_shift($unpaired_players);
			$match1 = $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$round_id,'Match.player1_id'=>$player_to_pair['Ranking']['user_id'],'player2_id'=>$opponent['Ranking']['user_id'])));
			$match2 = $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$round_id,'Match.player2_id'=>$player_to_pair['Ranking']['user_id'],'player1_id'=>$opponent['Ranking']['user_id'])));
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
				$matchup[0]=$player_to_pair['Ranking']['user_id'];
				$matchup[1]=$opponent['Ranking']['user_id'];
				$matchups[0]=$matchup;
				return $matchups;
			}
		}
		//more than one opponent left
		//find scoregroup
		$score=$player_to_pair['Ranking']['match_points'];
		$scoregroup=$this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.away'=>'0','Ranking.match_points'=>$score,'Ranking.tournament_id'=>$tournament_id,'Ranking.user_id <>'=>$player_to_pair['Ranking']['user_id'])));
		if (count($scoregroup)==0)
		{
			//player floats, find next lower scoregroup
			while($score>=0)
			{
				$score--;
				$scoregroup=$this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.away'=>'0','Ranking.match_points'=>$score,'Ranking.tournament_id'=>$tournament_id)));
				if(count($scoregroup)>0)
				{
					shuffle($scoregroup);
					//find opponent in scoregroup
					foreach($scoregroup as $opponent)
					{			
						//check if match already played or player already paired
						$match1 = $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$round_id,'Match.player1_id'=>$player_to_pair['Ranking']['user_id'],'player2_id'=>$opponent['Ranking']['user_id'])));
						$match2 = $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$round_id,'Match.player2_id'=>$player_to_pair['Ranking']['user_id'],'player1_id'=>$opponent['Ranking']['user_id'])));
						if(!$match1 AND !$match2 AND in_array($opponent,$unpaired_players))
						{
							$opp_key = array_search($opponent,$unpaired_players);
							unset($unpaired_players[$opp_key]);
							$matchups = $this->pair_rest($unpaired_players,$round_id,$tournament_id);
							if ($matchups)
							{
								//pairing successful, pair this match
								$matchup=array();
								$matchup[0]=$player_to_pair['Ranking']['user_id'];
								$matchup[1]=$opponent['Ranking']['user_id'];
								array_push($matchups,$matchup);
								return $matchups;
							}
							else
							{
								$unpaired_players[$opp_key]=$opponent;
							}
						}
						
					}
				}
			}
		}
		shuffle($scoregroup);
		//find opponent in scoregroup
		foreach($scoregroup as $opponent)
		{			
			//check if match already played or player already paired
			$match1 = $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$round_id,'Match.player1_id'=>$player_to_pair['Ranking']['user_id'],'player2_id'=>$opponent['Ranking']['user_id'])));
			$match2 = $this->SwissTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$round_id,'Match.player2_id'=>$player_to_pair['Ranking']['user_id'],'player1_id'=>$opponent['Ranking']['user_id'])));
			if(!$match1 AND !$match2 AND in_array($opponent,$unpaired_players))
			{
				$opp_key = array_search($opponent,$unpaired_players);
				unset($unpaired_players[$opp_key]);
				$matchups = $this->pair_rest($unpaired_players,$round_id,$tournament_id);
				if ($matchups)
				{
					//pairing successful, pair this match
					$matchup=array();
					$matchup[0]=$player_to_pair['Ranking']['user_id'];
					$matchup[1]=$opponent['Ranking']['user_id'];
					array_push($matchups,$matchup);
					return $matchups;
				}
				else
				{
					$unpaired_players[$opp_key]=$opponent;
				}
			}
			
		}
		//All possible pairings failed -> backtrack
		return false;
	}
	
	function create_rounds($roundnumber,$players,$bestof)
	{
		//TODO: How many rounds to play exactly?
		$playernumber = count($players);
		
		
		shuffle($players);
		//Get random matchups for first round
		$matchups = array(array());
		
		for ($i = 0; $i<$playernumber;$i++)
			{
			$matchups[floor($i/2)][$i%2]=$players[$i];
			}
		$Rounds = new RoundsController;
		$Rounds->ConstructClasses();
		
		$Rounds->generate_with_matchups($this->SwissTournament->id,0,count($matchups),$bestof,$matchups);
		//Create further rounds
		for ($i = 1; $i < $roundnumber; $i++)
		{
			$Rounds->generate($this->SwissTournament->id,$i,count($matchups),$bestof);
		}
	}
		

}
?>