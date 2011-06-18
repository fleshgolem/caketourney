<div class="tournaments bracket view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($tournament['DETournament']['name']);?></h2>
	</div> 
    
    <p style="clear: both;"></p>  
	
</div>
</div>

<div class="PostBox">
<div class="ThreadTitleBox">
	
	<div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Edit', true), array('controller'=>'tournaments', 'action' => 'edit', $tournament['DETournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Delete', true), array('controller'=>'tournaments', 'action' => 'delete', $tournament['DETournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tournament['DETournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			if ( $tournament['DETournament']['current_round']==NULL)
					echo $this->Html->link(__('Start', true), array('controller'=>'tournaments','action' => 'start', $tournament['DETournament']['id'])); 
		}?>
     </div>
     <div class="bottomactionleft">
     	<?php 
		echo $this->Html->link('Statistics', array('action'=>'statistics',$tournament['DETournament']['id']));
		?>
     </div>
	<p style="clear: both;">  </p>  
</div>
</div>



<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
			
<div class="KOwrapper">
            	<div class="scrollbox" ">	
                <?php
				$maxrounds=2; 
				foreach ($tournament['Round'] as $round){
					if($round['number']<=(count($tournament['Round'])-2)/3 && $round['number']>=0){
					$maxrounds+=1;
					}
					
				}
				
				?>
                <div class="PostContentBox" style="width:<?php echo ($maxrounds)*210 ?>px;>
                	 <div style="width:1000px;>
					<?php $m = 0;?>
                    <?php foreach ($tournament['Round'] as $round){
						
						if($round['number']<=(count($tournament['Round'])-2)/3 && $round['number']>=0){?>
                    	
                    
                        <div class="tournamentRound" >
                        <?php $max = 0;?>
                        <?php 
						foreach ($round['Match'] as $match){
							$max += 1;
						}
                        $this->Bracket->spaceboxes($round['number']);
						$index = 1;
                        foreach ($round['Match'] as $match){
							
                            $this->Bracket->matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
							if ($index != $max){
                            $this->Bracket->dummyboxes($round['number']);
							}
							$index += 1;
                        }?>
                        </div>
                        
                        
                        
                    <?php 
                        $m += 30;
                    }}?>
                    
                     
                   <?php $m = 0;?>
                    <?php foreach ($tournament['Round'] as $round){
						
						if($round['number']>(count($tournament['Round'])-2)/3){?>
                    	
                    
                        <div class="tournamentRound" >
                        <?php $max = 0;?>
                        <?php 
						foreach ($round['Match'] as $match){
							$max += 1;
						}
                        $this->Bracket->spaceboxes($round['number']);
						$index = 1;
                        foreach ($round['Match'] as $match){
							
                            
							if ($index != $max){
                            $this->Bracket->dummyboxes($round['number']);
							}
							$index += 1;
                        }?>
                        </div>
                        
                        
                        
                    <?php 
                        $m += 30;
                    }}?>
                    <?php foreach ($tournament['Round'] as $round){
						
						if($round['number']>(count($tournament['Round'])-2)/3){?>
                    	
                    
                        <div class="tournamentRound" >
                        <?php $max = 0;?>
                        <?php 
						foreach ($round['Match'] as $match){
							$max += 1;
						}
                        $this->Bracket->spaceboxes($round['number']);
						$index = 1;
                        foreach ($round['Match'] as $match){
							
                            $this->Bracket->matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
							if ($index != $max){
                            $this->Bracket->dummyboxes($round['number']);
							}
							$index += 1;
                        }?>
                        </div>
                        
                        
                        
                    <?php 
                        $m += 30;
                    }}?>
                   
                    
                    <?php $m = 0;?>
                    <?php foreach ($tournament['Round'] as $round){
						
						if($round['number']<0){?>
                    	
                    
                        <div class="tournamentRound" >
                        <?php $max = 0;?>
                        <?php 
						foreach ($round['Match'] as $match){
							$max += 1;
						}
                        $this->Bracket->spaceboxes($round['number']);
						$index = 1;
                        foreach ($round['Match'] as $match){
							
                            $this->Bracket->matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
							if ($index != $max){
                            $this->Bracket->dummyboxes($round['number']);
							}
							$index += 1;
                        }?>
                        </div>
                        
                        
                        
                    <?php 
                        $m += 30;
                    }}?>
                    
                </div>    
                
                
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


</div>
			





</div>

