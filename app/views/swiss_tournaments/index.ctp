<div class="swissTournaments index">
	<h2><?php __('Swiss Tournaments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('typeField');?></th>
			<th><?php echo $this->Paginator->sort('typeAlias');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($swissTournaments as $swissTournament):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $swissTournament['SwissTournament']['id']; ?>&nbsp;</td>
		<td><?php echo $swissTournament['SwissTournament']['name']; ?>&nbsp;</td>
		<td><?php echo $swissTournament['SwissTournament']['typeField']; ?>&nbsp;</td>
		<td><?php echo $swissTournament['SwissTournament']['typeAlias']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $swissTournament['SwissTournament']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $swissTournament['SwissTournament']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $swissTournament['SwissTournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $swissTournament['SwissTournament']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Swiss Tournament', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Rankings', true), array('controller' => 'rankings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ranking', true), array('controller' => 'rankings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>