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

		/*echo $this->Html->css('cake.generic');*/
		echo $this->Html->css('bracket');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
        	<h1></h1>
            
            <div class="topmenuemainbox">
			<div class="topmenuewrapper">
			<div class="topmenuebox">
				<div class="topmenuemaincontentLeft">
				<div class="containercontentbox">
					<?php echo $this->Html->link('Home',array('controller'=>'pages','action'=>'home'))?>
				</div>
				</div>
			</div>
			<div class="topmenuebox">
				<div class="topmenuemaincontentMid">
				<div class="containercontentbox">
					<?php echo $this->Html->link(__('Tournaments', true), array('controller' => 'tournaments', 'action' => 'index')); ?>
				</div>
				</div>
			</div>
			<div class="topmenuebox">
				<div class="topmenuemaincontentMid">
				<div class="containercontentbox">
                	<?php echo $this->Html->link(__('Forum', true), array('controller' => 'threads', 'action' => 'index')); ?>
					
				</div>
				</div>
			</div>
			<div class="topmenuebox">
				<div class="topmenuemaincontentRight">
				<div class="containercontentbox">
					<?php
						if ($this->Session->check('Auth.User')){	
							 echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); 
						}else{
							echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); 
                     }?>
				</div>
				</div>
			</div>
			</div>
			</div>
    
			
					
		</div>
        <div id="wrapper1"><!-- sets background to white and creates full length leftcol-->
	
	
	
	<div id="wrapper2"><!-- sets background to white and creates full length rightcol-->
	
		<div id="maincol"><!-- begin main content area -->
				
			<div id="leftcol"><!-- begin leftcol -->
				<div class="containerbox">
					<div class="containerheader">
                    <?php 
					if ($this->Session->check('Auth.User')){
						echo $this->Session->read('Auth.User.username'); 
                    }
					else{
						echo "Not logged in";
					}
					?>
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
                    	<div class="menuebox">
                    	<?php
                    	if ($this->Session->check('Auth.User')){
							echo $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout')); 
						}
						?>
                     	</div>
                        <div class="menuebox">
                    	<?php
                    	if ($this->Session->check('Auth.User')){
							echo $this->Html->link(__('Account Settings', true), array('controller' => 'users', 'action' => 'account')); 
						}
						?>
                     	</div>
                        <div class="menuebox">
                    	<?php
                    	if ($this->Session->check('Auth.User')){
							echo $this->Html->link(__('My Open Matches', true), array('controller' => 'users', 'action' => 'open_matches'));
						}
						?>
                     	</div>
                        <div class="menuebox">
                    	<?php
                    	/*if ($this->Session->check('Auth.User')){
							echo $this->Html->link('My Tournament Settings', array('action'=>'settings',$tournament['SwissTournament']['id']));
						}*/
						?>
                     	</div>
					</div>
					</div>
				</div>
                <!--

                <div class="containerbox">
					<div class="containerheader">
                    <?php
                    	if ($this->Session->check('Auth.User')){
                   	 		echo"Actions";
						}
						else{
							echo"Not logged in";
					}?>
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
                    	<div class="menuebox">
                    	<?php if ($this->Session->read('Auth.User.admin'))
						{ 
							echo $this->Html->link(__('New Tournament', true), array('controller' => 'tournaments','action' => 'add')); 
						}?>

                     	</div>
                        <div class="menuebox">
                    	<?php
						if ($this->Session->check('Auth.User')){	
							 echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); 
                     	}?>
                        </div>
                        <div class="menuebox">
                    	<?php
                    	if ($this->Session->check('Auth.User')){
							echo $this->Html->link(__('My Open Matches', true), array('controller' => 'users', 'action' => 'open_matches'));
						}?>
						
                     	</div>
					</div>
					</div>
				</div>
                -->
			</div><!-- end leftcol -->
				
			<div id="rightcol"><!-- begin rightcol -->
				<div class="containerbox">
					<div class="containerheader">
					Upcoming Matches
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
					<div class="maincontentbox">
                    <!--SOON<SUP><FONT SIZE="-2">TM</FONT></SUP>-->
					<?php echo($this->element('upcoming_matches'));?>
					<?php /*foreach($matches as $match){?>
						<?php 
							if ($match['Player1']!=null)
								echo $this->Race->small_img($match['Player1']['race']);
								//Link to match
								$matchtitle = '';
							if ($match['Player1']!=null)
								$matchtitle .=($match['Player1']['username']);
								$matchtitle .= ' vs ' ;
							if ($match['Player2']!=null)
								$matchtitle .=($match['Player2']['username']);
								echo $this->Html->link(($matchtitle), array('controller' => 'matches', 'action' => 'view',$match['Match']['id'])); 	
							if ($match['Player2']!=null)
								echo $this->Race->small_img($match['Player2']['race']);
						?>
                   <?php }*/?>

					</div>
					</div>
					</div>
				</div>
				<div class="containerbox">
					<div class="containerheader">
					Statistic Center
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
					<div class="maincontentbox">
					SOON<SUP><FONT SIZE="-2">TM</FONT></SUP>
					</div>
					</div>
					</div>
				</div>
			</div><!-- end righttcol -->
			
		<div id="centercol"><!-- begin centercol -->
			<div class="containerbox">
				<div class="containerheader">
					Main Content
				</div>
				<div class="containercontent">
				<div class="maincontentbox">
					<div class="scollbox">
						<?php echo $this->Session->flash(); ?>
						<?php echo $content_for_layout; ?>
						
					</div>
				</div>
				</div>

			</div>
				
			</div><!-- end centercol -->
				
		</div><!-- end main content area -->
				
		
	
	</div><!-- end wrapper1 -->

	

</div><!-- end wrapper2 -->
		
		<div id="footer">
		
		<div align="left">
			<?php echo $this->Html->link('Impressum',array('controller'=>'pages','action'=>'impressum'))?>
		</div>
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
			<!--<?php echo $this->element('sql_dump'); ?>-->
		</div>
	</div>
	
</body>
</html>