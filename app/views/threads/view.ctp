<div class="threads view">


<h2><?php echo($thread['Thread']['title']);?></h2>
<table>
<?php foreach($posts as $post)
{?>
	<tr>
		<td class="info">
			<?php //debug($post);
			echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>	<br>
			<small><?php echo ($post['Post']['date_posted']);?></small>
		</td>
		<td>
			<?php
				$body = $this->Bbcode->doshortcode(strip_tags($post['Post']['body']));
				echo ( $this->Text->autoLink($body));?>
		</td>
	</tr>
<?php
}?>
</table>
<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% posts out of %count% total', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
 
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
<?php echo $this->Form->create('Thread');?>
	<fieldset>
 		<legend><?php __('Post Reply'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Post.body');
	?>
		BBCode is enabled<br>
		Embedding images is disabled
	</fieldset>
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<!--
<h2><?php  __('Thread');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $thread['Thread']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $thread['Thread']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $thread['Thread']['date_modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Original Poster Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $thread['Thread']['original_poster_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($thread['User']['name'], array('controller' => 'users', 'action' => 'view', $thread['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Thread', true), array('action' => 'edit', $thread['Thread']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Thread', true), array('action' => 'delete', $thread['Thread']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $thread['Thread']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Threads', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thread', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Posts');?></h3>
	<?php if (!empty($thread['Post'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Thread Id'); ?></th>
		<th><?php __('Date Posted'); ?></th>
		<th><?php __('Body'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($thread['Post'] as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $post['id'];?></td>
			<td><?php echo $post['user_id'];?></td>
			<td><?php echo $post['thread_id'];?></td>
			<td><?php echo $post['date_posted'];?></td>
			<td><?php echo $post['body'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'posts', 'action' => 'delete', $post['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
-->