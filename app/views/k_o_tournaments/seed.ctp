<div class="seed form">
<?php echo $this->Form->create('KOTournament');?>
	<fieldset>
 		<legend><?php __('Seed Tournament'); ?></legend>
		
	<?php
		echo $this->Form->input('id');
		foreach ($tournament['User'] as $user)
		{
			echo $user['username'];
			echo $this->Form->input('playerpos.'.$user['id'],array( 'label' => false ));
		}
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>