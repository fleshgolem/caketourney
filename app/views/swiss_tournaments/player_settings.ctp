

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Tournament Settings');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('SwissTournament',array('action'=>'player_settings',$id));?>
                        <fieldset>
                            <legend></legend>
                        <?php
							debug($this->data);
							echo $this->Form->input('id',array('value'=>$id));
							foreach ($this->data as $i=>$ranking)
							{
								echo ($ranking['User']['username']);
								echo $this->Form->input('Ranking.'.$i.'.id',array('value'=>$ranking['Ranking']['id']));
								echo $this->Form->input('Ranking.'.$i.'.away',array('label'=>'away','checked'=>$ranking['Ranking']['away']));
							}
                        ?>
                        </fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>