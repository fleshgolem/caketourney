<div class="news index">
	<h2><?php __('News');?></h2>
	<?php foreach ($news as $newspost)
	{?>
		<h3><?php echo ($newspost['News']['title']);?></h3>
		<div>
			<?php echo ($newspost['News']['body']);?>
		</div>
		<div>
			<small><?php echo ($newspost['News']['date_posted']);?></small>
		</div>
		<?php if ($this->Session->read('Auth.User.admin'))
		{
			echo($this->Html->link('Edit', array('action' => 'edit', $newspost['News']['id'])));
			echo $this->Html->link('Delete', array('action' => 'delete', $newspost['News']['id']), null, sprintf(__('Are you sure you want to delete this Post?', true)));
		}
	}?>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
 
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<?php if ($this->Session->read('Auth.User.admin'))
	{?>
	
		<?php echo $this->Form->create('News',array('action'=>'add'));?>
		<fieldset>
			<legend><?php __('Post News'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('body');
		?>
			BBCode is enabled<br>
			Embedding images is disabled
		</fieldset>
		<?php echo $this->Form->end(__('Submit', true));?>
	<?php }?>	
	
	
	
	
</div>