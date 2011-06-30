<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php Configure::load('caketourney_configuration');echo('Contact the '.Configure::read('Caketourney.company_name') ); ?></h2>
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
		
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('title');
		echo $this->Form->input('body');
		echo $this->Form->input('validate', array('label' => 'By checking the box, you allow us to contact you by email. We will not use your email adress for any other purpose'));
	?>
	</fieldset>
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"><?php echo $form->end('Submit');?>   </p></div>
        
      
		<p style="clear: both;">  </p>
	</div>
</div>