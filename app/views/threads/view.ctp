<div class="threads view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo($thread['Thread']['title']);?></h2>
	</div> 
   
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox">
<div class="ThreadTitleBox">
	
    <div class="bottompages">  
        	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	 | 	<?php echo $this->Paginator->numbers();?> |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
	<div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link('Delete', array('action' => 'delete', $thread['Thread']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $thread['Thread']['id']));
		}?>
     </div>
	<p style="clear: both;">  </p>  
</div>
</div>

<?php foreach($posts as $post)
{?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBox">
			<div class="PostUserContentBox">
				<div class="PostMainContentbox">
                <?php 
					if($post['User']['avatar_name']=='default'){
						echo $this->Html->image('avatar_l.png', array('width' => '125'));
					}
					else{
						echo $this->Html->image('/img/avatar/'.$post['User']['avatar_name'], array('width' => '125', 'height' => '125'));
					}?> 
               
				<?php //debug($post);
				if ($post['User']['admin']==true)
				{
					?><div class="admin"> <?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?> 
					<br>
					<small><?php echo ($post['Post']['date_posted']);?></small>
					</div> <?php
				}
				else
				{
					echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id']));
					?>	<br>
					<small><?php echo ($post['Post']['date_posted']);?></small><?php
				}
				?>
				</div>
			</div>
		</div>
		<div class="rightBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<?php
				$body = $this->Bbcode->doshortcode(strip_tags($post['Post']['body']));
				echo ( $this->Text->autoLink($body));
			
				?>
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
	<div class="PostFooter">
    	
        
		<div class="bottomaction"> <?php
				if ($this->Session->read('Auth.User.admin') OR $post['Post']['user_id']==$current_user)
				{
					
					echo $this->Html->link('Delete', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete this Post?', true)));
				}?>
        </div>
        <div class="bottomaction"> <?php
				if ($this->Session->read('Auth.User.admin') OR $post['Post']['user_id']==$current_user)
				{
					echo($this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])));
					
				}?>
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>
<?php
}?>

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="bottompages">  
        	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	 | 	<?php echo $this->Paginator->numbers();?> |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
            <div class="bottomaction", style="padding:0 8px"> <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page %page% of %pages%, showing %current% posts out of %count% total', true)
        ));
        ?>	
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
