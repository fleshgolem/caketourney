<?php
class MessagesController extends AppController {

	var $name = 'Messages';

	function add()
	{
		$recipients = $this->Message->Recipient->find('list',array('order' => array('Recipient.username asc')));
		$this->set(compact('recipients'));
		
		if(!empty($this->data))
		{
			
			
			$this->Message->create();
			$date = date_create('now');
			$this->data['Message']['sender_id'] =  $this->Session->read('Auth.User.id');
			$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
			$this->Message->save($this->data);
			
			
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(__('The Message has been sent', true));
				$this->redirect(array('action' => 'index'));
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
		$this->paginate = array(
			'conditions' => array('Message.sender_id' => $this->Session->read('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$outbox = $this->paginate('Message');
		$this->set('inbox',$inbox);
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
		debug($id);
		if(!empty($this->data))
		{
			$this->Message->create();
			$date = date_create('now');
			debug($id);
			$this->data['Message']['sender_id'] =  $this->Session->read('Auth.User.id');
			$this->data['Message']['recipient_id'] = $reciver;
			$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
			$this->data['Message']['read']= 0;
			$this->data['Message']['title']= 'RE: '.$message['Message']['title'];
			$this->Message->save($this->data);
			
			
			
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(__('The Message has been sent', true));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Message could not be sent. Please, try again.', true));
			}
		}

		
		
		if(empty($this->data)){
			if  ($message['Message']['recipient_id']!=$current_user AND $message['Message']['sender_id']!= $current_user)
			{
				$this->Session->setFlash(__('Access Denied', true));
				$this->redirect(array('action' => 'index'));
			}
			if(!$id)
			{
				$this->Session->setFlash(__('Invalid Message', true));
				$this->redirect(array('action' => 'index'));
			}
			
			if($message['Message']['recipient_id']==$this->Session->read('Auth.User.id'));
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
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(__('Message deleted', true));
			$this->redirect(array('action'=>'index'));
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