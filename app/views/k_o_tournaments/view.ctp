<div class="tournaments bracket view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($tournament['KOTournament']['name']);?></h2>
	</div> 
	<div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Edit', true), array('controller'=>'tournaments', 'action' => 'edit', $tournament['KOTournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Delete', true), array('controller'=>'tournaments', 'action' => 'delete', $tournament['KOTournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tournament['KOTournament']['id'])); 
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			if ( $tournament['KOTournament']['current_round']==-1)
					echo $this->Html->link(__('Start', true), array('controller'=>'tournaments','action' => 'start', $tournament['KOTournament']['id'])); 
		}?>
     </div>
	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				
<div class="KOwrapper">
            	<div class="scollbox">
					<?php $m = 0;?>
                    <?php foreach ($tournament['Round'] as $round){?>
                    
                    
                        <div class="tournamentRound">
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
                    }?>
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


			




<!--
<table>
<?php foreach ($tournament['Round'] as $round){?>
	<tr>
	<?php foreach ($round['Match'] as $match){?>
	
		<td>
			<?php 
			if ($match['Player1']!=null)
			{
				echo $this->Race->small_img($match['Player1']['race']);
				echo ('<strong>'.$match['player1_score'].'</strong> ');
			}?>
			<?php 
			//Link to match
			$matchtitle = '';
			if ($match['Player1']!=null)
				
				$matchtitle .=($match['Player1']['username']) ;
			$matchtitle .= ' vs ' ;
			if ($match['Player2']!=null)
				
				$matchtitle .=($match['Player2']['username']);
			echo $this->Html->link(($matchtitle), array('controller' => 'matches', 'action' => 'view',$match['id'])); 	
				?>
			<?php 
			if ($match['Player2']!=null)
			{
				echo (' <strong>'.$match['player2_score'].'</strong>');
				echo $this->Race->small_img($match['Player2']['race']);
			}?>
		</td>

	<?php
	} ?>
	</tr>
<?php
} ?>
-->	
</div>

