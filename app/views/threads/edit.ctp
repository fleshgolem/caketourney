<div class="threads form">
<?php echo $this->Form->create('Thread');?>
	<fieldset>
 		<legend><?php __('Edit Thread'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('date_modified');
		echo $this->Form->input('original_poster_id');
		echo $this->Form->input('last_poster_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Thread.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Thread.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Threads', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>