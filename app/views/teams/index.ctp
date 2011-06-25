<div class="teams index">
	<h2><?php __('Teams');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('leader_id');?></th>
			<th><?php echo $this->Paginator->sort('team_type');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('logo_name');?></th>
			<th><?php echo $this->Paginator->sort('logo_size');?></th>
			<th><?php echo $this->Paginator->sort('logo_type');?></th>
			<th><?php echo $this->Paginator->sort('date_created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($teams as $team):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $team['Team']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($team['Leader']['username'], array('controller' => 'users', 'action' => 'view', $team['Leader']['id'])); ?>
		</td>
		<td><?php echo $team['Team']['team_type']; ?>&nbsp;</td>
		<td><?php echo $team['Team']['name']; ?>&nbsp;</td>
		<td><?php echo $team['Team']['logo_name']; ?>&nbsp;</td>
		<td><?php echo $team['Team']['logo_size']; ?>&nbsp;</td>
		<td><?php echo $team['Team']['logo_type']; ?>&nbsp;</td>
		<td><?php echo $team['Team']['date_created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $team['Team']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $team['Team']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $team['Team']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $team['Team']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Team', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Leader', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invitations', true), array('controller' => 'invitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invitation', true), array('controller' => 'invitations', 'action' => 'add')); ?> </li>
	</ul>
</div>