

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
				
<?php echo $this->Form->create('Thread');?>
	<fieldset>
 		
	<?php
		echo $this->Form->input('title');
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
