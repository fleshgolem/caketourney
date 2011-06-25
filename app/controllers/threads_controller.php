<?php
class ThreadsController extends AppController {

	var $name = 'Threads';
	var $components = array('Email');
	var $helpers = array('Text','Bbcode');
	var $paginate = array(
		'limit' => 25,
        'order' => array(
			'Thread.icon' => 'desc',
			'Thread.date_modified' => 'desc',  
			//'Post.date_posted' => 'asc'
		)
	);
	function index() {
		$this->Thread->recursive = 1;
		$this->set('threads', $this->paginate());
	}
	
	
	function _sendNewUserMail($id,$thread_title,$thread_id) {
		
		$User = $this->Thread->Post->User->read(null,$id);
		$this->set('User', $User);
		$this->set('thread_title', $thread_title);
		$this->set('thread_id', $thread_id);
		$this->Email->to = $User['User']['email'];
		$this->Email->subject = 'New post in thread "'. $thread_title.'"';
		$this->Email->replyTo = 'OPSL@rwth-physiker.de';
		$this->Email->from = 'The OPSL Team <OPSL@rwth-physiker.de>';
		$this->Email->template = 'new_post_email'; // note no '.ctp'
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
	
	function view($id = null) 
	{
		$this->Thread->recursive = 1;
		$current_user = $current_user = $this->Auth->user('id');
		$this->set('current_user',$current_user);
		if(!empty($this->data))
		{
			
			
			$date = date_create('now');
			$this->data['Post']['user_id']=$current_user;
			$this->data['Post']['date_posted']= $date->format('Y-m-d H:i:s');
			$this->data['Post']['thread_id'] = $id;
			if ($this->Thread->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
			}
			$this->data['Thread']['date_modified']=$date->format('Y-m-d H:i:s');
			$this->data['Thread']['last_poster_id']=$current_user;
			$this->Thread->save($this->data);
			
			//find subscribers and message them
			$subscribers=array();
			$thread = $this->Thread->find('first',array('recursive'=>2, 'conditions'=> array('Thread.id' =>$id)));
			//debug($thread);
			foreach ($thread['Post'] as $post){
				if($post['User']['subscribe_own_posts'] AND !in_array($post['User'],$subscribers))
				{
					array_push($subscribers,$post['User']);
				}
			}
			
			foreach($subscribers as $subscriber)
			{
				if($subscriber['id']!=$current_user){
					$this->Thread->Post->User->Message->create();
					$this->data['Message']['sender_id']=null;
					$this->data['Message']['recipient_id']=$subscriber['id'];
					$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
					$this->data['Message']['title']= 'New post in thread "'. $thread['Thread']['title'].'"';
					
					//TODO: machen! ;)
					$this->data['Message']['body']= 'A new post has been added. Read the post at:
													 http://'.$_SERVER['SERVER_NAME'].'/caketourney/threads/view/'.$thread['Thread']['id'].'
													 
													 To unsubscribe from this automated message, change you account settings at:
													 http://'.$_SERVER['SERVER_NAME'].'/caketourney/users/account/';
					$this->Thread->Post->User->Message->save($this->data);
					
					if($subscriber['email_subscriptions']){
						$this->_sendNewUserMail( $subscriber['id'], $thread['Thread']['title'],$thread['Thread']['id'] );
					}
				}
				
			}
			//$this->redirect(array('action' => 'view',$id));
		}
		if(empty($this->data))
		{
			$this->data = $this->Thread->read(null, $id);
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid thread', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('thread', $this->Thread->read(null, $id));
		$this->paginate = array(
			'conditions' => array('Post.thread_id' => $id),
			'order'=>array('date_posted asc') ,
			'recursive' => 2,
			'limit' => 20);
		$posts = $this->paginate('Post');
		$this->set('posts', $posts);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Thread->create();
			$this->Thread->Post->create();
			$date = date_create('now');
			$current_user = $current_user = $this->Auth->user('id');
			$this->data['Thread']['original_poster_id']=$current_user;
			$this->data['Thread']['last_poster_id']=$current_user;
			$this->data['Thread']['date_modified']= $date->format('Y-m-d H:i:s');
			
			switch ($this->data['Thread']['icon']){
				case 0:
					$this->data['Thread']['icon']='default';
					break;
				case 1:
					$this->data['Thread']['icon']='thread_attention.png';
					break;
				case 2:
					$this->data['Thread']['icon']='thread_bomb.png';
					break;
				case 3:
					$this->data['Thread']['icon']='thread_bulb.png';
					break;
				case 4:
					$this->data['Thread']['icon']='thread_check.png';
					break;
				case 5:
					$this->data['Thread']['icon']='thread_flash.png';
					break;
				case 6:
					$this->data['Thread']['icon']='thread_heart.png';
					break;
				case 7:
					$this->data['Thread']['icon']='thread_star.png';
			}
			
			if ($this->Thread->save($this->data)) {
				$id = $this->Thread->id;
				$this->data['Post']['user_id']=$current_user;
				$this->data['Post']['date_posted']= $date->format('Y-m-d H:i:s');
				$this->data['Post']['thread_id'] = $id;
				$this->Thread->Post->save($this->data);
				$this->Session->setFlash(__('The thread has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thread could not be saved. Please, try again.', true));
			}
		}

		$this->set(compact('users'));
	}


	function delete($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Thread->delete($id)) {
			$this->Session->setFlash(__('Thread deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Thread was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>