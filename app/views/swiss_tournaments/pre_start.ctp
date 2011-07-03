


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Start Swiss Tournament');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create();?>
                    <fieldset>
                        <legend></legend>
                    <?php
                        if (!empty($users)){
                        	echo $this->Form->input('signup_mod', array('options' => array('sign_up'=>'Only players that signed up','all'=>'All players in the database','mixed'=>'both','codes'=>'Only players from Code-S','codea'=>'Only players from Code-A'),'label' => 'Choose from which group of players you would like fill your seedings.'));
						}
						else {
							echo $this->Form->input('signup_mod', array('options' => array('sign_up'=>'ha',3=>3,5=>5,7=>7,9=>9),'label' => 'No Sign ups'));
						}
                    ?>
                    </fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>  </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>