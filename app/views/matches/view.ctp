<div class="matches view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'] .' vs '.$match['Player2']['username'].' '.$this->Race->small_img($match['Player2']['race']));?></h2>
	</div> 
	
     <p style="clear: both;"></p>  
</div>
</div>

<div class="PostBox">
<div class="ThreadTitleBox">
	 <div class="bottomactionleft"> <?php
		
			echo $this->Html->link("Back to Tournament",  array('controller' => 'tournaments', 'action' => 'view', $match['Round']['tournament_id']));
		?>
     </div>
	<div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link("Edit", array('action' => 'edit',$match['Match']['id']));
		}?>
     </div>
     <p style="clear: both;"></p>  
</div>
</div>



<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBoxBig">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
					<div class="spacebox2em"> </div>
					<div class="matchbox">
                        <div class="namesbox">
                        <?php
                        if($match['Match']['player1_id']!=$this->Session->read('Auth.User.id')){?>
                            <div class="topbox">
                             <?php
								if ($match['Player1']['username']!=null){
                              		echo $this->Html->link(__($match['Player1']['username'], true), array('controller' => 'users', 'action' => 'view', $match['Player1']['id']));
								}
								else{
									?> <a href=""> <?php echo "-";?> </a><?php }
								?>
                             </div>
                             <?php } ?>
                           <?php
                        if($match['Match']['player1_id']==$this->Session->read('Auth.User.id')){?>
                            <div class="owntopbox">
                             <?php
								if ($match['Player1']['username']!=null){
                              		echo $this->Html->link(__($match['Player1']['username'], true), array('controller' => 'users', 'action' => 'view', $match['Player1']['id']));
								}
								else{
									?> <a href=""> <?php echo "-";?> </a><?php }
								?>
                             </div>
                             <?php } ?>
                             
                            <?php
                       	 if($match['Match']['player2_id']!=$this->Session->read('Auth.User.id')){?>  
                            <div class="bottombox"> 
                            <?php
								if ($match['Player2']['username']!=null){
                              		echo $this->Html->link(__($match['Player2']['username'], true), array('controller' => 'users', 'action' => 'view', $match['Player2']['id']));
								}
								else{
									?> <a href=""> <?php echo "-";?> </a><?php }
								?>
							
                            </div>
                           <?php } ?>
                           
                           <?php
                       	 if($match['Match']['player2_id']==$this->Session->read('Auth.User.id')){?>  
                            <div class="ownbottombox"> 
                            <?php
								if ($match['Player2']['username']!=null){
                              		echo $this->Html->link(__($match['Player2']['username'], true), array('controller' => 'users', 'action' => 'view', $match['Player2']['id']));
								}
								else{
									?> <a href=""> <?php echo "-";?> </a><?php }
								?>
							
                            </div>
                           <?php } ?>
                        </div>
                        <div class="scorebox">
                            <div class="scoretop"> 
                             <?php
								if ($match['Match']['player1_score']!=null){
									if ($match['Match']['player1_score']>=$match['Match']['player2_score']){?>
										<div class="scorewin"><a href="">
										<?php echo $match['Match']['player1_score'];?>
										</a></div><?php
									}
									if ($match['Match']['player1_score']<$match['Match']['player2_score']){?>
										<a href="">
										<?php echo $match['Match']['player1_score'];?>
										</a><?php
									}
								}
								else{
									?> <a href=""> <?php echo "-";?> </a><?php }
							?>
                            
                            </div>
                            <div class="scorebottom"> 
                            <?php
								if ($match['Match']['player2_score']!=null){
									if ($match['Match']['player2_score']>=$match['Match']['player1_score']){?>
										<div class="scorewin"><a href="">
										<?php echo $match['Match']['player2_score'];?>
										</a></div><?php
									}
									if ($match['Match']['player2_score']<$match['Match']['player1_score']){?>
										<a href="">
										<?php echo $match['Match']['player2_score'];?>
										</a><?php
									}
								}
								else{
									?> <a href=""> <?php echo "-";?> </a><?php }
							?>
                             </div>
                        </div>
                    </div> 
				</div>
			</div>
		</div>
		<div class="rightBoxSmall">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<dl>
                    
                    <dt><?php __('Tournament'); ?></dt>
                    <dd>
                        <?php echo $this->Html->link($round['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $round['Tournament']['id'])); ?>
                        &nbsp;
                    </dd>
                    <dt><?php __('Round'); ?></dt>
                    <dd>
                        <?php echo ($match['Round']['number']+1); ?>
                        &nbsp;
                    </dd>
                    <dt><?php __('Best of'); ?></dt>
                    <dd>
                        <?php echo $match['Match']['games']; ?>
                        &nbsp;
                    </dd>
                    <dt><?php __('Date'); ?></dt>
                    <dd>
                        <?php echo $match['Match']['date'];?>
                        &nbsp;
                    </dd>
                
                </dl>
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
	<div class="PostFooter">
    	
		<div class="bottomaction"> 
			<?php 
            //Show Report page, if user participates and match is open
            if($report AND $match['Match']['open'])
            //if($match['Match']['open'])
            {
            ?>
			<?php 
            echo $this->Html->link('Submit Score', array('action'=>'submit',$match['Match']['id']));
            ?> 
            <?php } ?>
         </div>
        
        
		<div class="bottomaction"> 
			<?php 
            //Show Report page, if user participates and match is open
            if($report AND $match['Match']['open'])
            //if($match['Match']['open'])
            {
            ?>
			<?php 
            echo $this->Html->link('Set Date', array('action'=>'submitdate',$match['Match']['id']));
            ?> 
            <?php } ?>
         </div>
         
        <?php if($this->Session->read('Auth.User.caster')){?>
        <div class="bottomaction"> 
			<?php if($match['Match']['caster_id']==0){
                echo $this->Html->link('Sign me Up as Caster', array('action' => 'set_caster',$match['Match']['id'])); 	
            }
            else
            {
                echo $this->Html->link('Unsign me as Caster', array('action' => 'unset_caster',$match['Match']['id'])); 
            }
            ?>
        </div>
        <?php } ?>

        <p style="clear: both;">  </p>
	</div>
</div>


	
	


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3>Replays</h3>
	</div> 
    <div class="bottomaction">
     </div> 
     <p style="clear: both;"></p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Replay Name</th>
                        <th>Map</th>
                        <th>Duration</th>
                    </tr>
                    
                   	<?php foreach ($replays as $replay)
					{?>
                    
                    <tr>
                        <td>
                        <?php echo $this->Html->link( $replay['Replay']['name'], '/files/'.$replay['Replay']['name'] );?>
                        </td>
                        <td>
                       
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                    <?php }?>
                </table>
			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> 
		<?php
				//show upload button if allowed
				if($report){?>
				
					<?php echo $this->Html->link('Upload Replays', array('controller'=>'matches', 'action' => 'upload_replays', $match['Match']['id']));?>
				
		<?php }?>
         </div>
       
		<p style="clear: both;">  </p>
	</div>
</div>
	
	
    

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3>Comments</h3>
	</div> 
    <div class="bottomaction">
     </div> 
     <p style="clear: both;"></p>  
</div>
</div>
	

<?php foreach($comments as $comment)
{?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBox">
			<div class="PostUserContentBox">
				<div class="PostMainContentbox">
				 <?php
				 if($comment['User']['avatar_name']=='default'){
						echo $this->Html->image('avatar_l.png', array('width' => '125'));
					}
					else{
						echo $this->Html->image('/img/avatar/'.$comment['User']['avatar_name'], array('width' => '125', 'height' => '125'));
					}?> 
				  
                <?php //debug($post);
				if ($comment['User']['admin']==true)
				{
					?><div class="admin"> <?php echo($this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id']))); ?>
					<br>
					<small><?php echo ($comment['Comment']['date_posted']);?></small>
					</div> <?php
				}
				else
				{
					echo($this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])));
					?>	<br>
					<small><?php echo ($comment['Comment']['date_posted']);?></small><?php
				}
				?>
                
				
				</div>
			</div>
		</div>
		<div class="rightBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				
				<?php $body = $this->Bbcode->doShortcode(strip_tags($comment['Comment']['body']));
				echo ( $this->Text->autoLink($body));
				$edit_reason = $this->Bbcode->doShortcode(strip_tags($comment['Comment']['edit_reason']));
				echo ( $this->Text->autoLink($edit_reason));?>
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
	<div class="PostFooter">
		<div class="bottomaction">
        	<?php
					if ($this->Session->read('Auth.User.admin') OR $comment['Comment']['user_id']==$current_user)
					{
						
						echo $this->Html->link('Delete', array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete this Comment?', true)));
					}?>

        </div>
        <div class="bottomaction"> <?php
				if ($this->Session->read('Auth.User.admin') OR $comment['Comment']['user_id']==$current_user)
				{
					echo($this->Html->link('Edit', array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])));
					
				}?>
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>
<?php
}?>
    
<?php
if ($this->Session->read('Auth.User'))
{?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('Match', array('action'=>'post_comment'));?>
					<fieldset>
					<legend></legend>
					
					<?php echo $this->Form->input('Comment.body', array('label'=>'Post Comment'));?>
					
					BBCode is enabled<br>
					Embedding images is disabled
					</fieldset>
				
				
			</div>
		</div>
			<p style="clear: both;"> </p>
		</div>
		<div class="PostFooter">
			<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>   </p></div>
		   <div class="bottomaction"> <?php echo $this->Html->link('BBCode Help',array('controller'=>'pages','action'=>'bbcode'));?>   </p></div>
		<p style="clear: both;">  </p>
	</div>
</div>
<?php }?>
	
	
	
</div>
