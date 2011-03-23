<div class="tournaments view">



<h2><?php  echo ($tournament['KOTournament']['name']);?></h2>


<table>
<?php foreach ($tournament['Round'] as $round){?>
	<tr>
	<?php foreach ($round['Match'] as $match){?>
	
		<td>
			<?php 
			if ($match['Player1']!=null)
				echo $this->Race->small_img($match['Player1']['race'])?>
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
				echo $this->Race->small_img($match['Player2']['race'])
			?>
		</td>

	<?php
	} ?>
	</tr>
<?php
} ?>	
</table>
</div>

