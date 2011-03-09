<div class="tournaments form">
<?php echo $this->Form->create('Tournament');?>
	<fieldset>
 		<legend><?php __('Edit Tournament'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');


	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
