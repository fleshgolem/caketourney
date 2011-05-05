<?php
//Get the match data
$matches = $this->requestAction('/matches/upcoming_matches');
?>
<table>
<?php
	foreach ($matches as $match)
	{?>
		<tr>
			<td>
			<?php echo $match['Match']['date'];?>
			</td>
			
			<td>
			<?php 
			echo $this->Race->small_img($match['Player1']['race']);
			echo ($this->Html->link($match['Player1']['username'].' vs '.$match['Player2']['username'],array('action'=>'view',$match['Match']['id'])));
			echo $this->Race->small_img($match['Player2']['race']);
			?>
			</td>
		</tr>
	<?php }?>
</table>
