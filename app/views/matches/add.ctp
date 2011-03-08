<div class="matches form">
<?php echo $this->Form->create('Match');?>
	<fieldset>
 		<legend><?php __('Add Match'); ?></legend>
	<?php
		echo $this->Form->input('round_id');
		echo $this->Form->input('player1_id');
		echo $this->Form->input('player2_id');
		echo $this->Form->input('games');
		echo $this->Form->input('player1_score');
		echo $this->Form->input('player2_score');
		echo $this->Form->input('open');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Matches', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Rounds', true), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round', true), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player1', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>