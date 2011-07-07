<?php
App::import('Controller', 'Rounds');
App::import('Controller', 'Matches');
class KOTournamentsController extends AppController {
	var $helpers = array('Race','Bracket','FlashChart');
	var $components = array('Email');
	var $name = 'KOTournaments';
	function beforeFilter()
    {
		$this->Auth->allow('view','statistics','extended_view');
        parent::beforeFilter();
		
	}
	
	
	function _sendNewUserMail($username,$useremail,$tournament_name,$tournament_id) {
		
		
		$this->set('username', $username);
		$this->set('tournament_name', $tournament_name);
		$this->set('tournament_id', $tournament_id);
		$this->Email->to = $useremail;
		$this->Email->subject = 'The tournament "'. $tournament_name. '" started.';
		Configure::load('caketourney_configuration');
		$this->Email->replyTo = Configure::read('Email.replyTo');
		$this->Email->from = Configure::read('Email.from');
		$this->Email->template = 'tournament_started_email'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//$this->Email->_createboundary();
		//$this->Email->__header[] = 'MIME-Version: 1.0';
		//Do not pass any args to send()
		//$this->Email->delivery = 'debug';
		$this->Email->delivery = 'mail';
		$this->Email->send();
		$this->Email->reset();
		
	}
	
	function statistics($tournament_id = null) {
		//$tournament=$this->KOTournament->find('first', array('conditions'=>array('id' => $tournament_id), 'recursive' => 3));
		$tournament = $this->KOTournament->find('first', array(
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
													),
													'conditions'=>array('Match.open'=>0
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
		if(!empty($nextround))
		{
			$nextmatchnumber=floor($match['Match']['number_in_round']/2);
			$nextplayernumber=$match['Match']['number_in_round']%2+1;
			$nextmatch=$this->KOTournament->Round->Match->find('first',array('conditions'=>array('Match.round_id'=>$nextround['Round']['id'],'Match.number_in_round'=>$nextmatchnumber)));
			$this->KOTournament->Round->Match->id=$nextmatch['Match']['id'];
			$this->KOTournament->Round->Match->saveField('player'.$nextplayernumber.'_id',$winner_id);
		}
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
		

		$tournament = $this->KOTournament->find('first', array(
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
													),
													
											)
											
											)
								)
							));
		//$tournament = $this->KOTournament->find('first', array('conditions'=>array('id' => $id), 'recursive' => 3));
		$this->set('tournament', $tournament);
		
	}
	
	
	function extended_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tournament', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->layout = 'extended_view';

		$tournament = $this->KOTournament->find('first', array(
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
													),
													
											)
											
											)
								)
							));
		//$tournament = $this->KOTournament->find('first', array('conditions'=>array('id' => $id), 'recursive' => 3));
		$this->set('tournament', $tournament);
		
	}


	function pre_start_random($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

			$this->redirect(array('action' => 'start_random', $this->KOTournament->id,$this->data['KOTournament']['signup_mod']));
			
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
		$options['order'] = array('User.username asc');
		$users = $this->KOTournament->User->find('list',$options);
		
		$this->set(compact('users'));
	}
	
	function start_random($id,$signup_mod=array()) {
		Configure::load('caketourney_configuration');
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
			if(array_key_exists('Alluser',$this->data['KOTournament'])){
				$this->data['User']['User']=array_merge($this->data['User']['User'],$this->data['KOTournament']['Alluser']);
			}
			
			$current_tournament = $this->KOTournament->find('first',array('conditions' => array('KOTournament.id'=>$id) ,'contain' => array() ));
			if(isset($current_tournament['KOTournament']['current_round'])){
				$this->Session->setFlash(__('Tournament has already been started', true));
				$this->redirect(array('controller'=> 'Tournaments','action' => 'view',$id));
			}

			$this->data['KOTournament']['current_round']=0;
			if ($this->KOTournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				//Create first round with random matchups
				shuffle($this->data['User']['User']);
				$playerlist = $this->data['User']['User'];
				$this->create_matchups($playerlist);
				
				//email + message start
				Configure::load('caketourney_configuration');
				$current_user=$this->Auth->user('id');
				//find subscribers and message them
				$subscribers=array();
				
				
				$users = $this->KOTournament->User->find('all');
				foreach ($users as $users){
					if($users['User']['subscribe_tournament_starts']&& in_array($users['User']['id'],$this->data['User']['User']))
					{
						array_push($subscribers,$users['User']);
						
						
					}
				}
				
				
				foreach($subscribers as $subscriber)
				{
					if($subscriber['id']!=$current_user){
						$this->KOTournament->User->Message->create();
						$date = date_create('now');
						$this->data['Message']['sender_id']=null;
						$this->data['Message']['recipient_id']=$subscriber['id'];
						$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
						$this->data['Message']['title']= 'The tournament "'. $this->data['KOTournament']['name']. '" started.';
						
						
						$this->data['Message']['body']= 'The tournament '.$this->data['KOTournament']['name'].' started. Find your first match at:
														 http://'.$_SERVER['SERVER_NAME'].'/'.Configure::read('Caketourney.folder').'caketourney/tournaments/view/'.$id.'
													 
													 To unsubscribe from this automated message, change you account settings at:
													 http://'.$_SERVER['SERVER_NAME'].'/'.Configure::read('Caketourney.folder').'caketourney/users/account/';
						$this->KOTournament->User->Message->save($this->data);
						//
						if($subscriber['email_subscriptions']){
							$this->_sendNewUserMail( $subscriber['username'],$subscriber['email'], $this->data['KOTournament']['name'],$id  );
						}	
					}
				}
				//email + message end
				
				
				$this->redirect(array('action' => 'determine_gamecount', $this->KOTournament->id));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->KOTournament->read(null, $id);
			
		}
		$options['fields'] = array('User.id', 'User.username');
		
		// signup mod has been set by pre_start and now the different conditions are set
		if($signup_mod=='sign_up'){
			$options['joins'] = array(
				array('table' => 'signups',
				'alias' => 'Signup',
				'type' => 'LEFT',
				'conditions' => array(
					'User.id = Signup.user_id',
			)));
			$options['conditions'] = array('Signup.tournament_id'=>$id);
		}
		if($signup_mod=='all'){
			
		}
		if($signup_mod=='division_1'){
			$options['conditions'] = array('User.division'=>Configure::read('Caketourney.division_1'));
		}
		if($signup_mod=='division_2'){
			$options['conditions'] = array('User.division'=>Configure::read('Caketourney.division_2'));
		}
		if($signup_mod=='mixed'){
			$options['joins'] = array(
				array('table' => 'signups',
				'alias' => 'Signup',
				'type' => 'LEFT',
				'conditions' => array(
					'User.id = Signup.user_id',
			)));
			$options['conditions'] = array('Signup.tournament_id'=>$id);
		}
		
		
		$options['order'] = array('User.username asc');
		$users = $this->KOTournament->User->find('list',$options);
		$allusers = array();
		
		if($signup_mod=='mixed'){
			$options['joins'] = array(
				array('table' => 'signups',
				'alias' => 'Signup',
				'type' => 'LEFT',
				'conditions' => array(
					'User.id = Signup.user_id',
			)));
			$options['conditions'] = '';
			$options['order'] = array('User.username asc');
			$tempusers = $this->KOTournament->User->find('list',$options);
			$allusers = array_diff ($tempusers,$users);
		}
		$this->set(compact('users'));
		$this->set(compact('allusers'));
	}
	
	function pre_start_seeded($id) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

			$this->redirect(array('action' => 'start_seeded', $this->KOTournament->id,$this->data['KOTournament']['signup_mod']));
			
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
		$options['order'] = array('User.username asc');
		$users = $this->KOTournament->User->find('list',$options);
		
		$this->set(compact('users'));
	}
	
	function start_seeded($id,$signup_mod=array()) {
		Configure::load('caketourney_configuration');
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
			if(array_key_exists('Alluser',$this->data['KOTournament'])){
				$this->data['User']['User']=array_merge($this->data['User']['User'],$this->data['KOTournament']['Alluser']);
			}
			
			$current_tournament = $this->KOTournament->find('first',array('conditions' => array('KOTournament.id'=>$id) ,'contain' => array() ));
			if(isset($current_tournament['KOTournament']['current_round'])){
				$this->Session->setFlash(__('Tournament has already been started', true));
				$this->redirect(array('controller'=> 'Tournaments','action' => 'view',$id));
			}
			
			$this->data['KOTournament']['current_round']=0;
			if ($this->KOTournament->save($this->data)) {
				
				$this->Session->setFlash(__('The tournament has been saved', true));
				
				//email + message start
				Configure::load('caketourney_configuration');
				$current_user=$this->Auth->user('id');
				//find subscribers and message them
				$subscribers=array();
				
				
				$users = $this->KOTournament->User->find('all');
				foreach ($users as $users){
					if($users['User']['subscribe_tournament_starts']&& in_array($users['User']['id'],$this->data['User']['User']))
					{
						array_push($subscribers,$users['User']);
						
						
					}
				}
				
				
				foreach($subscribers as $subscriber)
				{
					if($subscriber['id']!=$current_user){
						$this->KOTournament->User->Message->create();
						$date = date_create('now');
						$this->data['Message']['sender_id']=null;
						$this->data['Message']['recipient_id']=$subscriber['id'];
						$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
						$this->data['Message']['title']= 'The tournament "'. $this->data['KOTournament']['name']. '" started.';
						
						
						$this->data['Message']['body']= 'The tournament '.$this->data['KOTournament']['name'].' started. Find your first match at:
														 http://'.$_SERVER['SERVER_NAME'].'/'.Configure::read('Caketourney.folder').'caketourney/tournaments/view/'.$id.'
													 
													 To unsubscribe from this automated message, change you account settings at:
													 http://'.$_SERVER['SERVER_NAME'].'/'.Configure::read('Caketourney.folder').'caketourney/users/account/';
						$this->KOTournament->User->Message->save($this->data);
						//
						if($subscriber['email_subscriptions']){
							$this->_sendNewUserMail( $subscriber['username'],$subscriber['email'], $this->data['KOTournament']['name'],$id  );
						}	
					}
				}
				//email + message end
				
				
				//Create first round with random matchups
				$this->redirect(array('action' => 'seed', $this->KOTournament->id));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->KOTournament->read(null, $id);
			
		}
		$options['fields'] = array('User.id', 'User.username');
		
		// signup mod has been set by pre_start and now the different conditions are set
		if($signup_mod=='sign_up'){
			$options['joins'] = array(
				array('table' => 'signups',
				'alias' => 'Signup',
				'type' => 'LEFT',
				'conditions' => array(
					'User.id = Signup.user_id',
			)));
			$options['conditions'] = array('Signup.tournament_id'=>$id);
		}
		if($signup_mod=='all'){
			
		}
		if($signup_mod=='division_1'){
			$options['conditions'] = array('User.division'=>Configure::read('Caketourney.division_1'));
		}
		if($signup_mod=='division_2'){
			$options['conditions'] = array('User.division'=>Configure::read('Caketourney.division_2'));
		}
		if($signup_mod=='mixed'){
			$options['joins'] = array(
				array('table' => 'signups',
				'alias' => 'Signup',
				'type' => 'LEFT',
				'conditions' => array(
					'User.id = Signup.user_id',
			)));
			$options['conditions'] = array('Signup.tournament_id'=>$id);
		}
		
		
		$options['order'] = array('User.username asc');
		$users = $this->KOTournament->User->find('list',$options);
		$allusers = array();
		
		if($signup_mod=='mixed'){
			$options['joins'] = array(
				array('table' => 'signups',
				'alias' => 'Signup',
				'type' => 'LEFT',
				'conditions' => array(
					'User.id = Signup.user_id',
			)));
			$options['conditions'] = '';
			$options['order'] = array('User.username asc');
			$tempusers = $this->KOTournament->User->find('list',$options);
			$allusers = array_diff ($tempusers,$users);
		}
		$this->set(compact('users'));
		$this->set(compact('allusers'));
	}
	
	function generate_seeded($seeded_players,$name)
	{
		$this->KOTournament->create();
		$this->data['KOTournament']['typeField']='KO';
		$this->data['KOTournament']['typeAlias']=0;
		$this->data['KOTournament']['current_round']=0;
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