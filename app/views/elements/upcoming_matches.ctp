<?php
//Get the match data
$matches = $this->requestAction('/matches/upcoming_matches');

?>

<?php
	foreach ($matches as $match)
	{?>

	<div class="CompleteSidematchbox">
			<?php echo $this->Time->niceShort( $match['Match']['date'] );?>
            <br/>
            <?php 
			if ($match['Match']['caster_id']!=0)
			{
				//debug($post);
						if ($match['Caster']['admin']==true)
						{
							?><div class="admin"> <?php echo'Caster: '.($this->Html->link($match['Caster']['username'], array('controller' => 'users', 'action' => 'view', $match['Caster']['id']))); ?> 
							
							</div> <?php
						}
						else
						{
							echo'Caster: '.($this->Html->link($match['Caster']['username'], array('controller' => 'users', 'action' => 'view', $match['Caster']['id'])));
							?>	<?php
						}
					
				
			}
			
			?>
			<p style="clear: both;">  </p>
			<div class="Sidematchbox">
			<div class="Sidenamesbox">
				<div class="Sidetopbox"> 
				 
					<div class="SideContenBox"> <?php echo $this->Race->small_img($match['Player1']['race']); ?>  </div>
					<div class="SideContenBox"> <?php echo $this->Html->link($match['Player1']['username'],array('controller' => 'matches','action'=>'view',$match['Match']['id']));?></div>
				 
                </div>
				<div class="Sidebottombox"> 
                	<div class="SideContenBox"> <?php echo $this->Race->small_img($match['Player2']['race']); ?>  </div>
					<div class="SideContenBox"> <?php echo $this->Html->link($match['Player2']['username'],array('controller' => 'matches','action'=>'view',$match['Match']['id']));?></div>
                </div>
    		</div>
			</div>
    </div>

			

	<?php }?>
