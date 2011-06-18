<?php
App::import('Controller', 'KOTournaments');
App::import('Controller', 'DETournaments');
class TournamentsController extends AppController {
	var $helpers = array('FlashChart');
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
		
		if($tournament['Tournament']['typeAlias']==3)
		{
			$DETournaments = new DETournamentsController;
			$DETournaments->ConstructClasses();
			
			$DETournaments->report_match($match_id,$player1_score,$player2_score);
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
	
	function statistics() {
		$tournament= $this->Tournament->find('all', array('recursive' => 3));
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
		
		// arrays for tournament specific analysis
		$names_tournament_array = array();
		$TvP_tournament_array = array();
		$PvZ_tournament_array = array();
		$ZvT_tournament_array = array();
		$RvT_tournament_array = array();
		$RvP_tournament_array = array();
		$RvZ_tournament_array = array();
		//debug($tournament);
		$this->set('tournament',$tournament );
		foreach ($tournament as $tournament){
			//temp arrays for tournament analysis
				$TvP_array_temp = array(); //0=total;win;loss;draw
				$TvP_array_temp[0]=0;
				$TvP_array_temp[1]=0;
				$TvP_array_temp[2]=0;
				$TvP_array_temp[3]=0;
				$PvZ_array_temp = array(); //0=total;win;loss;draw
				$PvZ_array_temp[0]=0;
				$PvZ_array_temp[1]=0;
				$PvZ_array_temp[2]=0;
				$PvZ_array_temp[3]=0;
				$ZvT_array_temp = array(); //0=total;win;loss;draw
				$ZvT_array_temp[0]=0;
				$ZvT_array_temp[1]=0;
				$ZvT_array_temp[2]=0;
				$ZvT_array_temp[3]=0;
				$RvT_array_temp = array(); //0=total;win;loss;draw
				$RvT_array_temp[0]=0;
				$RvT_array_temp[1]=0;
				$RvT_array_temp[2]=0;
				$RvT_array_temp[3]=0;
				$RvP_array_temp = array(); //0=total;win;loss;draw
				$RvP_array_temp[0]=0;
				$RvP_array_temp[1]=0;
				$RvP_array_temp[2]=0;
				$RvP_array_temp[3]=0;
				$RvZ_array_temp = array(); //0=total;win;loss;draw
				$RvZ_array_temp[0]=0;
				$RvZ_array_temp[1]=0;
				$RvZ_array_temp[2]=0;
				$RvZ_array_temp[3]=0;
			foreach ($tournament['Round'] as $round){
				foreach ($round['Match'] as $match){
						//debug(count($match['Player2']));
						if(count($match['Player2'])!=0&&count($match['Player1'])!=0){
							$number_matches++;
							//TvP array with player 1 as Terran
							if($match['Player1']['race']==0 && $match['Player2']['race']==1){
								$TvP_array[0]+=1;
								$TvP_array_temp[0]+=1;
								if($match['player1_score']>$match['player2_score']){
									$TvP_array[1]+=1;
									$TvP_array_temp[1]+=1;
								}
								if($match['player2_score']>$match['player1_score']){
									$TvP_array[2]+=1;
									$TvP_array_temp[2]+=1;
								}
								if($match['player2_score']==$match['player1_score']){
									$TvP_array[3]+=1;
									$TvP_array_temp[3]+=1;
								}
							}
							//TvP array with player 2 as Terran
							if($match['Player2']['race']==0 && $match['Player1']['race']==1){
								$TvP_array[0]+=1;
								$TvP_array_temp[0]+=1;
								if($match['player2_score']>$match['player1_score']){
									$TvP_array[1]+=1;
									$TvP_array_temp[1]+=1;
								}
								if($match['player1_score']>$match['player2_score']){
									$TvP_array[2]+=1;
									$TvP_array_temp[2]+=1;
								}
								if($match['player1_score']==$match['player2_score']){
									$TvP_array[3]+=1;
									$TvP_array_temp[3]+=1;
								}
							}
							//PvZ array with player 1 as Protoss
							if($match['Player1']['race']==1 && $match['Player2']['race']==2){
								$PvZ_array[0]+=1;
								$PvZ_array_temp[0]+=1;
								if($match['player1_score']>$match['player2_score']){
									$PvZ_array[1]+=1;
									$PvZ_array_temp[1]+=1;
								}
								if($match['player2_score']>$match['player1_score']){
									$PvZ_array[2]+=1;
									$PvZ_array_temp[2]+=1;
								}
								if($match['player2_score']==$match['player1_score']){
									$PvZ_array[3]+=1;
									$PvZ_array_temp[3]+=1;
								}
							}
							//PvZ array with player 2 as Protoss
							if($match['Player2']['race']==1 && $match['Player1']['race']==2){
								$PvZ_array[0]+=1;
								$PvZ_array_temp[0]+=1;
								if($match['player2_score']>$match['player1_score']){
									$PvZ_array[1]+=1;
									$PvZ_array_temp[1]+=1;
								}
								if($match['player1_score']>$match['player2_score']){
									$PvZ_array[2]+=1;
									$PvZ_array_temp[2]+=1;
								}
								if($match['player1_score']==$match['player2_score']){
									$PvZ_array[3]+=1;
									$PvZ_array_temp[3]+=1;
								}
							}
							//ZvT array with player 1 as zerg
							if($match['Player1']['race']==2 && $match['Player2']['race']==0){
								$ZvT_array[0]+=1;
								$ZvT_array_temp[0]+=1;
								if($match['player1_score']>$match['player2_score']){
									$ZvT_array[1]+=1;
									$ZvT_array_temp[1]+=1;
								}
								if($match['player2_score']>$match['player1_score']){
									$ZvT_array[2]+=1;
									$ZvT_array_temp[2]+=1;
								}
								if($match['player2_score']==$match['player1_score']){
									$ZvT_array[3]+=1;
									$ZvT_array_temp[3]+=1;
								}
							}
							//ZvT array with player 2 as zerg
							if($match['Player2']['race']==2 && $match['Player1']['race']==0){
								$ZvT_array[0]+=1;
								$ZvT_array_temp[0]+=1;
								if($match['player2_score']>$match['player1_score']){
									$ZvT_array[1]+=1;
									$ZvT_array_temp[1]+=1;
								}
								if($match['player1_score']>$match['player2_score']){
									$ZvT_array[2]+=1;
									$ZvT_array_temp[2]+=1;
								}
								if($match['player1_score']==$match['player2_score']){
									$ZvT_array[3]+=1;
									$ZvT_array_temp[3]+=1;
								}
							}
							
							//RvT array with player 1 as Random
							if($match['Player1']['race']==3 && $match['Player2']['race']==0){
								$RvT_array[0]+=1;
								$RvT_array[0]+=1;
								if($match['player1_score']>$match['player2_score']){
									$RvT_array[1]+=1;
									$RvT_array_temp[1]+=1;
								}
								if($match['player2_score']>$match['player1_score']){
									$RvT_array[2]+=1;
									$RvT_array_temp[2]+=1;
								}
								if($match['player2_score']==$match['player1_score']){
									$RvT_array[3]+=1;
									$RvT_array_temp[3]+=1;
								}
							}
							//RvT array with player 2 as Random
							if($match['Player2']['race']==3 && $match['Player1']['race']==0){
								$RvT_array[0]+=1;
								$RvT_array_temp[0]+=1;
								if($match['player2_score']>$match['player1_score']){
									$RvT_array[1]+=1;
									$RvT_array_temp[1]+=1;
								}
								if($match['player1_score']>$match['player2_score']){
									$RvT_array[2]+=1;
									$RvT_array_temp[2]+=1;
								}
								if($match['player1_score']==$match['player2_score']){
									$RvT_array[3]+=1;
									$RvT_array_temp[3]+=1;
								}
							}
							//RvP array with player 1 as Random
							if($match['Player1']['race']==3 && $match['Player2']['race']==1){
								$RvP_array[0]+=1;
								$RvP_array_temp[0]+=1;
								if($match['player1_score']>$match['player2_score']){
									$RvP_array[1]+=1;
									$RvP_array_temp[1]+=1;
								}
								if($match['player2_score']>$match['player1_score']){
									$RvP_array[2]+=1;
									$RvP_array_temp[2]+=1;
								}
								if($match['player2_score']==$match['player1_score']){
									$RvP_array[3]+=1;
									$RvP_array_temp[3]+=1;
								}
							}
							//RvP array with player 2 as Random
							if($match['Player2']['race']==3 && $match['Player1']['race']==1){
								$RvP_array[0]+=1;
								$RvP_array_temp[0]+=1;
								if($match['player2_score']>$match['player1_score']){
									$RvP_array[1]+=1;
									$RvP_array_temp[1]+=1;
								}
								if($match['player1_score']>$match['player2_score']){
									$RvP_array[2]+=1;
									$RvP_array_temp[2]+=1;
								}
								if($match['player1_score']==$match['player2_score']){
									$RvP_array[3]+=1;
									$RvP_array_temp[3]+=1;
								}
							}
							//RvZ array with player 1 as Random
							if($match['Player1']['race']==3 && $match['Player2']['race']==2){
								$RvZ_array[0]+=1;
								$RvZ_array_temp[0]+=1;
								if($match['player1_score']>$match['player2_score']){
									$RvZ_array[1]+=1;
									$RvZ_array_temp[1]+=1;
								}
								if($match['player2_score']>$match['player1_score']){
									$RvZ_array[2]+=1;
									$RvZ_array_temp[2]+=1;
								}
								if($match['player2_score']==$match['player1_score']){
									$RvZ_array[3]+=1;
									$RvZ_array_temp[3]+=1;
								}
							}
							//RvZ array with player 2 as Random
							if($match['Player2']['race']==3 && $match['Player1']['race']==2){
								$RvZ_array[0]+=1;
								$RvZ_array_temp[0]+=1;
								if($match['player2_score']>$match['player1_score']){
									$RvZ_array[1]+=1;
									$RvZ_array_temp[1]+=1;
								}
								if($match['player1_score']>$match['player2_score']){
									$RvZ_array[2]+=1;
									$RvZ_array_temp[2]+=1;
								}
								if($match['player1_score']==$match['player2_score']){
									$RvZ_array[3]+=1;
									$RvZ_array_temp[3]+=1;
								}
							}
							
						}
				}
			}
			$names_tournament_array[] = $tournament['Tournament']['name'];
			//debug($TvP_array);
			if(($TvP_array_temp[1]+$TvP_array_temp[2])!=0){
			$TvP_tournament_array[] = $TvP_array_temp[1]/($TvP_array_temp[1]+$TvP_array_temp[2]);
			}
			else{
			$TvP_tournament_array[] = 0;
			}
			
			if(($PvZ_array_temp[1]+$PvZ_array_temp[2])!=0){
			$PvZ_tournament_array[] = $PvZ_array_temp[1]/($PvZ_array_temp[1]+$PvZ_array_temp[2]);
			}
			else{
			$PvZ_tournament_array[] = 0;
			}
			
			if(($ZvT_array_temp[1]+$ZvT_array_temp[2])!=0){
			$ZvT_tournament_array[] = $ZvT_array_temp[1]/($ZvT_array_temp[1]+$ZvT_array_temp[2]);
			}
			else{
			$ZvT_tournament_array[] = 0;
			}
			
			if(($RvT_array_temp[1]+$RvT_array_temp[2])!=0){
			$RvT_tournament_array[] = $RvT_array_temp[1]/($RvT_array_temp[1]+$RvT_array_temp[2]);
			}
			else{
			$RvT_tournament_array[] = 0;
			}
			
			if(($RvP_array_temp[1]+$RvP_array_temp[2])!=0){
			$RvP_tournament_array[] = $RvP_array_temp[1]/($RvP_array_temp[1]+$RvP_array_temp[2]);
			}
			else{
			$RvP_tournament_array[] = 0;
			}
			
			if(($RvZ_array_temp[1]+$RvZ_array_temp[2])!=0){
			$RvZ_tournament_array[] = $RvZ_array_temp[1]/($RvZ_array_temp[1]+$RvZ_array_temp[2]);
			}
			else{
			$RvZ_tournament_array[] = 0;
			}
		} 
		//debug($names_tournament_array);
		//debug($PvZ_tournament_array);
		$this->set('TvP_array', $TvP_array);
		$this->set('PvZ_array', $PvZ_array);
		$this->set('ZvT_array', $ZvT_array);
		$this->set('RvT_array', $RvT_array);
		$this->set('RvP_array', $RvP_array);
		$this->set('RvZ_array', $RvZ_array);
		
		
		$this->set('names_tournament_array', $names_tournament_array);
		$this->set('TvP_tournament_array', $TvP_tournament_array);
		$this->set('PvZ_tournament_array', $PvZ_tournament_array);
		$this->set('ZvT_tournament_array', $ZvT_tournament_array);
		$this->set('RvT_tournament_array', $RvT_tournament_array);
		$this->set('RvP_tournament_array', $RvP_tournament_array);
		$this->set('RvZ_tournament_array', $RvZ_tournament_array);
		
		/*debug ($TvP_array);
		debug ($PvZ_array);
		debug ($ZvT_array);
		debug ($RvT_array);
		debug ($RvP_array);
		debug ($RvZ_array);*/
		
	}

	function view($id = null) {
		//redirect to right tourney type
		if ($this->Tournament->field('current_round')==NULL)
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
		if ($this->Tournament->field('typeField') == 'DE')
		{
			$this->redirect(array('controller'=> 'DETournaments','action' => 'view',$id));
		}
		if ($this->Tournament->field('typeField') == 'SDE')
		{
			$this->redirect(array('controller'=> 'DETournaments','action' => 'view',$id));
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
		$tournament = $this->Tournament->findById($id);
		$this->set('tournament',$tournament);
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
		if($this->Tournament->field('typeField') == 'DE')
		{
			$this->redirect(array('controller'=> 'DETournaments','action' => 'start_random',$id));
		}
		if($this->Tournament->field('typeField') == 'SDE')
		{
			$this->redirect(array('controller'=> 'DETournaments','action' => 'start_seeded',$id));
		}
		
	}
	function add() {
		$current_user=$this->Auth->user('id');
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
		//debug($this->data);
			$this->Tournament->create();
			
			
			switch ($this->data['Tournament']['typeAlias']){
				case 0:
					$this->data['Tournament']['typeField']='KO';
					
					break;
				case 1:
					$this->data['Tournament']['typeField']='SKO';
					break;
				case 2:
					$this->data['Tournament']['typeField']='Swiss';
					break;
				case 3:
					$this->data['Tournament']['typeField']='DE';
					break;
				case 4:
					$this->data['Tournament']['typeField']='SDE';
			}
			
			
			if ($this->Tournament->save($this->data)) {
				$this->Session->setFlash(__('The tournament has been saved', true));
				//$this->redirect(array('action' => 'index'));
				//find subscribers and message them
				$subscribers=array();
				//$tournament = $this->Tournament->read(null,$id);
				$users = $this->Tournament->User->find('all');
				foreach ($users as $users){
					if($users['User']['subscribe_tournaments'])
					{
						array_push($subscribers,$users['User']);
					}
				}
				
				
				foreach($subscribers as $subscriber)
				{
					if($subscriber['id']!=$current_user){
						$this->Tournament->User->Message->create();
						$date = date_create('now');
						$this->data['Message']['sender_id']=null;
						$this->data['Message']['recipient_id']=$subscriber['id'];
						$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
						$this->data['Message']['title']= 'The tournament "'. $this->data['Tournament']['name']. '" has beed added.';
						
						//TODO: machen! ;)
						$this->data['Message']['body']= 'A new comment has been added. Sign up for the tournament at:
														 http://'.$_SERVER['SERVER_NAME'].'/caketourney/tournaments/view/'.$this->Tournament->getLastInsertId().'
													 
													 To unsubscribe from this automated message, change you account settings at:
													 http://'.$_SERVER['SERVER_NAME'].'/caketourney/users/account/'.$current_user;
						$this->Tournament->User->Message->save($this->data);
						$this->redirect(array('action'=>'index'));
					}
				}
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