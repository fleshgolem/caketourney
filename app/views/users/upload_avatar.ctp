
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<fieldset>
                <?php echo $this->Form->create('User', array('type' => 'file'));?>
 				<legend>Upload Avatar</legend>
				
				<?php echo $this->Form->input('id');?>
            
                <?php
              	echo $this->Form->file('User.file', array('type' => 'file','label' => 'Test '));
                //echo $this->Form->file('Replay.file', array('type' => 'file','label' => 'Game '));?>
				</fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end('Upload Avatar'); ?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>
