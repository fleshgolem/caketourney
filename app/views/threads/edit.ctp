<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Edit Thread Title'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<?php echo $this->Form->create('Thread');?>
	<fieldset>
 		<legend></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->image('/img/thread/thread_attention.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_bomb.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_bulb.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_check.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_flash.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_heart.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_star.png', array('width' => '25', 'height' => '25'));
			echo $this->Form->input('icon', array('label'=>'Tag','options' => array("none","Attention","Bomb","Light Bulb","Check","Lightning Flash","Heart", "Star")));
		}
	?>
	</fieldset>
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"><?php echo $this->Form->end(__('Submit', true));?>   </p></div>
        <div class="bottomaction"> <?php echo $this->Html->link('BBCode Help',array('controller'=>'pages','action'=>'bbcode'));?>   </p></div>
      
		<p style="clear: both;">  </p>
	</div>
</div>


<div class="threads form">
<?php echo $this->Form->create('Thread');?>
	<fieldset>
 		<legend><?php __('Edit Thread'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('date_modified');
		echo $this->Form->input('original_poster_id');
		echo $this->Form->input('last_poster_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Thread.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Thread.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Threads', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>