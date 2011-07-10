<div class="tournaments bracket view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($tournament['KOTournament']['name']);?></h2>
	</div> 
    
    <p style="clear: both;"></p>  
	
</div>
</div>



                <?php
				$maxrounds=0; 
				foreach ($tournament['Round'] as $round){
					$maxrounds+=1;
				}
				
				?>
                <div class="PostContentBox" style="width:<?php echo ($maxrounds)*210 ?>px;>
                	 <div style="width:1000px;>
					<?php $m = 0;?>
                    <?php foreach ($tournament['Round'] as $round){?>
                    
                    
                        <div class="tournamentRound" >
                        <?php $max = 0;?>
                        <?php 
						foreach ($round['Match'] as $match){
							$max += 1;
						}
                        $this->Bracket->spaceboxes($round['number']);
						$index = 1;
                        foreach ($round['Match'] as $match){
							
							if($this->Session->read('Auth.User.id')==$match['player1_id'] && $this->Session->read('Auth.User.id')!=$match['player2_id'] && $this->Session->check('Auth.User')){
									$this->Bracket->own1matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
							}
								
                            else{
								if($this->Session->read('Auth.User.id')!=$match['player1_id'] && $this->Session->read('Auth.User.id')==$match['player2_id'] && $this->Session->check('Auth.User')){
									$this->Bracket->own2matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
								}
								else{
									$this->Bracket->matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
								}
							}
                           
							if ($index != $max){
                            $this->Bracket->dummyboxes($round['number']);
							}
							$index += 1;
                        }?>
                        </div>
                        
                        
                        
                    <?php 
                        $m += 30;
                    }?>

</div>
			





</div>

