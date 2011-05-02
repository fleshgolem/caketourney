<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		//echo $this->Form->input('password');
		echo $this->Form->input('bnetaccount');
		echo $this->Form->input('bnetcode');
		echo $this->Form->input('elo');
		echo $this->Form->input('race', array('options' => array("Terran","Protoss","Zerg","Random",), 'selected' => $this->data['User']['race']));
		echo $this->Form->input('division', array('options' => array("Code S"=>"Code S","Code A"=>"Code A"), 'selected' => $this->data['User']['division']));
		echo $this->Form->input('admin');
		//echo $this->Form->input('password_confirm', array('label' => 'Password', 'type' => 'password'));
		//echo $this->Form->input('password', array('label' => 'Password Confirm'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
