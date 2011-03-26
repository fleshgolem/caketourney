<div class="threads form">
<?php echo $this->Form->create('Thread');?>
	<fieldset>
 		<legend><?php __('Add Thread'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Post.body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
