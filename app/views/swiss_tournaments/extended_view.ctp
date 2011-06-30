<div class="tournaments view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($tournament['SwissTournament']['name']);?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>




<?php foreach ($tournament['Round'] as $round){?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
            	<div class="Subgroupbox">
                
            	<?php foreach ($round['Match'] as $match){?>
               <div class="Matchboxwrapper">
                
                <div class="matchbox">
                    <div class="namesbox">
                    	<?php
                        if($match['player1_id']!=$this->Session->read('Auth.User.id')){?>
                        <div class="topbox">
                        <?php
                        if ($match['Player1']!=null)
							echo $this->Html->link(($match['Player1']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
						else
							echo $this->Html->link("-", array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
                        <?php } ?>
                        
                        <?php
                        if($match['player1_id']==$this->Session->read('Auth.User.id')){?>
                        <div class="owntopbox">
                        <?php
                        if ($match['Player1']!=null)
							echo $this->Html->link(($match['Player1']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
						else
							echo $this->Html->link("-", array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
                        <?php } ?>
                        
                        <?php
                        if($match['player2_id']!=$this->Session->read('Auth.User.id')){?>
                        <div class="bottombox">
                        <?php
                        if ($match['Player2']!=null)
							echo $this->Html->link(($match['Player2']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
						else
							echo $this->Html->link("-", array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
                        <?php } ?>
                        <?php
                        if($match['player2_id']==$this->Session->read('Auth.User.id')){?>
                        <div class="ownbottombox">
                        <?php
                        if ($match['Player2']!=null)
							echo $this->Html->link(($match['Player2']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
						else
							echo $this->Html->link("-", array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="scorebox">
                        <div class="scoretop"> 
                        <?php
							if ($match['player1_score']!=null){
								if ($match['player1_score']>=$match['player2_score']){?>
									<div class="scorewin">
									<?php echo $this->Html->link(($match['player1_score']), array('controller' => 'matches', 'action' => 'view',$match['id']));?>
									</div><?php
								}
								if ($match['player1_score']<$match['player2_score']){?>
									
									<?php echo $this->Html->link(($match['player1_score']), array('controller' => 'matches', 'action' => 'view',$match['id']));?>
									<?php
								}
							}
							else
								echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        	
                        </div>
                        <div class="scorebottom"> 
                         <?php
							if ($match['player2_score']!=null){
								if ($match['player1_score']<=$match['player2_score']){?>
									<div class="scorewin">
									<?php echo $this->Html->link(($match['player2_score']), array('controller' => 'matches', 'action' => 'view',$match['id']));?>
									</div><?php
								}
								if ($match['player1_score']>$match['player2_score']){?>
									
									<?php echo $this->Html->link(($match['player2_score']), array('controller' => 'matches', 'action' => 'view',$match['id']));?>
									<?php
								}
							}
							else
								echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
                    </div>   
                </div>
                </div>
                <?php
				} ?>
			</div>
            </div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction">
        <?php if($tournament['SwissTournament']['current_round']==$round['number'] AND $this->Session->read('Auth.User.admin'))
		{
           echo $this->Html->link(__('Finish Round',true), array('controller' => 'swiss_tournaments', 'action' => 'finish_round',$tournament['SwissTournament']['id']));
		}?> </div>
		<p style="clear: both;">  </p>
	</div>
</div>
<?php
} ?>




</div>
