<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
App::import('Controller', 'KOTournaments');
class SwissTournamentsController extends AppController {

	var $name = 'SwissTournaments';
	var $helpers = array('Race','FlashChart');
	function beforeFilter()
    {
		$this->Auth->allow('view','score');
        parent::beforeFilter();
		
	}
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
		$tournament = $this->SwissTournament->find('first', array(
							'conditions'=>array('id' => $id),
							'contain'=>array(
								
								'UsersTournament',
								'Round' => array(
											'Match' => array(
													'Player1' => array(
															'fields' => array('id', 'username', 'race')
													),
													'Player2' => array(
															'fields' => array('id', 'username', 'race')
													)
											)
											
											)
								)
							));
		//debug($tournament);
		$this->set('in_tournament', $in_tournament);
		$this->set('tournament', $tournament);
		
	}
	
	function extended_view($id = null) {
		$current_user = $this->Auth->user('id');
		if (!$id) {
			$this->Session->setFlash(__('Invalid swiss tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->layout = 'extended_view';
		//Check if user is participating
		$this->SwissTournament->bindModel(array('hasOne' => array('UsersTournament')));
		$in_tournament = $this->SwissTournament->find('first',array('conditions'=>array('SwissTournament.id'=>$id,'UsersTournament.user_id'=>$current_user)));
		$tournament = $this->SwissTournament->find('first', array(
							'conditions'=>array('id' => $id),
							'contain'=>array(
								
								'UsersTournament',
								'Round' => array(
											'Match' => array(
													'Player1' => array(
															'fields' => array('id', 'username', 'race')
													),
													'Player2' => array(
															'fields' => array('id', 'username', 'race')
													)
											)
											
											)
								)
							));
		//debug($tournament);
		$this->set('in_tournament', $in_tournament);
		$this->set('tournament', $tournament);
		
	}
	
	function statistics($tournament_id = null) {
		
		$tournament = $this->SwissTournament->find('first', array(
							'conditions'=>array('id' => $tournament_id),
							'contain'=>array(
								
								'UsersTournament',
								'Round' => array(
											'Match' => array(
													'Player1' => array(
															'fields' => array('id', 'username', 'race')
													),
													'Player2' => array(
															'fields' => array('id', 'username', 'race')
													)
											)
											
											)
								)
							));
		$current_user = $this->Auth->user('id');
		$number_matches=0;
		$TvP_array = array(); //0=total;win;loss;draw
		$TvP_array[0]=0;
		$TvP_array[1]=0;
		$TvP_array[2]=0;
		$TvP_array[3]=0;
		$PvZ_array = array(); //0=total;win;loss;draw
		$PvZ_array[0]=0;
		$PvZ_array[1]=0;
		$PvZ_array[2]=0;
		$PvZ_array[3]=0;
		$ZvT_array = array(); //0=total;win;loss;draw
		$ZvT_array[0]=0;
		$ZvT_array[1]=0;
		$ZvT_array[2]=0;
		$ZvT_array[3]=0;
		$RvT_array = array(); //0=total;win;loss;draw
		$RvT_array[0]=0;
		$RvT_array[1]=0;
		$RvT_array[2]=0;
		$RvT_array[3]=0;
		$RvP_array = array(); //0=total;win;loss;draw
		$RvP_array[0]=0;
		$RvP_array[1]=0;
		$RvP_array[2]=0;
		$RvP_array[3]=0;
		$RvZ_array = array(); //0=total;win;loss;draw
		$RvZ_array[0]=0;
		$RvZ_array[1]=0;
		$RvZ_array[2]=0;
		$RvZ_array[3]=0;
		
		$this->set('tournament',$tournament );
		foreach ($tournament['Round'] as $round){
            foreach ($round['Match'] as $match){
					if($match['open']==0){
					//debug(count($match['Player2']));
					if(count($match['Player2'])!=0&&count($match['Player1'])!=0){
						$number_matches++;
						//TvP array with player 1 as Terran
						if($match['Player1']['race']==0 && $match['Player2']['race']==1){
							
							$TvP_array[0]+=1;
							if($match['player1_score']>$match['player2_score']){
								
								$TvP_array[1]+=1;
							}
							if($match['player2_score']>$match['player1_score']){
								
								$TvP_array[2]+=1;
							}
							if($match['player2_score']==$match['player1_score']){
								
								$TvP_array[3]+=1;
							}
						}
						//TvP array with player 2 as Terran
						if($match['Player2']['race']==0 && $match['Player1']['race']==1){
							
							$TvP_array[0]+=1;
							if($match['player2_score']>$match['player1_score']){
								
								$TvP_array[1]+=1;
							}
							if($match['player1_score']>$match['player2_score']){
								
								$TvP_array[2]+=1;
							}
							if($match['player1_score']==$match['player2_score']){
								
								$TvP_array[3]+=1;
							}
						}
						//PvZ array with player 1 as Protoss
						if($match['Player1']['race']==1 && $match['Player2']['race']==2){
							
							$PvZ_array[0]+=1;
							if($match['player1_score']>$match['player2_score']){
								
								$PvZ_array[1]+=1;
							}
							if($match['player2_score']>$match['player1_score']){
								
								$PvZ_array[2]+=1;
							}
							if($match['player2_score']==$match['player1_score']){
								
								$PvZ_array[3]+=1;
							}
						}
						//PvZ array with player 2 as Protoss
						if($match['Player2']['race']==1 && $match['Player1']['race']==2){
							
							$PvZ_array[0]+=1;
							if($match['player2_score']>$match['player1_score']){
								
								$PvZ_array[1]+=1;
							}
							if($match['player1_score']>$match['player2_score']){
								
								$PvZ_array[2]+=1;
							}
							if($match['player1_score']==$match['player2_score']){
								
								$PvZ_array[3]+=1;
							}
						}
						//ZvT array with player 1 as zerg
						if($match['Player1']['race']==2 && $match['Player2']['race']==0){
							
							$ZvT_array[0]+=1;
							if($match['player1_score']>$match['player2_score']){
								
								$ZvT_array[1]+=1;
							}
							if($match['player2_score']>$match['player1_score']){
								
								$ZvT_array[2]+=1;
							}
							if($match['player2_score']==$match['player1_score']){
								
								$ZvT_array[3]+=1;
							}
						}
						//ZvT array with player 2 as zerg
						if($match['Player2']['race']==2 && $match['Player1']['race']==0){
							
							$ZvT_array[0]+=1;
							if($match['player2_score']>$match['player1_score']){
								
								$ZvT_array[1]+=1;
							}
							if($match['player1_score']>$match['player2_score']){
								
								$ZvT_array[2]+=1;
							}
							if($match['player1_score']==$match['player2_score']){
								
								$ZvT_array[3]+=1;
							}
						}
						
						//RvT array with player 1 as Random
						if($match['Player1']['race']==3 && $match['Player2']['race']==0){
							
							$RvT_array[0]+=1;
							if($match['player1_score']>$match['player2_score']){
								
								$RvT_array[1]+=1;
							}
							if($match['player2_score']>$match['player1_score']){
								
								$RvT_array[2]+=1;
							}
							if($match['player2_score']==$match['player1_score']){
								
								$RvT_array[3]+=1;
							}
						}
						//RvT array with player 2 as Random
						if($match['Player2']['race']==3 && $match['Player1']['race']==0){
							
							$RvT_array[0]+=1;
							if($match['player2_score']>$match['player1_score']){
								
								$RvT_array[1]+=1;
							}
							if($match['player1_score']>$match['player2_score']){
								
								$RvT_array[2]+=1;
							}
							if($match['player1_score']==$match['player2_score']){
								
								$RvT_array[3]+=1;
							}
						}
						//RvP array with player 1 as Random
						if($match['Player1']['race']==3 && $match['Player2']['race']==1){
							
							$RvP_array[0]+=1;
							if($match['player1_score']>$match['player2_score']){
								
								$RvP_array[1]+=1;
							}
							if($match['player2_score']>$match['player1_score']){
								
								$RvP_array[2]+=1;
							}
							if($match['player2_score']==$match['player1_score']){
								
								$RvP_array[3]+=1;
							}
						}
						//RvP array with player 2 as Random
						if($match['Player2']['race']==3 && $match['Player1']['race']==1){
							
							$RvP_array[0]+=1;
							if($match['player2_score']>$match['player1_score']){
								
								$RvP_array[1]+=1;
							}
							if($match['player1_score']>$match['player2_score']){
								
								$RvP_array[2]+=1;
							}
							if($match['player1_score']==$match['player2_score']){
								
								$RvP_array[3]+=1;
							}
						}
						//RvZ array with player 1 as Random
						if($match['Player1']['race']==3 && $match['Player2']['race']==2){
							
							$RvZ_array[0]+=1;
							if($match['player1_score']>$match['player2_score']){
								
								$RvZ_array[1]+=1;
							}
							if($match['player2_score']>$match['player1_score']){
								
								$RvZ_array[2]+=1;
							}
							if($match['player2_score']==$match['player1_score']){
								
								$RvZ_array[3]+=1;
							}
						}
						//RvZ array with player 2 as Random
						if($match['Player2']['race']==3 && $match['Player1']['race']==2){
							
							$RvZ_array[0]+=1;
							if($match['player2_score']>$match['player1_score']){
								
								$RvZ_array[1]+=1;
							}
							if($match['player1_score']>$match['player2_score']){
								
								$RvZ_array[2]+=1;
							}
							if($match['player1_score']==$match['player2_score']){
								
								$RvZ_array[3]+=1;
							}
						}
						
					}
					}
				
								
				
			}
		} 
		
		$this->set('TvP_array', $TvP_array);
		$this->set('PvZ_array', $PvZ_array);
		$this->set('ZvT_array', $ZvT_array);
		$this->set('RvT_array', $RvT_array);
		$this->set('RvP_array', $RvP_array);
		$this->set('RvZ_array', $RvZ_array);
		
		/*debug ($TvP_array);
		debug ($PvZ_array);
		debug ($ZvT_array);
		debug ($RvT_array);
		debug ($RvP_array);
		debug ($RvZ_array);*/
		
	}
	
	function score($id = null) {
		$current_user = $this->Auth->user('id');
		if (!$id) {
			$this->Session->setFlash(__('Invalid swiss tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		//Check if user is participating
		$this->SwissTournament->bindModel(array('hasOne' => array('UsersTournament')));
		$in_tournament = $this->SwissTournament->find('first',array('conditions'=>array('SwissTournament.id'=>$id,'UsersTournament.user_id'=>$current_user)));
		$this->set('in_tournament', $in_tournament);
		$tournament = $this->SwissTournament->find('first', array(
							'conditions'=>array('id' => $id),
							'contain'=>array(
								
								'UsersTournament',
								'Round' => array(
											'Match' => array(
													'Player1' => array(
															'fields' => array('id', 'username', 'race')
													),
													'Player2' => array(
															'fields' => array('id', 'username', 'race')
													)
											)
											
											)
								)
							));
		$this->set('tournament', $tournament);
		$this->set('ranking', $this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$id),'order'=>array('Ranking.match_points DESC','Ranking.oppscore DESC', 'Ranking.oppoppscore DESC'))));
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
	
	function player_settings($id=null)
	{
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if($this->SwissTournament->Ranking->saveAll($this->data['Ranking']))
			{
				$this->Session->setFlash(__('Settings saved', true));
				$this->redirect(array('action'=>'view',$this->data['SwissTournament']['id']));
			}
		}
		else {
			$rankings = $this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$id)));
			$this->set('rankings',$rankings);
			
		}
	$this->set('id',$id);
	$this->data=$this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$id)));

	}
	function start($id) {
		
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			//debug($this->data['User']);
			if ( $this->data['SwissTournament']['roundnumber']>count($this->data['User']['User']))
			{
				$this->Session->setFlash(__('Too many rounds for a swiss tournament. The maximum number of rounds for '.count($this->data['User']['User']).' player is '.(count($this->data['User']['User'])-1), true));
				$this->redirect(array('controller'=> 'Tournaments','action' => 'view',$id));
			}
			
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
		$options['order'] = array('User.username asc');
		//$this->KOTournament->User->bindModel(array('hasMany' => array('Signup' => array('conditions'=>array('Signup.tournament_id'=>$id,'Signup.user_id'=>'User.id')))));
		$users = $this->SwissTournament->User->find('list',$options);
		if (empty($users))
			$users = $this->SwissTournament->User->find('list',array('fields' => array('User.id', 'User.username'),'order' => array('User.username asc')));
		
		$this->set(compact('users'));
	}
	
	
	function pre_start($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			debug(array($this->SwissTournament->id,$this->data['SwissTournament']['signup_mod']));
			
			$this->redirect(array('action' => 'start', array($this->SwissTournament->id,$this->data['SwissTournament']['signup_mod'])));

			
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
		$options['order'] = array('User.username asc');
		//$this->KOTournament->User->bindModel(array('hasMany' => array('Signup' => array('conditions'=>array('Signup.tournament_id'=>$id,'Signup.user_id'=>'User.id')))));
		$users = $this->SwissTournament->User->find('list',$options);
		//if (empty($users))
		//	$users = $this->SwissTournament->User->find('list',array('fields' => array('User.id', 'User.username'),'order' => array('User.username asc')));
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
		
		//Calculate tiebreakers

		$this->calculate_oppscore($tournament_id);

		$this->calculate_oppoppscore($tournament_id);

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
	function calculate_oppscore($tournament_id)
	{
		$rankings = $this->SwissTournament->Ranking->findAllByTournamentId($tournament_id);
		foreach ($rankings as $ranking)
		{
			//find matches with player as player1
			$score = 0;
			$options['joins'] = array(
											array('table' => 'rounds',
											'alias' => 'Round1',
											'type' => 'LEFT',
											'conditions' => array(
												'Round1.id = Match.round_id',
											)));
											
			$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player1_id'=>$ranking['User']['id'],'Match.open'=>0);
			$options['recursive'] =0;
			$matches = $this->SwissTournament->Round->Match->find('all',$options);
			foreach($matches as $match)
			{
				$player2 = $match['Match']['player2_id'];
				$rank = $this->SwissTournament->Ranking->find('first',array('recursive'=>0, 'conditions'=>array('user_id'=>$player2, 'tournament_id'=>$tournament_id)));
				$score += $rank['Ranking']['match_points'];
			}
			
			//find matches with player as player2
			$options['joins'] = array(
											array('table' => 'rounds',
											'alias' => 'Round1',
											'type' => 'LEFT',
											'conditions' => array(
												'Round1.id = Match.round_id',
											)));
											
			$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player2_id'=>$ranking['User']['id'],'Match.open'=>0);
			$options['recursive'] =0;
			$matches = $this->SwissTournament->Round->Match->find('all',$options);
			foreach($matches as $match)
			{
				$player1 = $match['Match']['player1_id'];
				$rank = $this->SwissTournament->Ranking->find('first',array('recursive'=>0, 'conditions'=>array('user_id'=>$player1, 'tournament_id'=>$tournament_id)));
				$score += $rank['Ranking']['match_points'];
			}
			
			//Save oppscore
			$this->SwissTournament->Ranking->id = $ranking['Ranking']['id'];
			$this->SwissTournament->Ranking->saveField('oppscore', $score);
		}
	}
	function calculate_oppoppscore($tournament_id)
	{
		$rankings = $this->SwissTournament->Ranking->findAllByTournamentId($tournament_id);
		foreach ($rankings as $ranking)
		{
			//find matches with player as player1
			$score = 0;
			$options['joins'] = array(
											array('table' => 'rounds',
											'alias' => 'Round1',
											'type' => 'LEFT',
											'conditions' => array(
												'Round1.id = Match.round_id',
											)));
											
			$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player1_id'=>$ranking['User']['id'],'Match.open'=>0);
			$options['recursive'] =0;
			$matches = $this->SwissTournament->Round->Match->find('all',$options);
			foreach($matches as $match)
			{
				$player2 = $match['Match']['player2_id'];
				$rank = $this->SwissTournament->Ranking->find('first',array('recursive'=>0, 'conditions'=>array('user_id'=>$player2, 'tournament_id'=>$tournament_id)));
				$score += $rank['Ranking']['oppscore'];
			}
			
			//find matches with player as player2
			$options['joins'] = array(
											array('table' => 'rounds',
											'alias' => 'Round1',
											'type' => 'LEFT',
											'conditions' => array(
												'Round1.id = Match.round_id',
											)));
											
			$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player2_id'=>$ranking['User']['id'],'Match.open'=>0);
			$options['recursive'] =0;
			$matches = $this->SwissTournament->Round->Match->find('all',$options);
			foreach($matches as $match)
			{
				$player1 = $match['Match']['player1_id'];
				$rank = $this->SwissTournament->Ranking->find('first',array('recursive'=>0, 'conditions'=>array('user_id'=>$player1, 'tournament_id'=>$tournament_id)));
				$score += $rank['Ranking']['oppscore'];
			}
			
			//Save oppscore
			$this->SwissTournament->Ranking->id = $ranking['Ranking']['id'];
			$this->SwissTournament->Ranking->saveField('oppoppscore', $score);
		}
	}
	function playoffs($id)
	{
		if (!empty($this->data))
		{
			$KO = new KOTournamentsController;
			$KO->ConstructClasses();
			$seeds=array();
			$ranked_players = $this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$id),'order'=>array('Ranking.match_points DESC','Ranking.oppscore DESC', 'Ranking.oppoppscore DESC')));
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
				debug('a');
				$score--;
				$scoregroup=$this->SwissTournament->Ranking->find('all',array('conditions'=>array('Ranking.away'=>'0','Ranking.match_points'=>$score,'Ranking.tournament_id'=>$tournament_id)));
				if(count($scoregroup)>0)
				{
					debug('b');
					shuffle($scoregroup);
					//find opponent in scoregroup
					foreach($scoregroup as $opponent)
					{			
						//check if match already played or player already paired
						$options['joins'] = array(
										array('table' => 'rounds',
										'alias' => 'Round1',
										'type' => 'LEFT',
										'conditions' => array(
											'Round1.id = Match.round_id',
										)));
										
						$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player1_id'=>$player_to_pair['Ranking']['user_id'],'player2_id'=>$opponent['Ranking']['user_id']);
						$match1 = $this->SwissTournament->Round->Match->find('first',$options);
						$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player2_id'=>$player_to_pair['Ranking']['user_id'],'player1_id'=>$opponent['Ranking']['user_id']);
						$match2 = $this->SwissTournament->Round->Match->find('first',$options);
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
			$options['joins'] = array(
							array('table' => 'rounds',
							'alias' => 'Round1',
							'type' => 'LEFT',
							'conditions' => array(
								'Round1.id = Match.round_id',
							)));
							
			$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player1_id'=>$player_to_pair['Ranking']['user_id'],'player2_id'=>$opponent['Ranking']['user_id']);
			$match1 = $this->SwissTournament->Round->Match->find('first',$options);
			$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player2_id'=>$player_to_pair['Ranking']['user_id'],'player1_id'=>$opponent['Ranking']['user_id']);
			$match2 = $this->SwissTournament->Round->Match->find('first',$options);
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
		//All possible pairings failed ->  find next lower scoregroup
		
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
					$options['joins'] = array(
									array('table' => 'rounds',
									'alias' => 'Round1',
									'type' => 'LEFT',
									'conditions' => array(
										'Round1.id = Match.round_id',
									)));
									
					$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player1_id'=>$player_to_pair['Ranking']['user_id'],'player2_id'=>$opponent['Ranking']['user_id']);
					$match1 = $this->SwissTournament->Round->Match->find('first',$options);
					$options['conditions'] = array('Round1.tournament_id'=>$tournament_id,'Match.player2_id'=>$player_to_pair['Ranking']['user_id'],'player1_id'=>$opponent['Ranking']['user_id']);
					$match2 = $this->SwissTournament->Round->Match->find('first',$options);
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