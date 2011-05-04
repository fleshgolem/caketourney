<div class="threads view">


<h2><?php echo($thread['Thread']['title']);?></h2>



<?php foreach($posts as $post)
{?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<?php //debug($post);
				echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>	<br>
				<small><?php echo ($post['Post']['date_posted']);?></small>
				</div>
			</div>
		</div>
		<div class="rightBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<?php
				$body = $this->Bbcode->doshortcode(strip_tags($post['Post']['body']));
				echo ( $this->Text->autoLink($body));?>
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


<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% posts out of %count% total', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
 
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
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
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>
