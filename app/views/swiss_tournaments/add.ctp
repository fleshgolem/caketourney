<div class="swissTournaments form">
<?php echo $this->Form->create('SwissTournament');?>
	<fieldset>
 		<legend><?php __('Add Swiss Tournament'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
