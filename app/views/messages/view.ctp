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
                <?php 
				if ( !$message['Message']['sender_id']){
					echo $this->Html->image('Overmind.png', array('width' => '125')); 
				}
				else{
					if($message['Sender']['avatar_name']=='default'){
						echo $this->Html->image('avatar_l.png', array('width' => '125'));
					}
					else{
						echo $this->Html->image('/img/avatar/'.$message['Sender']['avatar_name'], array('width' => '125', 'height' => '125'));
					}	
				}
				
				
				?> 
				<?php //debug($post);
				
				if ( !$message['Message']['sender_id']){
					?><div class="admin"> <a href="">Overmind</a>
						<br>
						<small><?php echo ($message['Message']['date']);?></small>
						</div> <?php
				}
				else{
					if ($message['Sender']['admin']==true)
					{
						?><div class="admin"> <?php echo $this->Html->link($message['Sender']['username'], array('controller' => 'users', 'action' => 'view', $message['Sender']['id'])); ?> 
						<br>
						<small><?php echo ($message['Message']['date']);?></small>
						</div> <?php
					}
					else
					{
						echo $this->Html->link($message['Sender']['username'], array('controller' => 'users', 'action' => 'view', $message['Sender']['id']));
						?>	<br>
						<small><?php echo ($message['Message']['date']);?></small><?php
					}
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
				echo ( $this->Text->autoLink($body));
				
				
				
				
				?>
                
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
	<div class="PostFooter">
    	
        
		<div class="bottomaction"> <?php
				if ($this->Session->read('Auth.User.admin') OR $message['Message']['recipient_id']==$current_user )
				{
					
					echo $this->Html->link('Delete', array('controller' => 'messages', 'action' => 'delete', $message['Message']['id']), null, sprintf(__('Are you sure you want to delete the Message?', true)));
				}?>
        </div>
       
		
		<p style="clear: both;">  </p>
	</div>
</div>


<?php
				
if ( !$message['Message']['sender_id']||$message['Message']['sender_id']==$this->Session->read('Auth.User.id')){?>
	
<?php				
}else{?>
	<div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
              
                	
                    <?php 
					echo $this->Form->create('Message');
					?>
                    <fieldset>
                    <legend><?php __('Send Reply'); ?></legend>   
                    <?php
                         
                        $body = $this->Bbcode->doshortcode(strip_tags($message['Message']['body']));
					    if($message['Message']['reply']==0){
                        	echo $this->Form->input('body', array('value'=>'[quote]'.($message['Message']['body']).'[/quote]'));
						}
						if($message['Message']['reply']==1){
                        	echo $this->Form->input('body', array('value'=>'[qquote]'.($message['Message']['body']).'[/qquote]'));
						}
						if($message['Message']['reply']==2){
                        	echo $this->Form->input('body', array('value'=>'[qqquote]'.($message['Message']['body']).'[/qqquote]'));
						}
						if($message['Message']['reply']==3){
                        	echo $this->Form->input('body', array('value'=>'[qqqquote]'.($message['Message']['body']).'[/qqqquote]'));
						}
						if($message['Message']['reply']>3){
                        	echo $this->Form->input('body', array('value'=>($message['Message']['body'])));
						}

                    ?>
                    </fieldset>
                    
                </div>
            </div>
            <p style="clear: both;"> </p>
        </div>
        <div class="PostFooter">
            <div class="bottomaction"><?php echo $this->Form->end(__('Submit', true));?> </div>
            <div class="bottomaction"> <?php echo $this->Html->link('BBCode Help',array('controller'=>'pages','action'=>'bbcode'));?>   </p></div>
            <p style="clear: both;">  </p>
        </div>
    </div>
<?php }

?>




</div>
