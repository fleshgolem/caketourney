

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Start Tournament');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('DETournament');?>
                    <fieldset>
                        <legend></legend>
                    <?php
                        echo $this->Form->input('name');
                       if(!empty($allusers)){
							//echo $this->Form->input('Signed up Users', array('options' => $users_all));
							echo $this->Form->input('User',array( 'label' => 'Users that did sign up'));
							echo $this->Form->input('Alluser',array( 'type' => 'select', 'multiple' => true ,'label' => 'Users that did not sign up'));
							
						}
						else{
                        	echo $this->Form->input('User');
						}
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
