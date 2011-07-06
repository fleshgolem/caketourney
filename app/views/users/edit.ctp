<div class="users index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2>Edit Userpage</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('User');?>
                    <fieldset>
                        <legend></legend>
                    <?php
						Configure::load('caketourney_configuration');
                        echo $this->Form->input('id');
                        echo $this->Form->input('name');
                        echo $this->Form->input('email');
                        echo $this->Form->input('username');
                        //echo $this->Form->input('password');
                        echo $this->Form->input('bnetaccount');
                        echo $this->Form->input('bnetcode');
                        echo $this->Form->input('elo');
                        echo $this->Form->input('race', array('options' => array("Terran","Protoss","Zerg","Random",), 'selected' => $this->data['User']['race']));
                        echo $this->Form->input('division', array('options' => array("Unranked"=>Configure::read('Caketourney.division_unranked'),"Code S"=>Configure::read('Caketourney.division_1'),"Code A"=>Configure::read('Caketourney.division_2')), 'selected' => $this->data['User']['division']));
                        echo $this->Form->input('admin');
                        //echo $this->Form->input('password_confirm', array('label' => 'Password', 'type' => 'password'));
                        //echo $this->Form->input('password', array('label' => 'Password Confirm'));
                    ?>
                    </fieldset>
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?> </div>
		<p style="clear: both;">  </p>
	</div>
</div>
</div>