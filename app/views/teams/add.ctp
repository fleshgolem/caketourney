<div class="teams form">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Add Team'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<?php echo $this->Form->create('Team', array('type' => 'file'));?>
	<fieldset>
 		<legend></legend>
	<?php
		echo $this->Form->input('team_type', array('options' => array("2v2"=>"2v2","3v3"=>"3v3","4v4"=>"4v4","Team League"=>"Team League")));
		echo $this->Form->input('name');
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

</div>
