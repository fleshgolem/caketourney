<div class="tournaments form">
<?php echo $this->Form->create('KOTournament');?>
	<fieldset>
 		<legend><?php __('Add Tournament'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
