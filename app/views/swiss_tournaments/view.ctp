<div class="tournaments view">



<h2><?php  echo ($tournament['SwissTournament']['name']);?></h2>

<?php 
if ($in_tournament){?>
	<div class="buttons">
		<?php echo $this->Html->link('My Tournament Settings', array('action'=>'settings',$tournament['SwissTournament']['id']));?>
	</div>
<?php }?>
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
				$matchtitle .=($match['Player1']['name']);
			$matchtitle .= ' vs ' ;
			if ($match['Player2']!=null)
				$matchtitle .=($match['Player2']['name']);
			echo $this->Html->link(($matchtitle), array('controller' => 'matches', 'action' => 'view',$match['id'])); 	
				?>
			<?php 
			if ($match['Player2']!=null)
				echo $this->Race->small_img($match['Player2']['race'])
			?>
		</td>
		
	<?php
	} ?>
	<?php 

		if($tournament['SwissTournament']['current_round']==$round['number'])
		{?>
			<td>
			<?php  echo $this->Html->link(__('Finish Round',true), array('controller' => 'swiss_tournaments', 'action' => 'finish_round',$tournament['SwissTournament']['id']));?>
			</td>
		<?php }?>
	</tr>
<?php
} ?>	
</table>

<table>
<?php foreach ($ranking as $i=>$rank){?>
	<tr>
		<td><?php echo($i+1);?></td>
		<td><?php echo($rank['User']['name']);?></td>
		<td><?php echo($rank['Ranking']['wins']);?></td>
		<td><?php echo($rank['Ranking']['draws']);?></td>
		<td><?php echo($rank['Ranking']['defeats']);?></td>
		<td><?php echo($rank['Ranking']['elo']);?></td>
	</tr>
	<?php }?>
</table>
</div>


<!-- TO BE DELETED-->


	<!--<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tournament['Tournament']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tournament['Tournament']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('TypeField'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tournament['Tournament']['typeField']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('TypeAlias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tournament['Tournament']['typeAlias']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($tournament['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Lastlogin'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Bnetaccount'); ?></th>
		<th><?php __('Bnetcode'); ?></th>
		<th><?php __('Race'); ?></th>
		<th><?php __('Admin'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tournament['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td><?php echo $user['lastlogin'];?></td>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['bnetaccount'];?></td>
			<td><?php echo $user['bnetcode'];?></td>
			<td><?php echo $user['race'];?></td>
			<td><?php echo $user['admin'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
-->