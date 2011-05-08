<div class="matches view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'] .' vs '.$match['Player2']['username'].' '.$this->Race->small_img($match['Player2']['race']));?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>


	
	
    <div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
                	<fieldset>
                    <?php echo $this->Form->create('Match',array('action'=>'set_date'));?>
                    <legend><?php __('Set Date');?></legend>
                    <?php echo $this->Form->input('id');?>
                    <?php echo $this->Form->input('date');?>
                   	</fieldset>

                </div>
            </div>
            <p style="clear: both;"> </p>
        </div>
        <div class="PostFooter">
            <div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>  </p></div>
           
            <p style="clear: both;">  </p>
        </div>
    </div>
	





	
	
	
	
</div>
