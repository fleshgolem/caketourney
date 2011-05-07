<div class="matches view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'] .' vs '.$match['Player2']['username'].' '.$this->Race->small_img($match['Player2']['race']));?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>


	
	<?php 

	//Show Report page, if user participates and match is open
	if($report AND $match['Match']['open'])
	//if($match['Match']['open'])
	{
	?>
   
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
            	<fieldset>
                   
		
				<?php echo $this->Form->create('Match');?>
                <?php echo $this->Form->input('id');?>
                <legend><?php __('Scores');?></legend>
            	<?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'])?>
                <?php echo $this->Form->input('player1_score', array( 'label' => '' ));?>
                <?php echo ($this->Race->small_img($match['Player2']['race']).' '.$match['Player2']['username'])?>
                <?php echo $this->Form->input('player2_score', array( 'label' => '' ));?>
				
				
				
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
   
  
	
	<?php
	}
	//show normal page otherwise
	else
	{
	?>
    <div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
                	<div class="matchbox">
                        <div class="namesbox">
                            <div class="topbox"> <a href=""><?php echo ($match['Player1']['username'])?></a> </div>
                            <div class="bottombox"> <a href=""><?php echo ($match['Player2']['username'])?></a> </div>
                        </div>
                        <div class="scorebox">
                            <div class="scoretop"> <a href=""><?php 
								if ($match['Match']['player1_score']!=null)
									echo $match['Match']['player1_score'];
								else
									echo "-";
								?></a> </div>
                            <div class="scorebottom"> <a href=""><?php 
								if ($match['Match']['player2_score']!=null)
									echo $match['Match']['player2_score'];
								else
									echo "-";
								?></a> </div>
                        </div>
                    </div>
                	
                </div>
            </div>
            <p style="clear: both;"> </p>
        </div>
        <div class="PostFooter">
            <div class="bottomaction">   </p></div>
           
            <p style="clear: both;">  </p>
        </div>
    </div>
	<div class="scores">
		<h3>Scores</h3>
		<div align="left">
			<?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'].' <strong>'.$match['Match']['player1_score'].'</strong>')?>
		</div>
		<div align="right">
			<?php echo ('<strong>'.$match['Match']['player2_score'].'</strong> '. $match['Player2']['username'].' '.$this->Race->small_img($match['Player2']['race']))?>
		</div>
	</div>
	<?php
	}?>




	
	
	
	
</div>
