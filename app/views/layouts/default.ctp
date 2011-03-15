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
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('OPSL:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link(__('OPSL', true), '/'); ?></h1>
			<div class="buttons" align="right">
				<?php  

				if ($this->Session->check('Auth.User'))
				{
					echo $this->Session->read('Auth.User.username'); 
					echo (' ');
					echo $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout')); 
					echo (' ');
					echo $this->Html->link(__('Account Settings', true), array('controller' => 'users', 'action' => 'account')); 
					echo (' ');
					echo $this->Html->link(__('My Open Matches', true), array('controller' => 'users', 'action' => 'open_matches'));
				}
				else
				{
					echo "Not logged in";
				}
				?>
			</div>
					
		</div>
		<div id="content">
			
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>
			<div class="actions">
				<h3><?php __('Actions'); ?></h3>
				<ul>
					<li><?php echo $this->Html->link(__('New Tournament', true), array('controller' => 'tournaments','action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('List Tournaments', true), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
				</ul>
			</div>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>