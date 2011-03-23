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
