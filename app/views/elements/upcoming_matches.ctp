<?php
//Get the match data
$matches = $this->requestAction('/matches/upcoming_matches');
?>

<?php
	foreach ($matches as $match)
	{?>

	<div class="CompleteSidematchbox">
			<?php echo $match['Match']['date'];?>
			<p style="clear: both;">  </p>
			<div class="Sidematchbox">
			<div class="Sidenamesbox">
				<div class="Sidetopbox"> <?php echo $this->Html->link($match['Player1']['username'],array('action'=>'view',$match['Match']['id'])); ?> </div>
				<div class="Sidebottombox"> <?php echo $this->Html->link($match['Player2']['username'],array('action'=>'view',$match['Match']['id'])); ?> </div>
    		</div>
			</div>
    </div>

			

	<?php }?>

