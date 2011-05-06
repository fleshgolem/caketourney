<div class="matches view">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2>My Open Matches</h2>
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
		<th>Match</th>

		<th>Tournament</th>
		<th>Round</th>
	</tr>
	<?php foreach($matches as $match){?>
	<tr>
		<td>
		<?php 
			if ($match['Player1']!=null)
				echo $this->Race->small_img($match['Player1']['race']);
			//Link to match
			$matchtitle = '';
			if ($match['Player1']!=null)
				$matchtitle .=($match['Player1']['username']);
			$matchtitle .= ' vs ' ;
			if ($match['Player2']!=null)
				$matchtitle .=($match['Player2']['username']);
			echo $this->Html->link(($matchtitle), array('controller' => 'matches', 'action' => 'view',$match['Match']['id'])); 	
			if ($match['Player2']!=null)
				echo $this->Race->small_img($match['Player2']['race']);
			?>
		</td>
		
		<td>
		<?php echo $this->Html->link(($match['Round']['Tournament']['name']),array('controller' => 'tournaments', 'action' => 'view',$match['Round']['Tournament']['id']))?>
		</td>
		<td>
		<?php echo ($match['Round']['number']+1)?>
		</td>
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