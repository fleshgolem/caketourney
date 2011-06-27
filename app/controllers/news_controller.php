<?php
class NewsController extends AppController {

	var $name = 'News';
	var $components = array('Email');
	var $paginate = array(
		'limit' => 10,
        'order' => array(
			'News.date_posted' => 'desc',  
			//'Post.date_posted' => 'asc'
		)
	);
	function beforeFilter()
    {
		$this->Auth->allow('index');
        parent::beforeFilter();
		
	}
	function _sendNewUserMail($username,$useremail,$news_title,$news_body) {
		
		
		$this->set('username', $username);
		$this->set('news_title', $news_title);
		$this->set('news_body', $news_body);
		$this->Email->to = $useremail;
		$this->Email->subject = $news_title;
		Configure::load('caketourney_configuration');
		$this->Email->replyTo = Configure::read('Email.replyTo');
		$this->Email->from = Configure::read('Email.from');
		$this->Email->template = 'new_news_email'; // note no '.ctp'
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
	function index() {
		$this->News->recursive = 1;
		$this->set('news', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid news', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('news', $this->News->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->News->create();
			$date = date_create('now');
			$current_user = $current_user = $this->Auth->user('id');
			$this->data['News']['user_id']=$current_user;
			$this->data['News']['date_posted']= $date->format('Y-m-d H:i:s');
			if ($this->News->save($this->data)) {
				$this->Session->setFlash(__('The news has been saved', true));
				$subscribers=array();
				$users = $this->News->User->find('all');
				foreach ($users as $users){
					if($users['User']['email_subscriptions'])
					{
						array_push($subscribers,$users['User']);
					}
				}
				foreach($subscribers as $subscriber)
				{
					
					
					$this->_sendNewUserMail( $subscriber['username'],$subscriber['email'], $this->data['News']['title'], $this->data['News']['body']  );
				}
				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid news', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->News->saveField('body',$this->data['News']['body']) && $this->News->saveField('title',$this->data['News']['title'])) {
				if($this->Session->read('Auth.User.admin')){
					$this->News->saveField('edit_reason','[edit]Last edit by [b][blue]'.$this->Session->read('Auth.User.username').'[/blue][/b] because of: '.$this->data['News']['edit_reason'].'[/edit]');
				}
				else{
					$this->News->saveField('edit_reason','[edit]Last edit by [b]'.$this->Session->read('Auth.User.username').'[/b] because of: '.$this->data['News']['edit_reason'].'[/edit]');
				}
				$this->Session->setFlash(__('The news has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->News->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for news', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->News->delete($id)) {
			$this->Session->setFlash(__('News deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('News was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>