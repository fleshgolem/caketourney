<div class="swissTournaments form">
<?php echo $this->Form->create('SwissTournament');?>
	<fieldset>
 		<legend><?php __('Edit Swiss Tournament'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('typeField');
		echo $this->Form->input('typeAlias');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SwissTournament.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SwissTournament.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Swiss Tournaments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Rankings', true), array('controller' => 'rankings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ranking', true), array('controller' => 'rankings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>