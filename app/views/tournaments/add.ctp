<div class="tournaments form">
<?php echo $this->Form->create('Tournament');?>
	<fieldset>
 		<legend><?php __('Add Tournament'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('typeAlias', array('label' => "Type",'options' => array("Single KO")));
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tournaments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>