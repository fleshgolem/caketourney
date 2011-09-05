<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
 	var $components = array('Email');
 	
	function _sendNewUserMail() {
		
		
		
		$this->Email->to = 'test@test.de';
		$this->Email->subject = 'The tournament "" has beed added.';
		
		$this->Email->replyTo = Configure::read('__Email.replyTo');
		$this->Email->from = Configure::read('__Email.from');
		$this->Email->template = 'new_tournament_email'; // note no '.ctp'
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
	
	function beforeFilter()
    {
        $this->Auth->allow('display');
        parent::beforeFilter();
		
	}
	
	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
			/*if($title_for_layout=='Contact'){
				$this->_contact();
			}*/
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
	function _configuration() {
		
		Configure::load('email');
		debug(Configure::read('__Company.name'));
		Configure::write('Company',array('name'=>'OPSL','slogan'=>'Pizza for your body and soul'));
		debug(Configure::read('__Company.name'));
	}
	
	function _contact() {
		$this->_sendNewUserMail();
	}
}
