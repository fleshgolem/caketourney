
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Teams');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
    		<th><?php echo ('Name');?></th>
			<th><?php echo ('Team Type');?></th>
            <th><?php echo ('Elo');?></th>
			<th><?php echo ('Leader');?></th>
			
	</tr>
	<?php
	$i = 0;
	foreach ($my_teams as $team):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
    	
    	<td><?php echo $this->Html->link(__($team['Team']['name'], true), array('action' => 'view', $team['Team']['id'])); ?>&nbsp;</td>
		<td><?php echo $team['Team']['team_type']; ?>&nbsp;</td>
        <td><?php echo $team['Team']['elo']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($team['Leader']['username'], array('controller' => 'users', 'action' => 'view', $team['Leader']['id'])); ?>
		</td>
		
		
		
	</tr>
<?php endforeach; ?>
	</table>
			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottompages">  
        	
        </div>
        <div class="bottomaction">
		<?php echo ($this->Html->Link('New Team', array('action' => 'add')));?>
    </div>
		<p style="clear: both;">  </p>
	</div>
</div>	
	
	



