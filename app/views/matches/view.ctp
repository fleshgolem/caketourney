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
	<div class="PostContent">
		<div class="leftBoxBig">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
					<div class="spacebox2em"> </div>
					<div class="matchbox">
                        <div class="namesbox">
                            <div class="topbox"> <?php echo $this->Html->link(__($match['Player1']['username'], true), array('controller' => 'users', 'action' => 'view', $match['Player1']['id']));?> </div>
                            <div class="bottombox"> <?php echo $this->Html->link(__($match['Player2']['username'], true), array('controller' => 'users', 'action' => 'view', $match['Player2']['id']));?></div>
                        </div>
                        <div class="scorebox">
                            <div class="scoretop"> <a href=""><?php 
								if ($match['Match']['player1_score']!=null)
									echo $match['Match']['player1_score'];
								else
									echo "-";
								?></a> </div>
                            <div class="scorebottom"> <a href=""><?php 
								if ($match['Match']['player2_score']!=null)
									echo $match['Match']['player2_score'];
								else
									echo "-";
								?></a> </div>
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
			<div class="PostMainContentbox">
				
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
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				
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
				echo ( $this->Text->autoLink($body));?>
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
       
		<p style="clear: both;">  </p>
	</div>
</div>

	
	
	
</div>
