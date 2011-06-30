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
		$this->Email->delivery = 'debug';
		//$this->Email->delivery = 'mail';
		$this->Email->send();
		$this->Email->reset();
		
	}
	function contact() {
		debug($this->data);
		if (!empty($this->data)) {
			debug('test2');
			$this->_sendNewUserMail( 'a','a@gmx.de', 'asd', 'asd'  );
		}
	}

	
}
?>