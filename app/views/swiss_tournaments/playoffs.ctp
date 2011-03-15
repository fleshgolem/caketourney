<div class="swissTournaments form">

<?php echo $this->Form->create('SwissTournament');?>
	<fieldset>
 		<legend><?php __('Start Playoffs'); ?></legend>
		<?php echo $this->Form->input('id');?>
		<?php echo $this->Form->input('cutoff', array('options' => array(2=>2,4=>4,8=>8,16=>16),'label' => 'Players to advance')); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>