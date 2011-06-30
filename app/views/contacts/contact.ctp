<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Contact the OPSL Team'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<?php echo $form->create('Contact');?>
	<fieldset>
    
 		<legend></legend>
	<?php
		echo $form->inputs();
	?>
	</fieldset>
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"><?php echo $form->end('Send');?>   </p></div>
        
      
		<p style="clear: both;">  </p>
	</div>
</div>