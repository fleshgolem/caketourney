

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Games per Match');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('DETournament');?>
                    <fieldset>
                        <legend></legend>
                        <?php foreach($tournament['Round'] as $round)
                        {
							if($round['number']>(count($tournament['Round'])-2)/3){
                           		echo $this->Form->input('bestof.'.$round['number'], array('options' => array(1=>1,3=>3,5=>5,7=>7,9=>9),'label' => 'Winnerbracket vs Looserbracket Final')); 
							}
							if($round['number']>=0 && $round['number']<=(count($tournament['Round'])-2)/3){
                           		echo $this->Form->input('bestof.'.$round['number'], array('options' => array(1=>1,3=>3,5=>5,7=>7,9=>9),'label' => 'Winnerbracket Round '.$round['number'])); 
							}
							if($round['number']<0){
                           		echo $this->Form->input('bestof.'.$round['number'], array('options' => array(1=>1,3=>3,5=>5,7=>7,9=>9),'label' => 'Looserbracket Round '.-$round['number'])); 
							}
                        }?>
                    </fieldset>
                                
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?> </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>