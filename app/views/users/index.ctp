<div class="users index">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<!--<th><?php echo $this->Paginator->sort('email');?></th>-->
			<th><?php echo $this->Paginator->sort('Battle.net Name', 'bnetaccount');?></th>
			<th><?php echo $this->Paginator->sort('Battle.net Code', 'bnetcode');?></th>
			<th><?php echo $this->Paginator->sort('race');?></th>
			<!--<th><?php echo $this->Paginator->sort('admin');?></th>-->
			<th><?php echo $this->Paginator->sort('elo');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['User']['name']; ?>&nbsp;</td>
		<!--<td><?php echo $user['User']['email']; ?>&nbsp;</td>-->
		<td><?php echo $user['User']['bnetaccount']; ?>&nbsp;</td>
		<td><?php echo $user['User']['bnetcode']; ?>&nbsp;</td>
		<td><?php echo $this->Race->small_img($user['User']['race']); ?>&nbsp;</td>
		<!--<td><?php echo $user['User']['admin']; ?>&nbsp;</td>-->
		<td><?php echo $user['User']['elo']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php 
			//Only show edit and delete if admin
			if ($this->Session->read('Auth.User.admin')) 
				{
					echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); 
					echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); 
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
