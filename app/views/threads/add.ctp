

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Add Thread'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<?php echo $this->Form->create('Thread');
	
	?>
	<fieldset>
 		
	<?php
		echo $this->Form->input('title');
		
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->image('/img/thread/thread_attention.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_bomb.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_bulb.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_check.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_flash.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_heart.png', array('width' => '25', 'height' => '25'));
			echo $this->Html->image('/img/thread/thread_star.png', array('width' => '25', 'height' => '25'));
			echo $this->Form->input('icon', array('label'=>'Tag','options' => array("Default","Attention","Bomb","Light Bulb","Check","Lightning Flash","Heart", "Star")));
		}
		echo $this->Form->input('Post.body');
	?>
	</fieldset>
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"><?php echo $this->Form->end(__('Submit', true));?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>
