<div class="koTournaments form">
<?php echo $this->Form->create('KOTournament');?>
	<fieldset>
 		<legend><?php __('Games per Match'); ?></legend>
		<?php foreach($tournament['Round'] as $round)
		{
			echo $this->Form->input('bestof.'.$round['number'], array('options' => array(1=>1,3=>3,5=>5,7=>7,9=>9),'label' => 'Round '.$round['number'])); 
		}?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>