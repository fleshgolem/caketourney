


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Start Seeded KO Tournament');?></h2>
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
                        	echo $this->Form->input('signup_mod', array('options' => array('sign_up'=>'Signed up players','all'=>'All players in the database','division_1'=>(Configure::read('__Caketourney.division_1').' players'),'division_2'=>(Configure::read('__Caketourney.division_2').' players'),'mixed'=>'Two groups: signed up and all players'),'label' => 'Choose a group of which you want to select the players participating in this tournament.'));
						}
						else {
							echo $this->Form->input('signup_mod', array('options' => array('all'=>'All players in the database','division_1'=>(Configure::read('__Caketourney.division_1').' players'),'division_2'=>(Configure::read('__Caketourney.division_2').' players')),'label' => 'Choose a group of which you want to select the players participating in this tournament.'));
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