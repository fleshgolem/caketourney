<div class="posts form">
<?php echo $this->Form->create('Post');?>
	<fieldset>
 		<legend><?php __('Edit Post'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
