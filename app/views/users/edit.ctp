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
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>