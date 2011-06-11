<?php
class MessagesController extends AppController {

	var $name = 'Messages';

	function add()
	{

		if(!empty($this->data))
		{
			$this->Message->create();
			$date = date_create('now');
			$this->data['Message']['sender'] = $this->Auth('Auth.User.id');
			$this->data['Message']['date']= $date->format('Y-m-d H:i:s');
			$this->Message->save($this->data);
		}
		
		
		
	}
	function index()
	{
		$this->paginate = array(
			'conditions' => array('Message.recipient_id' => $this->Auth('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$inbox = $this->paginate('Message');
		$this->paginate = array(
			'conditions' => array('Message.sender_id' => $this->Auth('Auth.User.id')),
			'order'=>array('date desc') ,
			'recursive' => 2,
			'limit' => 20);
		$outbox = $this->paginate('Message');
		$this->set('inbox',$inbox);
		$this->set('outbox',$outbox);
	}
	function view($id = null)
	{
		$current_user = $this->Session->read('Auth.User.id');
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
		$message = $this->Message->findById($id);
		if($message['Message']['recipient_id']==$this->Auth('Auth.User.id'));
		{
			$this->Message->id=$id;
			$this->Message->saveField('read',1);
		}
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