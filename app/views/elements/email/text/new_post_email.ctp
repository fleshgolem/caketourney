<?php
/**
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
 * @subpackage    cake.cake.libs.view.templates.elements.email.text
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
    Dear <?php echo $User['User']['username'] ?>,
    
    
    A new post has been added. Read the post at:
    http://<?php echo $_SERVER['SERVER_NAME'].'/caketourney/threads/view/'.$thread_id ?>
	
    												 
    To unsubscribe from this automated message, change you account settings at:
    http://<?php echo $_SERVER['SERVER_NAME'].'/caketourney/users/account/' ?>
    
    
    The OPSL Team