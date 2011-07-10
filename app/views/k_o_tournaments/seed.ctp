
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Seed Tournament');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('KOTournament');?>
                    <fieldset>
                        <legend></legend>
                        <disclaimer>Seed the players by their ranking, starting with the best player = 1, second best = 2, etc.</disclaimer><br><br>
                    <?php
                        echo $this->Form->input('id');
                        foreach ($tournament['User'] as $user)
                        {?> 
                        
                           		 <?php  echo $user['username']; 
								 echo $this->Form->input('playerpos.'.$user['id'],array( 'label' => false ));
								 ?>
                        
                         <?php   
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