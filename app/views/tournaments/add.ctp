<div class="tournaments form">

<?php echo $this->Form->create('Tournament');?>
	<fieldset>
 		<legend><?php __('New Tournament'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('typeAlias', array('label'=>'Type','options' => array("Random KO","Seeded KO","Swiss")));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>