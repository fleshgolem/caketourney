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
							<!--[if lt IE 7]>
								  <div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 75px; position: relative;'>
									<div style='position: absolute; right: 3px; top: 3px; font-family: courier new; font-weight: bold;'><a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-cornerx.jpg' style='border: none;' alt='Close this notice'/></a></div>
									<div style='width: 640px; margin: 0 auto; text-align: left; padding: 0; overflow: hidden; color: black;'>
									  <div style='width: 75px; float: left;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-warning.jpg' alt='Warning!'/></div>
									  <div style='width: 275px; float: left; font-family: Arial, sans-serif;'>
										<div style='font-size: 14px; font-weight: bold; margin-top: 12px;'>You are using an outdated browser</div>
										<div style='font-size: 12px; margin-top: 6px; line-height: 12px;'>For a better experience using this site, please upgrade to a modern web browser.</div>
									  </div>
									  <div style='width: 75px; float: left;'><a href='http://www.firefox.com' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-firefox.jpg' style='border: none;' alt='Get Firefox 3.5'/></a></div>
									  <div style='width: 75px; float: left;'><a href='http://www.browserforthebetter.com/download.html' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-ie8.jpg' style='border: none;' alt='Get Internet Explorer 8'/></a></div>
									  <div style='width: 73px; float: left;'><a href='http://www.apple.com/safari/download/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-safari.jpg' style='border: none;' alt='Get Safari 4'/></a></div>
									  <div style='float: left;'><a href='http://www.google.com/chrome' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-chrome.jpg' style='border: none;' alt='Get Google Chrome'/></a></div>
									</div>
								  </div>
								 <![endif]-->
	<div id="container">
		<div id="header">
        <div class="headerwrapper">
        	<h1><?php echo $this->Html->image('logo7.png');?></h1>
            
            <div class="topmenuemainbox">
			<div class="topmenuewrapper">
			<div class="topmenuebox">
				<div class="topmenuemaincontentLeft">
				<div class="containercontentbox">
                	<?php echo $this->Html->link(__('News', true), array('controller' => 'news', 'action' => 'index')); ?>
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
				<div class="topmenuemaincontentMid">
				<div class="containercontentbox">
                	<?php echo $this->Html->link(__('Teams', true), array('controller' => 'teams', 'action' => 'index')); ?>
					
				</div>
				</div>
			</div>
			<div class="topmenuebox">
				<div class="topmenuemaincontentRight">
				<div class="containercontentbox">
					<?php
						if ($this->Session->check('Auth.User')){	
							 echo $this->Html->link(__('Users', true), array('controller' => 'users', 'action' => 'index')); 
						}else{
							echo $this->Html->link(__('Users', true), array('controller' => 'users', 'action' => 'index')); 
                     }?>
				</div>
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
                    	<?php
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							echo $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout')); 
						?>
                     	</div>
                        <?php
						}
						else
						{?>
							<div class="menuebox"><?php
							echo $this->Html->link(__('Login', true), array('controller' => 'users', 'action' => 'login')); 
						?>
                     	</div>
                        <?php
						}
						
						if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							echo $this->Html->link(__('My User Page', true), array('controller' => 'users', 'action' => 'view',$this->Session->read('Auth.User.id'))); 
							?>
                        </div>
                        <?php
						}
						
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							echo $this->Html->link(__('My Account Settings', true), array('controller' => 'users', 'action' => 'account')); 
							?>
                        </div>
                        <?php
						}
						
						
                     	
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
                  
							echo $this->Html->link(__('My Open Matches', true), array('controller' => 'users', 'action' => 'open_matches'));?>
						</div>
						<?php
						}
						?>
                     	
                        <div class="menuebox">
                    	<?php echo $this->Html->link(__('Upcoming Matches', true), array('controller' => 'matches', 'action' => 'upcoming_matches')); ?>
                     	</div>
					</div>
					</div>
				</div>
                
                
                <div class="containerbox">
					<div class="containerheader">
                    <?php 
						echo "Message Center";
					?>
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
                    	<?php
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							echo $this->Html->link(__($this->element('unread_messages'), true), array('controller' => 'messages', 'action' => 'inbox')); 
						?>
                     	</div>
                        <?php
						}
						?>
                        <?php
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							echo $this->Html->link(__('Outbox', true), array('controller' => 'messages', 'action' => 'outbox')); 
						?>
                     	</div>
                        <?php
						}
						?>
							
                        <?php
						
						
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							echo $this->Html->link(__(('New Message'), true), array('controller' => 'messages', 'action' => 'add')); 
							?>
                        </div>
                        <?php
						}
						?>
                     	
					</div>
					</div>
				</div>
                
                
                <div class="containerbox">
					<div class="containerheader">
                    <?php 
						echo "Team Center";
					?>
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
                    	<?php
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
                  
							echo $this->Html->link(__('My Teams', true), array('controller' => 'teams', 'action' => 'my_teams'));?>
						</div>
						<?php
						}
						?>
                     	
					</div>
					</div>
				</div>


                <div class="containerbox">
					<div class="containerheader">
                    <!--<?php 
					if ($this->Session->check('Auth.User')){
						echo "Stream: online"; 
                    }
					else{
						echo "Stream: offline";
					}
					?>-->
					Stream
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
                    	<div class="menuebox">
							<?php echo $this->Html->link('Watch Stream',array('controller'=>'pages','action'=>'stream')); ?>
							<a href="http://www.own3d.tv/b4lrog" target="_blank">Watch VOD's</a>
                        </div>
                        <div class="menuebox">
                    	<!--<?php
                    	if ($this->Session->check('Auth.User')){
							echo $this->Html->link('Watch Stream',array('controller'=>'pages','action'=>'stream')); 
						}
						else {
							?> <a href="http://www.own3d.tv/b4lrog" target="_blank">Watch VOD's</a> <?php ;
						}
						?>-->
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
					Statistic Center
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
					
					<?php	
                    	if ($this->Session->check('Auth.User')){?>
                        <div class="menuebox">
                    	<?php
							
							echo $this->Html->link(__(('My Statistics'), true), array('controller' => 'users', 'action' => 'statistics',$this->Session->read('Auth.User.id'))); 
							?>
                        </div>
                        <?php
						}
						?>
						<div class="menuebox">
							<?php echo $this->Html->link(__('Global Statistics', true), array('controller' => 'tournaments', 'action' => 'statistics')); ?>
                        </div>
					</div>
					</div>
				</div>
                
				<div class="containerbox">
					<div class="containerheader">
					Upcoming Matches
					</div>
					<div class="containercontent">
					<div class="containercontentbox">
					<div class="maincontentbox">
                    <!--SOON<SUP><FONT SIZE="-2">TM</FONT></SUP>-->
                   	<?php
					echo($this->element('upcoming_matches'));?>
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
				
			</div><!-- end righttcol -->
			
		<div id="centercol"><!-- begin centercol -->
			<div class="containerbox">
				<div class="containerMain">
				<div class="maincontentbox">
					<div class="scollbox">
                    	<div class="PostBox">
							<?php echo $this->Session->flash(); ?>
							 <?php echo $this->Session->flash('email'); ?>

						</div>
						
						<?php echo $content_for_layout; ?>
						
					</div>
				</div>
				</div>

			</div>
				
			</div><!-- end centercol -->
				
		</div><!-- end main content area -->
				
		
	
	</div><!-- end wrapper1 -->

	

</div><!-- end wrapper2 -->
		
		<div id="footer" >
        <div id="footerwrapper" >
         <div >
		StarCraft®: Wings of Liberty™ is the copyrighted product of Blizzard Entertainment, Inc.<br />
            © 2011 Blizzard Entertainment, Inc. All rights reserved.
            </div>
		<div class="footeractionleft">
			<?php echo $this->Html->link('Impressum',array('controller'=>'pages','action'=>'impressum'))?>
		</div>
      
        <div class="footeraction">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
			<!--<?php echo $this->element('sql_dump'); ?>-->
        </div>
        <p style="clear: both;">  </p>
		</div>
        </div>
	</div>
	
</body>
</html>