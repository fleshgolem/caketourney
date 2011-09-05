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
 * @subpackage    cake.cake.libs.view.templates.elements.email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 
?>
<p>Dear <?php echo $username ?>,</p>
<p>A new comment has been added. Read the comment at:
<a href="http://<?php echo $_SERVER['SERVER_NAME'].'/'.Configure::read('__Caketourney.folder').'caketourney/matches/view/'.$match_id ?>"><?php echo 'Match: '. $player1. ' vs '. $player2 ?></a> </p>
													 
<p>To unsubscribe from this automated message, change you account settings at:
<a href="http://<?php echo $_SERVER['SERVER_NAME'].'/'.Configure::read('__Caketourney.folder').'caketourney/users/account/' ?>">Account Settings</a> </p>
<p>The <?php echo Configure::read('__Caketourney.company_name') ?></p>
