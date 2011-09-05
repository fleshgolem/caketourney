<?php
class ContactsController extends AppController {

	var $name = 'Contacts';
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
		$this->Auth->allow('contact');
        parent::beforeFilter();
		
	}
	
	function _sendNewUserMail($username,$useremail,$mail_title,$mail_body) {
		
		
		$this->set('username', $username);
		$this->set('mail_title', $mail_title);
		$this->set('mail_body', $mail_body);
		$this->Email->to = Configure::read('__Email.replyTo');
		$this->Email->subject = $mail_title;
		
		$this->Email->replyTo = $useremail;
		$this->Email->from = Configure::read('__Email.from');
		$this->Email->template = 'new_email'; // note no '.ctp'
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
	function contact() {
		
		if (!empty($this->data)) {
			 $this->Contact->set($this->data);
			 if ($this->Contact->validates()) {
				
				$this->_sendNewUserMail( $this->data['Contact']['name'],$this->data['Contact']['email'],$this->data['Contact']['title'], $this->data['Contact']['body']  );
			 }
		}
	}

	
}
?>