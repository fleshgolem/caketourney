<div class="tournaments view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($tournament['SwissTournament']['name']);?></h2>
	</div> 
	<div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Edit', true), array('controller'=>'tournaments', 'action' => 'edit', $tournament['SwissTournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Delete', true), array('controller'=>'tournaments', 'action' => 'delete', $tournament['SwissTournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tournament['SwissTournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			if ( $tournament['SwissTournament']['current_round']==-1)
					echo $this->Html->link(__('Start', true), array('controller'=>'tournaments','action' => 'start', $tournament['SwissTournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction">
     	<?php 
		if ($in_tournament){
		echo $this->Html->link('My Tournament Settings', array('action'=>'settings',$tournament['SwissTournament']['id']));
		}
		?>
     </div>
     <div class="bottomactionleft">
     	<?php 
		echo $this->Html->link('Score', array('action'=>'score',$tournament['SwissTournament']['id']));
		?>
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
                        <div class="topbox">
                        <?php
                        if ($match['Player1']!=null)
							echo $this->Html->link(($match['Player1']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
						else
							echo $this->Html->link("-", array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
                        <div class="bottombox">
                        <?php
                        if ($match['Player2']!=null)
							echo $this->Html->link(($match['Player2']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
						else
							echo $this->Html->link("-", array('controller' => 'matches', 'action' => 'view',$match['id']));
						?>
                        </div>
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
