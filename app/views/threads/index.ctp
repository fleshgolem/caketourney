<div class="threads index">
	<h2><?php __('Forum');?></h2>
	<div class="buttons">
		<?php echo ($this->Html->Link('New Thread', array('action' => 'add')));?>
	</div>
	<p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title');?></th>
			
			<th><?php echo $this->Paginator->sort('original_poster_id');?></th>
			<th>Replies</th>
			<th><?php echo $this->Paginator->sort('Last Post','date_modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($threads as $thread):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td width="50%"><?php echo $this->Html->link(__($thread['Thread']['title'], true), array('action' => 'view', $thread['Thread']['id'])); ?></td>
		<td>
			<?php echo $this->Html->link($thread['OriginalPoster']['name'], array('controller' => 'users', 'action' => 'view', $thread['OriginalPoster']['id'])); ?>		
		</td>
		<td>
			<?php echo (count($thread['Post']));?>
		<td>
			<small>
			<?php echo $this->Html->link($thread['LastPoster']['name'], array('controller' => 'users', 'action' => 'view', $thread['LastPoster']['id'])); ?>
			<br>
			<?php echo $thread['Thread']['date_modified']; ?>&nbsp;
			</small>
		</td>
		<td class="actions">
			<?php echo $this->Html->link('Delete', array('action' => 'delete', $thread['Thread']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $thread['Thread']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% threads out of %count% total', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
