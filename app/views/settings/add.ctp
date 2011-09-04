<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Add Setting'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<?php echo $this->Form->create('Setting');?>
	<fieldset>
 		<legend></legend>
	<?php
		echo $this->Form->input('key',array('label'=>'Setting Key'));
		echo $this->Form->input('pair',array('label'=>'Setting Value'));
		echo $this->Form->input('description');
		
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