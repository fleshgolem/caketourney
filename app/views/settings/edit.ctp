<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Edit Setting '.$this->data['Setting']['key'].': '); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
			<?php 
			$description = $this->Bbcode->doshortcode(strip_tags($this->data['Setting']['description']));
			echo ( $this->Text->autoLink($description));
			?>
<?php echo $this->Form->create('Setting');?>
	<fieldset>
 		<legend></legend>
	<?php
		echo $this->Form->input('id');
		
		echo $this->Form->input('pair',array('label'=>'Setting Value'));
		
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