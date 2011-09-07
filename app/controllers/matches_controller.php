<?php
App::import('Controller', 'Tournaments');
class MatchesController extends AppController {
	var $components = array('Email');
	var $name = 'Matches';
	var $helpers = array('Race','Text','Bbcode');
	function beforeFilter()
    {
		$this->Auth->allow('view','upcoming_matches');
        parent::beforeFilter();
		
	}
	function _sendNewUserMail($username,$useremail,$player1,$player2,$match_id) {
		
		
		$this->set('username', $username);
		$this->set('player1', $player1);
		$this->set('player2', $player2);
		$this->set('match_id', $match_id);
		$this->Email->to = $useremail;
		$this->Email->subject = 'New comment in match "'. $player1. ' vs '. $player2.'"';
		
		$this->Email->replyTo = Configure::read('__Email.replyTo');
		$this->Email->from = Configure::read('__Email.from');
		$this->Email->template = 'new_comment_email'; // note no '.ctp'
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
	function generate ($round_id, $number_in_round, $games_per_match)
	{
		$this->Match->create();
		$this->data['Match']['round_id']=$round_id;
		$this->data['Match']['number_in_round']=$number_in_round;
		$this->data['Match']['games']=$games_per_match;
		$this->data['Match']['open']=1;
		if ($this->Match->save($this->data)) {
				
		} 
		else 
		{
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
		}
		
	}
	function generate_with_matchup ($round_id, $number_in_round, $games_per_match, $player1_id, $player2_id)
	{
		$this->Match->create();
		$this->data['Match']['round_id']=$round_id;
		$this->data['Match']['number_in_round']=$number_in_round;
		$this->data['Match']['games']=$games_per_match;
		$this->data['Match']['player1_id']=$player1_id;
		$this->data['Match']['player2_id']=$player2_id;
		
		if(!$player1_id){
			$this->data['Match']['player2_score']=1;
			$this->data['Match']['open']=0;
		}
		
		else if (!$player2_id){
			$this->data['Match']['player1_score']=1;
			$this->data['Match']['open']=0;
		}
		else
		{
			$this->data['Match']['open']=1;
		}
		if ($this->Match->save($this->data)) {
		} 
		else 
		{
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
		}
		
	}
	
	function index() {
		$this->Match->recursive = 0;
		$this->set('matches', $this->paginate());
	}
	
	function view($id = null) {
		// Get User's id for authentication
        $user_id = $this->Auth->user('id');
		$this->set('current_user',$user_id);
		if ($this->Match->field('player1_id') == $user_id OR $this->Match->field('player2_id') == $user_id  OR $this->Session->read('Auth.User.admin'))
		{
			$this->set('report',true);
		}
		else
		{
			$this->set('report',false);
		}
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {

			if ((!$this->Session->read('Auth.User.admin')) AND ($this->Match->field('player1_id') != !$this->Session->read('Auth.User.id')) AND ($this->Match->field('player2_id') != !$this->Session->read('Auth.User.id')))
			{
				$this->Session->setFlash(__('Access denied', true));
				//$this->redirect(array('action'=>'index'));
			}

			$this->data['Match']['open']=0;
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				
				$Tournaments = new TournamentsController;
				$Tournaments->ConstructClasses();
			
				$Tournaments->report_match($this->Match->id, $this->data['Match']['player1_score'],$this->data['Match']['player2_score']);
				}
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$match=$this->Match->read(null, $id);
		$this->set('match', $match );
		$round=$this->Match->Round->findById($match['Match']['round_id']);
		$this->set('round', $round);
		$comments=$this->Match->Comment->find('all',array('conditions'=>array('Comment.match_id'=>$id),'order'=>array('Comment.date_posted DESC')));
		$this->set('comments' , $comments);
		$replays=$this->Match->Replay->find('all',array('conditions'=>array('Replay.match_id'=>$id)));
		$this->set('replays' , $replays);
	}
	
	function submit($id = null) {
		// Get User's id for authentication
        $user_id = $this->Auth->user('id');
		$this->set('current_user',$user_id);
		if ($this->Match->field('player1_id') == $user_id OR $this->Match->field('player2_id') == $user_id  OR $this->Session->read('Auth.User.admin'))
		{
			$this->set('report',true);
		}
		else
		{
			$this->set('report',false);
		}
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid match', true));
			
			$this->redirect(array('action'=>'view',$id));
		}
		
		
		
		$score_1 = array();
		$score_2 = array();
		
		for ($i = 0; $i <= (($this->Match->field('games')-1)/2)+1; $i++) {
    		$score_1[] = $i;
			$score_2[] = $i;
		}
		
		
		
		if (!empty($this->data)) {

			if ((!$this->Session->read('Auth.User.admin')) AND ($this->Match->field('player1_id') != !$this->Session->read('Auth.User.id')) AND ($this->Match->field('player2_id') != !$this->Session->read('Auth.User.id')))
			{
				$this->Session->setFlash(__('Access denied', true));
				//$this->redirect(array('action'=>'index'));
			}
			
			if (($this->data['Match']['player1_score']+$this->data['Match']['player2_score'])>$this->Match->field('games')) {
				$this->Session->setFlash(__('The score cannot be '.$this->data['Match']['player1_score'].':'.$this->data['Match']['player2_score'].' in a Bo'.$this->Match->field('games'), true));
				
				$this->redirect(array('action'=>'submit',$id));
			}

			$this->data['Match']['open']=0;
			if(!$this->Match->field('date')){
				$date = date_create('now');
				
				$this->data['Match']['date']=$date->format('Y-m-d H:i:s');
				
			}
			
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				
				$Tournaments = new TournamentsController;
				$Tournaments->ConstructClasses();
				$Tournaments->report_match($this->Match->id, $this->data['Match']['player1_score'],$this->data['Match']['player2_score']);
				$this->redirect(array('action'=>'view',$id ));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$match=$this->Match->read(null, $id);
		$this->set('match', $match );
		$round=$this->Match->Round->findById($match['Match']['round_id']);
		$this->set('round', $round);
		$comments=$this->Match->Comment->find('all',array('conditions'=>array('Comment.match_id'=>$id),'order'=>array('Comment.date_posted DESC')));
		$this->set('comments' , $comments);
		$replays=$this->Match->Replay->find('all',array('conditions'=>array('Replay.match_id'=>$id)));
		$this->set('replays' , $replays);
		
		$this->set('score_1' , $score_1);
		$this->set('score_2' , $score_2);
	}

	function submitdate($id = null) {
		// Get User's id for authentication
        $user_id = $this->Auth->user('id');
		$this->set('current_user',$user_id);
		if ($this->Match->field('player1_id') == $user_id OR $this->Match->field('player2_id') == $user_id  OR $this->Session->read('Auth.User.admin'))
		{
			$this->set('report',true);
		}
		else
		{
			$this->set('report',false);
		}
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {

			if ((!$this->Session->read('Auth.User.admin')) AND ($this->Match->field('player1_id') != !$this->Session->read('Auth.User.id')) AND ($this->Match->field('player2_id') != !$this->Session->read('Auth.User.id')))
			{
				$this->Session->setFlash(__('Access denied', true));
				//$this->redirect(array('action'=>'index'));
			}

			$this->data['Match']['open']=0;
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				
				$Tournaments = new TournamentsController;
				$Tournaments->ConstructClasses();
			
				$Tournaments->report_match($this->Match->id, $this->data['Match']['player1_score'],$this->data['Match']['player2_score']);
				}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$match=$this->Match->read(null, $id);
		$this->set('match', $match );
		$round=$this->Match->Round->findById($match['Match']['round_id']);
		$this->set('round', $round);
		$comments=$this->Match->Comment->find('all',array('conditions'=>array('Comment.match_id'=>$id),'order'=>array('Comment.date_posted DESC')));
		$this->set('comments' , $comments);
		$replays=$this->Match->Replay->find('all',array('conditions'=>array('Replay.match_id'=>$id)));
		$this->set('replays' , $replays);
	}

	function edit($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'view',$id));
		}
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action'=>'view',$id));
		}
		if (!empty($this->data)) {
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The match has been saved', true));
				$Tournaments = new TournamentsController;
				$Tournaments->ConstructClasses();
				$Tournaments->report_match($this->Match->id, $this->data['Match']['player1_score'],$this->data['Match']['player2_score']);
				$this->redirect(array('action'=>'view',$id));
			} else {
				$this->Session->setFlash(__('The match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$match=$this->Match->read(null, $id);
		$round=$this->Match->Round->findById($match['Match']['round_id']);
		
		$this->Match->Round->Tournament->User->bindModel(array('hasOne' => array('UsersTournaments')));
		
		
		$player1s = $this->Match->Round->Tournament->User->find('list',array('recursive'=>1,'conditions'=>array('UsersTournaments.tournament_id'=>$round['Tournament']['id']),'order'=>array('User.username asc')));
		$this->Match->Round->Tournament->User->bindModel(array('hasOne' => array('UsersTournaments')));
		$player2s = $this->Match->Round->Tournament->User->find('list',array('recursive'=>1,'conditions'=>array('UsersTournaments.tournament_id'=>$round['Tournament']['id']),'order'=>array('User.username asc')));
		$this->set(compact('rounds', 'player1s', 'player2s'));
	}

	function delete($id = null) {
	if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'view',$id));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'view',$id));
		}
		if ($this->Match->delete($id)) {
			$this->Session->setFlash(__('Match deleted', true));
			$this->redirect(array('action'=>'view',$id));
		}
		$this->Session->setFlash(__('Match was not deleted', true));
		$this->redirect(array('action'=>'view',$id));
	}
	function set_date($id) 
	{
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid match', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			$this->Match->id=$id;
			if ((!$this->Session->read('Auth.User.admin')) AND ($this->Match->field('player1_id') != $this->Session->read('Auth.User.id')) AND ($this->Match->field('player2_id') != $this->Session->read('Auth.User.id')))
			{
				$this->Session->setFlash(__('Access denied', true));
				unset($this->data);
				$this->redirect(array('action'=>'view',$id));
			}
			if ($this->Match->save($this->data)) {
				//debug($this->data);
				$this->Session->setFlash(__('The date has been saved', true));
				$this->redirect(array('action'=>'view',$id));
			}
		}
	}
	function upcoming_matches()
	{
		
		$today = getdate();
		$today['hours']=$today['hours']-1;
		$matches = $this->Match->find('all',
			array(
				'conditions' => array('Match.date >' =>date('Y-m-d'), 'Match.open' => 1), //array of conditions
				'recursive' => 1, //int
				'order' => array('Match.date ASC'), //string or array defining order
				'limit' => 10 //int
				));
		$this->set('matches',$matches);
		if (isset($this->params['requested'])) 
		{            
			return $matches;        
		}
	}

		
		
	function post_comment($id){
		$current_user = $current_user = $this->Auth->user('id');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('action'=>'index'));
		}
		if(!empty($this->data))
		{
			$this->Match->Comment->create();
			$user_id = $this->Auth->user('id');
			$this->data['Comment']['user_id']=$user_id;
			$this->data['Comment']['match_id']=$id;
			$date = date_create('now');

			$this->data['Comment']['date_posted']=$date->format('Y-m-d H:i:s');
			//load configuration
			
			//find subscribers and message them
			$subscribers=array();
			$match = $this->Match->read(null,$id);
			if($match['Player1']['subscribe_own_comments'])
			{
				array_push($subscribers,$match['Player1']);
			}
			if($match['Player2']['subscribe_own_comments'])
			{
				array_push($subscribers,$match['Player2']);
			}
			
			foreach($subscribers as $subscriber)
			{
				if($subscriber['id']!=$current_user){
					$this->Match->Player1->Message->create();
					$date = date_create('now');
					$this->data['Message']['sender_id']=null;
					$this->data['Message']['recipient_id']=$subscriber['id'];
					$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
					$this->data['Message']['title']= 'New comment in match "'. $match['Player1']['username']. ' vs '. $match['Player2']['username'].'"';
					
					//TODO: machen! ;)
					$this->data['Message']['body']= 'A new comment has been added. Read the comment at:
													 http://'.$_SERVER['SERVER_NAME'].'/'.Configure::read('__Caketourney.folder').'caketourney/matches/view/'.$match['Match']['id'].'
													 
													 To unsubscribe from this automated message, change you account settings at:
													 http://'.$_SERVER['SERVER_NAME'].'/'.Configure::read('__Caketourney.folder').'caketourney/users/account/';
					$this->Match->Player1->Message->save($this->data);
					if($subscriber['email_subscriptions']){
						$this->_sendNewUserMail( $subscriber['username'],$subscriber['email'], $match['Player1']['username'],$match['Player2']['username'] ,$match['Match']['id'] );
					}	
				}
			}
			$this->Match->Comment->save($this->data);
			$this->redirect(array('action' => 'view',$id));
		}
	}
	function upload_replays($id){
		if ((!$this->Session->read('Auth.User.admin')) AND ($this->Match->field('player1_id') != $this->Session->read('Auth.User.id')) AND ($this->Match->field('player2_id') != $this->Session->read('Auth.User.id')))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('controller'=>'tournaments','action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for match', true));
			$this->redirect(array('controller'=>'tournaments','action'=>'index'));
		}
		if(!empty($this->data))
		{
			$this->data['Replay']['match_id']=$id;
			foreach ($this->data['Replay'] as $i=>$replay)
			{
				if(!empty($this->data['Replay'][$i]['file']))
				{
					$this->Match->Replay->create();
					
					$this->data['Replay']['file']=$this->data['Replay'][$i]['file'];
					$this->Match->Replay->save($this->data);
				}
			}
			$this->redirect(array('action' => 'view',$id));
			
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$this->set('match',$this->Match->read(null,$id));
	}
}
?>