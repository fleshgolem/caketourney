


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Edit Tournament');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('Tournament');?>
                    <fieldset>
                        <legend></legend>
                    <?php
                        echo $this->Form->input('id');
                        echo $this->Form->input('name');
                
                
                    ?>
                    </fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>
