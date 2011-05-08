
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Start Playoffs');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('SwissTournament');?>
                    <fieldset>
                        <legend></legend>
                        <?php echo $this->Form->input('id');?>
                        <?php echo $this->Form->input('cutoff', array('options' => array(2=>2,4=>4,8=>8,16=>16),'label' => 'Players to advance')); ?>
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