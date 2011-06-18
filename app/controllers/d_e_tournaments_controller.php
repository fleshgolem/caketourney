<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
class DETournamentsController extends AppController {
	var $helpers = array('Race','Bracket','FlashChart');
	var $name = 'DETournaments';
	function beforeFilter()
    {
		$this->Auth->allow('view');
        parent::beforeFilter();
		
	}
	
	function statistics($tournament_id = null) {
		$tournament=$this->DETournament->find('first', array('conditions'=>array('id' => $tournament_id), 'recursive' => 3));
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
		/*
		debug ($TvP_array);
		debug ($PvZ_array);
		debug ($ZvT_array);
		debug ($RvT_array);
		debug ($RvP_array);
		debug ($RvZ_array);
		*/
		
	}
	
	
	function report_match($match_id, $player1_score, $player2_score)
	{
		
		//get corresponding tournament
		$match = $this->DETournament->Round->Match->findById($match_id);
		$round = $this->DETournament->Round->findById($match['Round']['id']);
		$tournament_id = $round['Tournament']['id'];
		
		//Check if draw was reported
		if ($player1_score == $player2_score)
		{
			//annull result
			$this->DETournament->Round->Match->id = $match['Match']['id'];
			$this->DETournament->Round->Match->saveField('player1_score',0);
			$this->DETournament->Round->Match->saveField('player2_score',0);
			$this->DETournament->Round->Match->saveField('open',1);
			$this->Session->setFlash(__('Invalid result, no draws in Double Elimination Tournaments', true));
			$this->redirect(array('controller' => 'Matches', 'action' => 'view',$match_id));
		}
		if ($player1_score > $player2_score)
		{
			$winner_id = $match['Match']['player1_id'];
			$looser_id = $match['Match']['player2_id'];
		}
		else
		{
			$winner_id = $match['Match']['player2_id'];
			$looser_id = $match['Match']['player1_id'];
		}
		//Advance Winner
		$roundnumber=$match['Round']['number'];
		
			$nextround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>$roundnumber+1,'Round.tournament_id'=>$tournament_id)));
			$nextnextround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>$roundnumber+2,'Round.tournament_id'=>$tournament_id)));
			
			if(!empty($nextround))
			{
				if($roundnumber==0){
					$nextlooserround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>(-1),'Round.tournament_id'=>$tournament_id)));
					//special case for first round!!! TODO
					$nextmatchnumber=floor($match['Match']['number_in_round']/2);
					$nextplayernumber=$match['Match']['number_in_round']%2+1;
					$nextmatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextround['Round']['id'],'Match.number_in_round'=>$nextmatchnumber)));
					//debug($nextmatch);
					$this->DETournament->Round->Match->id=$nextmatch['Match']['id'];
					$this->DETournament->Round->Match->saveField('player'.$nextplayernumber.'_id',$winner_id);
					
					
					$nextloosermatchnumber=floor($match['Match']['number_in_round']/2);
					$nextlooserplayernumber=$match['Match']['number_in_round']%2+1;
					$nextloosermatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextlooserround['Round']['id'],'Match.number_in_round'=>$nextloosermatchnumber)));
					//debug($nextloosermatch);
					$this->DETournament->Round->Match->id=$nextloosermatch['Match']['id'];
					$this->DETournament->Round->Match->saveField('player'.$nextlooserplayernumber.'_id',$looser_id);
					
					
				}
				if($roundnumber>0){
					if(!empty($nextnextround)){
						//for all but the final game
						$nextlooserround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>(-(($roundnumber)*2)),'Round.tournament_id'=>$tournament_id)));
						//usual case for upper bracket
						$nextmatchnumber=floor($match['Match']['number_in_round']/2);
						$nextplayernumber=$match['Match']['number_in_round']%2+1;
						$nextmatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextround['Round']['id'],'Match.number_in_round'=>$nextmatchnumber)));
						
						$this->DETournament->Round->Match->id=$nextmatch['Match']['id'];
						$this->DETournament->Round->Match->saveField('player'.$nextplayernumber.'_id',$winner_id);
						
											
						$nextloosermatchnumber=floor($match['Match']['number_in_round']);
						$nextlooserplayernumber=2;
						$nextloosermatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextlooserround['Round']['id'],'Match.number_in_round'=>$nextloosermatchnumber)));
						//debug($nextloosermatch);
						$this->DETournament->Round->Match->id=$nextloosermatch['Match']['id'];
						$this->DETournament->Round->Match->saveField('player'.$nextlooserplayernumber.'_id',$looser_id);
					}
					else{
						//final game
						$nextmatchnumber=floor($match['Match']['number_in_round']);
						$nextplayernumber=1;
						$nextmatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextround['Round']['id'],'Match.number_in_round'=>$nextmatchnumber)));
						
						$this->DETournament->Round->Match->id=$nextmatch['Match']['id'];
						$this->DETournament->Round->Match->saveField('player'.$nextplayernumber.'_id',$winner_id);
						
						//looser final
						
						$nextlooserround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>(-(($roundnumber)*2)),'Round.tournament_id'=>$tournament_id)));
						$nextloosermatchnumber=floor($match['Match']['number_in_round']);
						$nextlooserplayernumber=2;
						$nextloosermatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextlooserround['Round']['id'],'Match.number_in_round'=>$nextloosermatchnumber)));
						//debug($nextloosermatch);
						$this->DETournament->Round->Match->id=$nextloosermatch['Match']['id'];
						$this->DETournament->Round->Match->saveField('player'.$nextlooserplayernumber.'_id',$looser_id);
					}
				
					
				}
				if($roundnumber<0){
					$nextlooserround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>((($roundnumber)-1)),'Round.tournament_id'=>$tournament_id)));
					if(!empty($nextlooserround)){
						if($roundnumber%2==0){
							
							$nextloosermatchnumber=floor($match['Match']['number_in_round']/2);
							$nextlooserplayernumber=$match['Match']['number_in_round']%2+1;
							$nextloosermatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextlooserround['Round']['id'],'Match.number_in_round'=>$nextloosermatchnumber)));
							//debug($nextloosermatch);
							$this->DETournament->Round->Match->id=$nextloosermatch['Match']['id'];
							$this->DETournament->Round->Match->saveField('player'.$nextlooserplayernumber.'_id',$winner_id);
						}
						if($roundnumber%2==-1){
							
							$nextloosermatchnumber=floor($match['Match']['number_in_round']);
							$nextlooserplayernumber=1;
							$nextloosermatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextlooserround['Round']['id'],'Match.number_in_round'=>$nextloosermatchnumber)));
							
							$this->DETournament->Round->Match->id=$nextloosermatch['Match']['id'];
							$this->DETournament->Round->Match->saveField('player'.$nextlooserplayernumber.'_id',$winner_id);
						}
					}
					else{
						//final game
						$nextround=$this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>((-$roundnumber)/2)+1,'Round.tournament_id'=>$tournament_id)));
						$nextmatchnumber=floor($match['Match']['number_in_round']);
						$nextplayernumber=2;
						$nextmatch=$this->DETournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextround['Round']['id'],'Match.number_in_round'=>$nextmatchnumber)));
						
						$this->DETournament->Round->Match->id=$nextmatch['Match']['id'];
						$this->DETournament->Round->Match->saveField('player'.$nextplayernumber.'_id',$winner_id);
					}
				}
			}
			$this->redirect(array('controller' => 'DETournaments', 'action' => 'view',$tournament_id));
		
		
	}
		
	function index() {
		$this->redirect(array('controller'=>'tournaments','action' => 'index'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tournament', $this->DETournament->find('first', array('conditions'=>array('id' => $id), 'recursive' => 3)));
	}

	function start_random($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

			$this->data['DETournament']['current_round']=0;
			if ($this->DETournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				//Create first round with random matchups
				shuffle($this->data['User']['User']);
				$playerlist = $this->data['User']['User'];
				$this->create_matchups($playerlist);
				$this->redirect(array('action' => 'determine_gamecount', $this->DETournament->id));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->DETournament->read(null, $id);
			
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
		$users = $this->DETournament->User->find('list',$options);
		if (empty($users))
			$users = $this->DETournament->User->find('list',array('fields' => array('User.id', 'User.username')));
		$this->set(compact('users'));
	}
	function start_seeded($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

			$this->data['DETournament']['current_round']=0;
			if ($this->DETournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				//Create first round with random matchups
				$this->redirect(array('action' => 'seed', $this->DETournament->id));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->DETournament->read(null, $id);
			
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
		$users = $this->DETournament->User->find('list',$options);
		if (empty($users))
			$users = $this->DETournament->User->find('list',array('fields' => array('User.id', 'User.username')));
		$this->set(compact('users'));
	}
	
	function generate_seeded($seeded_players,$name)
	{
		$this->DETournament->create();
		$this->data['DETournament']['typeField']='DE';
		$this->data['DETournament']['typeAlias']=0;
		$this->data['DETournament']['name']=$name;
		if ($this->DETournament->save($this->data)) {
			$this->create_matchups($seeded_players);
		}
		return $this->DETournament->id;
	}
		
	function determine_gamecount($id)
	{
		if (!empty($this->data)) {
			 
			$rounds=$this->DETournament->Round->findAllByTournamentId($id);
			foreach($rounds as $round)
			{
				$i = $round['Round']['number'];
				foreach($round['Match'] as $match)
				{
					$this->DETournament->Round->Match->id=$match['id'];
					$this->DETournament->Round->Match->saveField('games',$this->data['bestof'][$i]);
				}
			}
			$this->redirect(array('action' => 'view', $id));
		}
		if (empty($this->data)) {
			$this->data = $this->DETournament->read(null, $id);
			
		}
	$this->set('tournament', $this->DETournament->read(null, $id));
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
				//$player=$this->DETournament->User->findById($i);
				//$playerlist[$pos-1]=$player['User'];
				$playerlist[$pos-1]=$i;
				
			}
			$this->create_matchups($playerlist);
			$this->redirect(array('action' => 'determine_gamecount', $this->DETournament->id));
		}
		if (empty($this->data)) {
			$this->data = $this->DETournament->read(null, $id);
		}
		$this->set('tournament', $this->DETournament->read(null, $id));
	}	
	function create_matchups ($playerlist)
	{
		$players = count($playerlist);
		$Rounds = new RoundsController;
		$Rounds->ConstructClasses();
		$roundnumber = ceil(log($players,2));
		//Create Matchups

		//Byes first for winner bracket
		$matchups = array(array());
		$cutoff = pow(2,$roundnumber) - $players; 
		for ($i=0; $i< $cutoff;$i++)
		{
			$matchups[$i][0]=$playerlist[$i];
	
			$matchups[$i][1]=null;
		}
		//Regular matches next for winner bracket
		for ($i = 0; $i < $players-$cutoff; $i+=2)
		{
			$matchups[($i/2)+$cutoff][0]=$playerlist[($i/2)+$cutoff];
			$matchups[($i+1)/2+$cutoff][1]=$playerlist[$players-($i/2)-1];
		}
		$Rounds->generate_with_matchups($this->DETournament->id,0,(pow(2,$roundnumber))/2,1,$matchups);
		//Create further Rounds for winner bracket
		for($i=1;$i<$roundnumber;$i++)
		{
			$Rounds->generate($this->DETournament->id,$i,(pow(2,($roundnumber-$i)))/2,1);
		}
		
		//Fill Byes for round 2 for winner bracket
		if ($cutoff > 0)
		{
			$Matches = new MatchesController;
			$Matches->ConstructClasses();
			$round2 = $this->DETournament->Round->find('first',array('conditions'=>array('Round.number'=>1,'Round.tournament_id'=>$this->DETournament->id)));
			
			$matches = $this->DETournament->Round->Match->find('all',array('conditions'=>array('Match.round_id'=>$round2['Round']['id']),'order'=>array('Match.number_in_round')));
			
			for ($i=0; $i< $cutoff;$i++)
			{
				$match = $matches[floor($i/2)];
				$this->DETournament->Round->Match->id = $match['Match']['id'];
				$playernumber = $match['Match']['number_in_round']%2+1;
				$this->DETournament->Round->Match->saveField('player'.(($i%2)+1).'_id',$playerlist[$i]);
				
				
			}
		}
		//Create further Rounds for looser bracket
		for($i=1;$i<=($roundnumber-1)*2;$i++)
		{
			if($i%2==0){
				$Rounds->generate($this->DETournament->id,-$i,(pow(2,(($roundnumber-1)-($i-2)/2)))/2,1);
			}
			if($i%2==1){
				$Rounds->generate($this->DETournament->id,-$i,(pow(2,(($roundnumber-1)-($i-1)/2)))/2,1);
			}
		}
		//Create winner vs looser final
		$Rounds->generate($this->DETournament->id,$roundnumber,1,1);
	}
	

}
?>