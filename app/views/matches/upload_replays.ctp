
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<fieldset>
                <?php echo $this->Form->create('Match', array('type' => 'file'));?>
 				<legend>Upload Replays</legend>
				
				<?php echo $this->Form->input('id');?>
            
                <?php
                for ($i=0; $i<$match['Match']['games'];$i++)
                {
					?><div><?php
                    echo $this->Form->file('Replay.'.$i.'.file', array('type' => 'file','label' => 'Game '.$i+1));
					?></div><?php
                }
                //echo $this->Form->file('Replay.file', array('type' => 'file','label' => 'Game '));?>
				</fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end('Upload Replays'); ?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>
