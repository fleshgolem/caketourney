<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $helpers = array('Race','Text','Bbcode','Html','Form','Session', 'Time');
	var $components = array('Auth','Session','Cookie','AutoLogin');
	//var $helpers = array('Race');

/**
     * Before Render
     */
    function beforeRender()
    {
        unset($this->data['User']['password']);
        unset($this->data['User']['password_confirm']);
    }
	function beforeFilter()
	{
		$this->AutoLogin->cookieName = 'rememberMe';
		$this->AutoLogin->expires = '+1 month';
		$this->AutoLogin->settings = array(
        'controller' => 'Users',
        'loginAction' => 'login',
        'logoutAction' => 'logout'
    	);
		$this->fetchSettings();
	}
	/* Function which read settings from DB and populate them in constants */
	function fetchSettings(){
	   //Loading model on the fly
	   Controller::loadModel('Setting');
	   $settings_array = $this->Setting->find('all');
		
	   //$settings = new Setting();
	   //Fetching All params
	   //$settings_array = $setting->findAll();
	   foreach($settings_array as $setting){
		 
		  Configure::write("__".$setting['Setting']['key'], $setting['Setting']['pair']);
		  
	   }
	}
}
