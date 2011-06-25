<div class="teams form">
<?php echo $this->Form->create('Team');?>
	<fieldset>
 		<legend><?php __('Edit Team'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('leader_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
