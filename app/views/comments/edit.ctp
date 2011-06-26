<div class="posts form">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Edit Comment'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<?php echo $this->Form->create('Comment');?>
	<fieldset>
 		<legend></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('body');
		echo $this->Form->input('edit_reason',array('value'=>''));
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




</div>
