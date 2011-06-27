<?php
class MessagesController extends AppController {

	var $name = 'Messages';
	var $components = array('Email');
	
	function _sendNewUserMail($username,$useremail,$message_title,$message_id,$message_sender) {
		
		$this->set('message_sender', $message_sender);
		$this->set('username', $username);
		$this->set('message_title', $message_title);
		$this->set('message_id', $message_id);
		$this->Email->to = $useremail;
		$this->Email->subject = $message_title;
		Configure::load('caketourney_configuration');
		$this->Email->replyTo = Configure::read('Email.replyTo');
		$this->Email->from = Configure::read('Email.from');
		$this->Email->template = 'new_message_email'; // note no '.ctp'
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
	
	function add($recipiant_id=0)
	{
		if($recipiant_id==0){
			$recipients = $this->Message->Recipient->find('list',array('order' => array('Recipient.username asc')));
		}
		if($recipiant_id!=0){
			$recipients = $this->Message->Recipient->find('list',array('conditions' => array('Recipient.id'=>$recipiant_id),'order' => array('Recipient.username asc')));
		}
		$this->set(compact('recipients'));
		
		if(!empty($this->data))
		{
			
			
			$this->Message->create();
			$date = date_create('now');
			$this->data['Message']['sender_id'] =  $this->Session->read('Auth.User.id');
			$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
			
			
			
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(__('The Message has been sent', true));
				$recipiant = $this->Message->Recipient->find('first', array(
							'conditions'=>array('Recipient.id'=>$this->data['Message']['recipient_id']),
							'contain'=>array(
								
								)
							));
				//$recipiant=$this->Message->Recipient->find('first',array('condition' => array('Recipient.id' => $this->data['Message']['recipient_id'])));
				
				
				if($recipiant['Recipient']['email_subscriptions']){
					$this->_sendNewUserMail( $recipiant['Recipient']['username'],$recipiant['Recipient']['email'], $this->data['Message']['title'],$this->Message->getLastInsertId(),$this->Session->read('Auth.User.username')  );
				}
				
				
				//$this->redirect(array('action' => 'outbox'));
			} else {
				$this->Session->setFlash(__('The Message could not be sent. Please, try again.', true));
			}
			
		}
		
		
		
		
	}
	function index()
	{
		
		$this->paginate = array(
			'conditions' => array('Message.recipient_id' => $this->Session->read('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$inbox = $this->paginate('Message');
		/*$this->paginate = array(
			'conditions' => array('Message.sender_id' => $this->Session->read('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$outbox = $this->paginate('Message');*/
		$this->set('inbox',$inbox);
		//$this->set('outbox',$outbox);
		
	}
	
	function inbox()
	{
		
		$this->paginate = array(
			'conditions' => array('Message.recipient_id' => $this->Session->read('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$inbox = $this->paginate('Message');
		
		$this->set('inbox',$inbox);
		
		
	}
	
	function outbox()
	{
		
		$this->paginate = array(
			'conditions' => array('Message.sender_id' => $this->Session->read('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$outbox = $this->paginate('Message');
		$this->set('outbox',$outbox);
		
	}
	
	function view($id = null)
	{
		
		$message = $this->Message->findById($id);
		$current_user = $this->Session->read('Auth.User.id');
		$this->set('current_user',$current_user);
		$reciver = $message['Message']['sender_id'];
		$this->set($reciver,'reciver');
		
		$recipients = $this->Message->Recipient->find('list',array('order' => array('Recipient.username asc')));
		$this->set(compact('recipients'));
		
		if(!empty($this->data))
		{
			$this->Message->create();
			$date = date_create('now');
			
			$this->data['Message']['sender_id'] =  $this->Session->read('Auth.User.id');
			$this->data['Message']['recipient_id'] = $reciver;
			$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
			$this->data['Message']['read']= 0;
			$this->data['Message']['reply']=$message['Message']['reply']+1;
			$this->data['Message']['title']= 'RE: '.$message['Message']['title'];
			$this->Message->save($this->data);
			
			
			
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(__('The Message has been sent', true));
				$this->redirect(array('action' => 'outbox'));
			} else {
				$this->Session->setFlash(__('The Message could not be sent. Please, try again.', true));
			}
		}

		
		
		if(empty($this->data)){
			if  ($message['Message']['recipient_id']!=$current_user AND $message['Message']['sender_id']!= $current_user)
			{
				$this->Session->setFlash(__('Access Denied', true));
				$this->redirect(array('action' => 'inbox'));
			}
			if(!$id)
			{
				$this->Session->setFlash(__('Invalid Message', true));
				$this->redirect(array('action' => 'inbox'));
			}
			
			if($message['Message']['recipient_id'] == $this->Session->read('Auth.User.id'))
			{
				$this->Message->id=$id;
				
				$this->Message->saveField('read',1);
				
				
			}
			
			$this->data = $this->Message->read(null, $id);
		}
		$this->set('message',$message);
	}
	function delete($id = null)
	{
		$current_user = $this->Session->read('Auth.User.id');
		$message = $this->Message->findById($id);
		if (!$this->Session->read('Auth.User.admin') AND $message['Message']['recipient_id']!=$current_user)
		{
			$this->Session->setFlash(__('Access Denies', true));
			$this->redirect(array('action' => 'inbox'));
		}
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(__('Message deleted', true));
			$this->redirect(array('action'=>'inbox'));
		}

	}
	function unread_messages()
	{
		$current_user = $this->Session->read('Auth.User.id');
		$unread_messages= $this->Message->find('count', array('conditions' => array('Message.read' => 0, 'Message.recipient_id'=>$current_user)));
		$this->set('unread_messages',$unread_messages);
		if (isset($this->params['requested'])) 
		{     
			return $unread_messages;        
		}
	}
	
	
}
?>