<div class="threads view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo($message['Message']['title']);?></h2>
	</div> 
   
	
	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBox">
			<div class="PostUserContentBox">
				<div class="PostMainContentbox">
                <?php echo $this->Html->image('avatar_l.png', array('width' => '125')); ?> 
				<?php //debug($post);
				if ($message['Sender']['admin']==true)
				{
					?><div class="admin"> <?php echo $this->Html->link($message['Sender']['username'], array('controller' => 'users', 'action' => 'view', $message['Sender']['id'])); ?> 
					<br>
					<small><?php echo ($message['Message']['date']);?></small>
					</div> <?php
				}
				else
				{
					echo $this->Html->link($message['Sender']['username'], array('controller' => 'users', 'action' => 'view', $message['User']['id']));
					?>	<br>
					<small><?php echo ($message['Message']['date']);?></small><?php
				}
				?>
				</div>
			</div>
		</div>
		<div class="rightBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<?php
				$body = $this->Bbcode->doshortcode(strip_tags($message['Message']['body']));
				echo ( $this->Text->autoLink($body));?>
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
	<div class="PostFooter">
    	
        
		<div class="bottomaction"> <?php
				if ($this->Session->read('Auth.User.admin') OR $message['Message']['recipient_id']==$current_user OR $message['Message']['sender_id']==$current_user)
				{
					
					echo $this->Html->link('Delete', array('controller' => 'messages', 'action' => 'delete', $message['Message']['id']), null, sprintf(__('Are you sure you want to delete the Message?', true)));
				}?>
        </div>
       
		
		<p style="clear: both;">  </p>
	</div>
</div>




<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('Thread');?>
				<fieldset>
 				<legend><?php __('Post Reply'); ?></legend>
				<?php
				echo $this->Form->input('id');
				echo $this->Form->input('Post.body');
				?>
				BBCode is enabled<br>
				Embedding images is disabled
				</fieldset>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?> </div>
		<p style="clear: both;">  </p>
	</div>
</div>


</div>
