<div class="matches index">
	<h2><?php __('Matches');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('round_id');?></th>
			<th><?php echo $this->Paginator->sort('player1_id');?></th>
			<th><?php echo $this->Paginator->sort('player2_id');?></th>
			<th><?php echo $this->Paginator->sort('games');?></th>
			<th><?php echo $this->Paginator->sort('player1_score');?></th>
			<th><?php echo $this->Paginator->sort('player2_score');?></th>
			<th><?php echo $this->Paginator->sort('open');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($matches as $match):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $match['Match']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($match['Round']['id'], array('controller' => 'rounds', 'action' => 'view', $match['Round']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($match['Player1']['username'], array('controller' => 'users', 'action' => 'view', $match['Player1']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($match['Player2']['username'], array('controller' => 'users', 'action' => 'view', $match['Player2']['id'])); ?>
		</td>
		<td><?php echo $match['Match']['games']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['player1_score']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['player2_score']; ?>&nbsp;</td>
		<td><?php echo $match['Match']['open']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $match['Match']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $match['Match']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $match['Match']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $match['Match']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Match', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Rounds', true), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round', true), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player1', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>