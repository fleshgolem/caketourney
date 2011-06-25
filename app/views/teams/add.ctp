<div class="teams form">
<?php echo $this->Form->create('Team', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Add Team'); ?></legend>
	<?php
		echo $this->Form->input('team_type', array('options' => array("2v2"=>"2v2","3v3"=>"3v3","4v4"=>"4v4","Team League"=>"Team League")));
		echo $this->Form->input('name');
		//echo $this->Form->file('Team.file', array('type' => 'file','label' => 'Test '));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
