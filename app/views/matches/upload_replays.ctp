<div class="match form">

	<?php echo $this->Form->create('Match', array('type' => 'file'));?>
	<?php echo $this->Form->input('id');?>

	<?php 
	for ($i=0; $i<$match['Match']['games'];$i++)
	{
		echo $this->Form->file('Replay.'.$i.'.file', array('type' => 'file','label' => 'Game '.$i+1));
	}
	//echo $this->Form->file('Replay.file', array('type' => 'file','label' => 'Game '));
	
	echo $this->Form->end('Upload Replays');?>
</div>