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
<p>A new tournament has been added. Sign up for the tournament at:
<a href=http://<?php echo $_SERVER['SERVER_NAME'].'/caketourney/tournaments/view/'.$tournament_id ?>"><?php echo $tournament_name ?></a> </p>
													 
<p>To unsubscribe from this automated message, change you account settings at:
<a href="http://<?php echo $_SERVER['SERVER_NAME'].'/caketourney/users/account/' ?>">Account Settings</a> </p>
<p>The OPSL Team</p>
