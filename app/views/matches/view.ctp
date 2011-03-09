<div class="matches view">
<?php 

//Show Report page, if user participates
if($report)
{
	echo("testest");
}?>
<h2><?php echo ($match['Player1']['name'] .' VS '.$match['Player2']['name']);?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Round'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($match['Round']['number']+1); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tournament'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($match['Round']['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $match['Round']['Tournament']['id'])); ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Best of'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $match['Match']['games']; ?>
			&nbsp;
		</dd>
	
	</dl>
</div>
