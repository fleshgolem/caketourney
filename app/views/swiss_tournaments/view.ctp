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
	<p style="clear: both;">  </p>  
</div>
</div>


$this->Bracket->matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
<?php foreach ($tournament['Round'] as $round){?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
<table >

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
				$matchtitle .=($match['Player1']['username']);
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
	
</table>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction">
        <?php if($this->Session->read('Auth.User.admin'))
		{
           echo $this->Html->link(__('Finish Round',true), array('controller' => 'swiss_tournaments', 'action' => 'finish_round',$tournament['SwissTournament']['id']));
		}?> </div>
		<p style="clear: both;">  </p>
	</div>
</div>
<?php
} ?>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
<table >
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
				$matchtitle .=($match['Player1']['username']);
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
</table>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction">
        <?php if($this->Session->read('Auth.User.admin'))
		{
           echo $this->Html->link(__('Finish Round',true), array('controller' => 'swiss_tournaments', 'action' => 'finish_round',$tournament['SwissTournament']['id']));
		}?> </div>
		<p style="clear: both;">  </p>
	</div>
</div>



<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
<table cellpadding="0" cellspacing="0">
	<tr>
    		<th>Place</th>
			<th>Username</th>
            <th>Wins</th>
            <th>Draws</th>
            <th>Defeats</th>
            <th>Tournament Elo</th>
			
	</tr>
<?php foreach ($ranking as $i=>$rank){?>
	<tr>
		<td><?php echo($i+1);?></td>
		<td><?php echo($rank['User']['username']);?></td>
		<td><?php echo($rank['Ranking']['wins']);?></td>
		<td><?php echo($rank['Ranking']['draws']);?></td>
		<td><?php echo($rank['Ranking']['defeats']);?></td>
		<td><?php echo($rank['Ranking']['elo']);?></td>
	</tr>
	<?php }?>
</table>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction">  </div>
		<p style="clear: both;">  </p>
	</div>
</div>


</div>
