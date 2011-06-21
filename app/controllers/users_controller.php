<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Race','FlashChart');
    /**
     * Runs automatically before the controller action is called
     */
    function beforeFilter()
    {
        $this->Auth->allow('register');
        parent::beforeFilter();
		
	}
 
    /**
     * Registration page for new users
     */
    function register()
    {
        if (!empty($this->data)) {
            $this->User->create();
			//Set admin flag if no admin in system yet
			if (!$this->User->findByAdmin(1))
			{
				$this->data['User']['admin']=1;
			}
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('Your account has been created.', true));
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Your account could not be created.', true));
            }
        }
    }
 
   /**
     * Ran directly after the Auth component has executed
     */
    function login()
    {
		

		$this->set('title_for_layout', 'Tournament Home');
        // Check for a successful login
        if (!empty($this->data) && $id = $this->Auth->user('id')) {
 
            // Set the lastlogin time
            $fields = array('lastlogin' => date('Y-m-d H:i:s'), 'modified' => false);
            $this->User->id = $id;
            $this->User->save($fields, false, array('lastlogin'));
			if ($this->data['User']['remember_me']) 
			{
				$cookie = array();
				$cookie['username'] = $this->data['User']['username'];
				$cookie['password'] = $this->data['User']['password'];
				$this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
				unset($this->data['User']['remember_me']);

			}

            // Redirect the user
            $url = array('controller' => 'users', 'action' => 'account');
            //if ($this->Session->check('Auth.redirect')) {
            //    $url = $this->Session->read('Auth.redirect');
            //}
			$this->User->id = $this->Auth->user('id');
 
			// Load the user (avoid populating $this->data)
			$current_user = $this->User->findById($id);
			$this->Session->write('current_user', $current_user);
            $this->redirect($url);
        }
		if (empty($this->data))
		{
			$cookie = $this->Cookie->read('Auth.User');
			if (!is_null($cookie)) {
				if ($this->Auth->login($cookie)) {
					//  Clear auth message, just in case we use it.
					$this->Session->del('Message.auth');
					$this->redirect($this->Auth->redirect());
				} else { // Delete invalid Cookie
					$this->Cookie->del('Auth.User');
				}
			}
		}
    }
 
 	function upload_avatar()
	{	
		// Set User's ID in model which is needed for validation
        $this->User->id = $this->Auth->user('id');
		
        // Load the user (avoid populating $this->data)
        $current_user = $this->User->findById($this->User->id);
		
		if (!empty($this->data)) {
           	//debug($this->data);
			/*$this->User->saveField('avatar_name', $this->data['User']['file']['name']);
			$this->User->saveField('avatar_type', $this->data['User']['file']['type']);
			$this->User->saveField('avatar_size', $this->data['User']['file']['size']);*/

			if ($this->User->save($this->data,false))
				$this->Session->setFlash('Your avatar has been updated');
            else
				$this->Session->setFlash('Invalid File');
			

            $this->redirect(array('controller' => 'users', 'action' => 'view',$this->User->id ));
        }
		
		if (empty($this->data))
		{
			$this->data = $this->User->read(null, $this->Auth->user('id'));
		}
	}
	
	function account()
    {
		// Set User's ID in model which is needed for validation
        $this->User->id = $this->Auth->user('id');
		
        // Load the user (avoid populating $this->data)
        $current_user = $this->User->findById($this->User->id);
		$this->set('current_user', $current_user);
        $this->User->useValidationRules('ChangePassword');
        $this->User->validate['password_confirm']['compare']['rule'] =
            array('password_match', 'password', false);
 
        $this->User->set($this->data);
		
		if (!empty($this->data) && empty($this->data['User']['password'] )) {
           	//debug($this->data);
			$this->User->saveField('bnetaccount', $this->data['User']['bnetaccount']);
			$this->User->saveField('bnetcode', $this->data['User']['bnetcode']);
			$this->User->saveField('race', $this->data['User']['race']);
			$this->User->saveField('subscribe_own_comments', $this->data['User']['subscribe_own_comments']);
			$this->User->saveField('subscribe_own_posts', $this->data['User']['subscribe_own_posts']);
			$this->User->saveField('subscribe_tournaments', $this->data['User']['subscribe_tournaments']);
			
            $this->Session->setFlash('Your data has been updated');
            $this->redirect(array('controller' => 'news', 'action' => 'index'));
        }
		
        if (!empty($this->data) && $this->User->validates()) {
			//debug($this->data);
            $password = $this->Auth->password($this->data['User']['password']);
            $this->User->saveField('password', $password);
			$this->User->saveField('bnetaccount', $this->data['User']['bnetaccount']);
			$this->User->saveField('bnetcode', $this->data['User']['bnetcode']);
			$this->User->saveField('race', $this->data['User']['race']);
			$this->User->saveField('subscribe_own_comments', $this->data['User']['subscribe_own_comments']);
			$this->User->saveField('subscribe_own_posts', $this->data['User']['subscribe_own_posts']);
			$this->User->saveField('subscribe_tournaments', $this->data['User']['subscribe_tournaments']);
			
            $this->Session->setFlash('Your data has been updated');
            $this->redirect(array('controller' => 'news', 'action' => 'index'));
        }
		if (empty($this->data))
		{
			$this->data = $this->User->read(null, $this->Auth->user('id'));
		}
    }
    /**
     * Log a user out
     */
    function logout()
    {
		$this->Session->delete('current_user');
       return $this->redirect($this->Auth->logout());
    }
	function index() {
		
		$this->User->id = $this->Auth->user('id');
 
        // Load the user (avoid populating $this->data)
        $current_user = $this->User->findById($this->User->id);
		
		$this->User->recursive = 0;
		
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		$user_id = $this->Auth->user('id');
		$this->set('current_user',$user_id);
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		$user=$this->User->read(null, $id);
		$this->set('user',$user );
		
		
		$matches = $this->User->Match->find('all',array('recursive'=>2,'conditions'=>array('Match.open'=>0,'OR'=>array('Match.player1_id'=>$id,'Match.player2_id'=>$id)),'order'=>array('Match.date DESC')));
		$this->set('matches',$matches);
		
		$this->User->Tournament->bindModel(array('hasOne' => array('UsersTournament')));
		$tournaments = $this->User->Tournament->find('all', array(
							'contain'=>array(
								
								'UsersTournament'=> array(
									'conditions' => array('UsersTournament.user_id'=>$id),
								),
								'Round' => array(
											'Match' => array(
													'Player1' => array(
															'fields' => array('id', 'username', 'race')
													),
													'Player2' => array(
															'fields' => array('id', 'username', 'race')
													),
													'conditions'=>array('Match.open'=>0,'OR'=>array('Match.player1_id'=>$id,'Match.player2_id'=>$id)
												)
											)
											
											)
								)
							));
		
		$tournament_place = array();
		$tournament_name = array();
		$tournament_id = array();
		
		$firstplace_array = array();
		$secondplace_array = array();
		$firstplace_tournamentid_array = array();
		$secondplace_tournamentid_array = array();
		foreach ($tournaments as $tournament){
			$ranking=$this->User->Ranking->find('all',array('conditions'=>array('Ranking.tournament_id'=>$tournament['Tournament']['id']),'order'=>array('Ranking.match_points DESC','Ranking.oppscore DESC', 'Ranking.oppoppscore DESC')));
			foreach ($ranking as $i=>$rank){
				if($rank['User']['username']==$user['User']['username']){
					$tournament_place[]=($i+1);
					$tournament_name[]=$tournament['Tournament']['name'];
					$tournament_id[]=$tournament['Tournament']['id'];
				}
			}
			
				
				
			if($tournament['Tournament']['typeField']=='KO'||$tournament['Tournament']['typeField']=='SKO'||$tournament['Tournament']['typeField']=='DE'||$tournament['Tournament']['typeField']=='SDE'){
				$totalrounds = (count($tournament['Round']));
				
				
				if(!empty($tournament['Round'][$totalrounds-1]['Match'])){
					if($tournament['Round'][$totalrounds-1]['Match'][0]['Player1']['username']==$user['User']['username']||$tournament['Round'][$totalrounds-1]['Match'][0]['Player2']['username']==$user['User']['username']){
						if($tournament['Round'][$totalrounds-1]['Match'][0]['player1_score']>$tournament['Round'][$totalrounds-1]['Match'][0]['player2_score'] &&
							$tournament['Round'][$totalrounds-1]['Match'][0]['Player1']['username']==$user['User']['username']){
							$firstplace_array[] = $tournament['Tournament']['name'];
							$firstplace_tournamentid_array[]= $tournament['Tournament']['id'];
						}
						if($tournament['Round'][$totalrounds-1]['Match'][0]['player1_score']<$tournament['Round'][$totalrounds-1]['Match'][0]['player2_score'] &&
							$tournament['Round'][$totalrounds-1]['Match'][0]['Player1']['username']==$user['User']['username']){
							$secondplace_array[] = $tournament['Tournament']['name'];	
							$secondplace_tournamentid_array[]= $tournament['Tournament']['id'];
						}
						if($tournament['Round'][$totalrounds-1]['Match'][0]['player1_score']>$tournament['Round'][$totalrounds-1]['Match'][0]['player2_score'] &&
							$tournament['Round'][$totalrounds-1]['Match'][0]['Player2']['username']==$user['User']['username']){
							$secondplace_array[] = $tournament['Tournament']['name'];	
							$secondplace_tournamentid_array[]= $tournament['Tournament']['id'];
						}
						if($tournament['Round'][$totalrounds-1]['Match'][0]['player1_score']<$tournament['Round'][$totalrounds-1]['Match'][0]['player2_score'] &&
							$tournament['Round'][$totalrounds-1]['Match'][0]['Player2']['username']==$user['User']['username']){
							$firstplace_array[] = $tournament['Tournament']['name'];	
							$firstplace_tournamentid_array[]= $tournament['Tournament']['id'];
						}
					}
				}
			}
			
			
					
		}
		
		
		$this->set('tournament_place', $tournament_place);
		$this->set('tournament_name', $tournament_name);
		$this->set('tournament_id', $tournament_id);
		
		$this->set('firstplace_array', $firstplace_array);
		$this->set('secondplace_array', $secondplace_array);
		$this->set('firstplace_tournamentid_array', $firstplace_tournamentid_array);
		$this->set('secondplace_tournamentid_array', $secondplace_tournamentid_array);
	}
	
	function statistics($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		$user = $this->User->read(null, $id);
		$this->set('user', $user);
		
		//$this->User->Tournament->bindModel(array('hasOne' => array('UsersTournament')));
		//$tournaments = $this->User->Tournament->find('all',array('recursive'=>3,'conditions'=>array('UsersTournament.user_id'=>$id)));
		$tournaments = $this->User->Tournament->find('all', array(
							'contain'=>array(
								
								'UsersTournament'=> array(
									'conditions' => array('UsersTournament.user_id'=>$id),
								),
								'Round' => array(
											'Match' => array(
													'Player1' => array(
															'fields' => array('id', 'username', 'race')
													),
													'Player2' => array(
															'fields' => array('id', 'username', 'race')
													),
													'conditions'=>array('Match.open'=>0,'OR'=>array('Match.player1_id'=>$id,'Match.player2_id'=>$id)
												)
											)
											
											)
								)
							));
		/*$tournaments = $this->User->Tournament->find('all' , array(
							'contain'=>array(
								'Tournament',
								'UsersTournament'=> array(
									'conditions' => array('UsersTournament.user_id'=>$id),
								),
								'Round' ,
								'User' => array(
									'conditions' => array('User.id =' => 17),
								)
								)
							));*/
		//$tournaments = $this->User->Tournament->find('all', array('contain' => 'Tournament.name'));

		$this->set('tournaments',$tournaments);
		
		//debug($tournaments);
		
		$matches = $this->User->Match->find('all',array('recursive'=>2,'conditions'=>array('Match.open'=>0,'OR'=>array('Match.player1_id'=>$id,'Match.player2_id'=>$id)),'order'=>array('Match.date DESC')));
		$this->set('matches',$matches);
		
					
					$XvT = 0;
					$XvP = 0;
					$XvZ = 0;
					$XvR = 0;
					$totalXvT = 0;
					$totalXvP = 0;
					$totalXvZ = 0;
					$totalXvR = 0;
					$total = 0;
					$totalWin = 0;
					
					foreach ($matches as $match){
                        if ($match['Player2']['username']!=null && $match['Player1']['username']==$user['User']['username'])
                            {
								$total+=1;
								if($match['Player2']['race']==0){
									$totalXvT+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvT+=1;
									}
								}
								if($match['Player2']['race']==1){
									$totalXvP+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvP+=1;
									}
								}
								if($match['Player2']['race']==2){
									$totalXvZ+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvZ+=1;
									}
								}
								if($match['Player2']['race']==3){
									$totalXvR+=1;
									if($match['Match']['player1_score']>$match['Match']['player2_score']){
										$XvR+=1;
									}
								}
								if($match['Match']['player1_score']>$match['Match']['player2_score']){
									$totalWin+=1;
								}
                            }
							
                        if ($match['Player1']['username']!=null && $match['Player2']['username']==$user['User']['username'])
                            {
                                $total+=1;
								if($match['Player1']['race']==0){
									$totalXvT+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvT+=1;
									}
								}
								if($match['Player1']['race']==1){
									$totalXvP+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvP+=1;
									}
								}
								if($match['Player1']['race']==2){
									$totalXvZ+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvZ+=1;
									}
								}
								if($match['Player1']['race']==3){
									$totalXvR+=1;
									if($match['Match']['player2_score']>$match['Match']['player1_score']){
										$XvR+=1;
									}
								}
								if($match['Match']['player2_score']>$match['Match']['player1_score']){
									$totalWin+=1;
								}
                            }
					}
					
					$this->set('XvT',$XvT);
					$this->set('XvP',$XvP);
					$this->set('XvZ',$XvZ);
					$this->set('XvR',$XvR);
					$this->set('totalXvT',$totalXvT);
					$this->set('totalXvP',$totalXvP);
					$this->set('totalXvZ',$totalXvZ);
					$this->set('totalXvR',$totalXvR);
					$this->set('total',$total);
					$this->set('totalWin',$totalWin);
					
				
					$XvT_array = array();
					$XvP_array = array();
					$XvZ_array = array();
					$XvR_array = array();
					$totalXvT_array = array();
					$totalXvP_array = array();
					$totalXvZ_array = array();
					$totalXvR_array = array();
					$total_array = array();
					$totalWin_array = array();
					$tournament_names_array = array();
					
					foreach ($tournaments as $tournament){
						$tournament_names_array[]=$tournament['Tournament']['name'];
						$XvT_seperate = 0;
						$XvP_seperate = 0;
						$XvZ_seperate = 0;
						$XvR_seperate = 0;
						$totalXvT_seperate = 0;
						$totalXvP_seperate = 0;
						$totalXvZ_seperate = 0;
						$totalXvR_seperate = 0;
						$total_seperate = 0;
						$totalWin_seperate = 0;
						
						foreach($tournament['Round'] as $round){
						foreach ($round['Match'] as $match){

						
							
							
							if ($match['Player2']!=null && $match['player1_id'] == $user['User']['id'] )
								{
									$total_seperate+=1;
									if($match['Player2']['race']==0){
										$totalXvT_seperate+=1;
										if($match['player1_score']>$match['player2_score']){
											$XvT_seperate+=1;
										}
									}
									if($match['Player2']['race']==1){
										$totalXvP_seperate+=1;
										if($match['player1_score']>$match['player2_score']){
											$XvP_seperate+=1;
										}
									}
									if($match['Player2']['race']==2){
										$totalXvZ_seperate+=1;
										if($match['player1_score']>$match['player2_score']){
											$XvZ_seperate+=1;
										}
									}
									if($match['Player2']['race']==3){
										$totalXvR_seperate+=1;
										if($match['player1_score']>$match['player2_score']){
											$XvR_seperate+=1;
										}
									}
									if($match['player1_score']>$match['player2_score']){
										$totalWin_seperate+=1;
									}
								}
						   
							
							if ($match['Player1']!=null && $match['player2_id'] == $user['User']['id'] )
								{
									$total_seperate+=1;
									if($match['Player1']['race']==0){
										$totalXvT_seperate+=1;
										if($match['player2_score']>$match['player1_score']){
											$XvT_seperate+=1;
										}
									}
									if($match['Player1']['race']==1){
										$totalXvP_seperate+=1;
										if($match['player2_score']>$match['player1_score']){
											$XvP_seperate+=1;
										}
									}
									if($match['Player1']['race']==2){
										$totalXvZ_seperate+=1;
										if($match['player2_score']>$match['player1_score']){
											$XvZ_seperate+=1;
										}
									}
									if($match['Player1']['race']==3){
										$totalXvR_seperate+=1;
										if($match['player2_score']>$match['player1_score']){
											$XvR_seperate+=1;
										}
									}
									if($match['player2_score']>$match['player1_score']){
										$totalWin_seperate+=1;
									}
								}
								}
								
						  
								
								
						 }
					
					if($totalXvT_seperate!=0){
					$XvT_array[] = $XvT_seperate/$totalXvT_seperate;}
					else{
					$XvT_array[] = 0;}
					if($totalXvP_seperate!=0){
					$XvP_array[] = $XvP_seperate/$totalXvP_seperate;}
					else{
					$XvP_array[] = 0;}
					if($totalXvZ_seperate!=0){
					$XvZ_array[] = $XvZ_seperate/$totalXvZ_seperate;}
					else{
					$XvZ_array[] = 0;}
					if($totalXvR_seperate!=0){
					$XvR_array[] = $XvR_seperate/$totalXvR_seperate;}
					else{
					$XvR_array[] = 0;}
					
					
					
					
					$totalXvT_array[] =$totalXvT_seperate;
					$totalXvP_array[] =$totalXvP_seperate;
					$totalXvZ_array[] =$totalXvZ_seperate;
					$totalXvR_array[] =$totalXvR_seperate;
					$total_array[] = $total_seperate;
					if($total_seperate!=0)
						$totalWin_array[] = $totalWin_seperate/$total_seperate;
					else
						$totalWin_array[] = 0;

					}
					
					$this->set('XvT_array',$XvT_array);
					$this->set('XvP_array',$XvP_array);
					$this->set('XvZ_array',$XvZ_array);
					$this->set('XvR_array',$XvR_array);
					$this->set('totalXvT_array',$totalXvT_array);
					$this->set('totalXvP_array',$totalXvP_array);
					$this->set('totalXvZ_array',$totalXvZ_array);
					$this->set('totalXvR_array',$totalXvR_array);
					$this->set('total_array',$total_array);
					$this->set('totalWin_array',$totalWin_array);
					$this->set('tournament_names_array',$tournament_names_array);
					
					
	}
	

	function open_matches()
	{
		$id = $this->Auth->user('id');
		
		$matches = $this->User->Match->find('all',array('recursive'=>2,'conditions'=>array('Match.open'=>1,'OR'=>array('Match.player1_id'=>$id,'Match.player2_id'=>$id))));
		$this->set('matches',$matches);
	}

	function edit($id = null) {
		
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$success = 1;
			foreach ($this->data['User'] as $key=>$field)
			{
				if (isset($field))
				{
					if (!$this->User->saveField($key,$field)) $success=0;
				}
			}
			if ($success) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>