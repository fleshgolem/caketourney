<div class="swissTournaments form">
<?php echo $this->Form->create('SwissTournament');?>
	<fieldset>
 		<legend><?php __('Tournament Settings'); ?></legend>
	<?php
		echo $this->Form->input('Ranking.id');
		echo $this->Form->input('Ranking.away');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>