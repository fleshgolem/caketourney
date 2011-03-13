<div class="swissTournaments view">
<h2><?php  __('Swiss Tournament');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $swissTournament['SwissTournament']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $swissTournament['SwissTournament']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('TypeField'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $swissTournament['SwissTournament']['typeField']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('TypeAlias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $swissTournament['SwissTournament']['typeAlias']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Swiss Tournament', true), array('action' => 'edit', $swissTournament['SwissTournament']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Swiss Tournament', true), array('action' => 'delete', $swissTournament['SwissTournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $swissTournament['SwissTournament']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Swiss Tournaments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Swiss Tournament', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankings', true), array('controller' => 'rankings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ranking', true), array('controller' => 'rankings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Rankings');?></h3>
	<?php if (!empty($swissTournament['Ranking'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Tournament Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Match Points'); ?></th>
		<th><?php __('Elo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($swissTournament['Ranking'] as $ranking):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ranking['id'];?></td>
			<td><?php echo $ranking['tournament_id'];?></td>
			<td><?php echo $ranking['user_id'];?></td>
			<td><?php echo $ranking['match_points'];?></td>
			<td><?php echo $ranking['elo'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'rankings', 'action' => 'view', $ranking['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'rankings', 'action' => 'edit', $ranking['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'rankings', 'action' => 'delete', $ranking['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ranking['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ranking', true), array('controller' => 'rankings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($swissTournament['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Lastlogin'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Bnetaccount'); ?></th>
		<th><?php __('Bnetcode'); ?></th>
		<th><?php __('Race'); ?></th>
		<th><?php __('Admin'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($swissTournament['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td><?php echo $user['lastlogin'];?></td>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['bnetaccount'];?></td>
			<td><?php echo $user['bnetcode'];?></td>
			<td><?php echo $user['race'];?></td>
			<td><?php echo $user['admin'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
