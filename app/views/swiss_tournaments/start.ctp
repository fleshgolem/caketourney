<div class="swissTournaments form">
<?php echo $this->Form->create('SwissTournament');?>
	<fieldset>
 		<legend><?php __('Add Swiss Tournament'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('User');
		echo $this->Form->input('bestof', array('options' => array(1=>1,3=>3,5=>5,7=>7,9=>9),'label' => 'Games per Match')); 
		echo $this->Form->input('roundnumber', array('label'=>'Number of Rounds'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
