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
		echo $this->Html->link('Rounds', array('action'=>'view',$tournament['SwissTournament']['id']));
		?>
     </div>
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
            <th>Score</th>
			<th>Opponent Score</th>
			<th>Opponent Opponent Score</th>
			
	</tr>
<?php foreach ($ranking as $i=>$rank){?>
	<tr>
		<td><?php echo($i+1);?></td>
		<td><?php echo($rank['User']['username']);?></td>
		<td><?php echo($rank['Ranking']['wins']);?></td>
		<td><?php echo($rank['Ranking']['draws']);?></td>
		<td><?php echo($rank['Ranking']['defeats']);?></td>
		<td><?php echo($rank['Ranking']['match_points']);?></td>
		<td><?php echo($rank['Ranking']['oppscore']);?></td>
		<td><?php echo($rank['Ranking']['oppoppscore']);?></td>
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
