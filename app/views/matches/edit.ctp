
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Edit Match'); ?></h2>
	</div> 
    <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Match.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Match.id'))); 
		}?>
     </div>
	
	<p style="clear: both;">  </p>  
</div>
</div>


	
	
    <div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
                	<?php echo $this->Form->create('Match');?>
                        <fieldset>
                            <legend></legend>
                        <?php
                            echo $this->Form->input('id');
                            echo $this->Form->input('round_id');
                            echo $this->Form->input('player1_id');
                            echo $this->Form->input('player2_id');
                            echo $this->Form->input('games');
                            echo $this->Form->input('player1_score');
                            echo $this->Form->input('player2_score');
                            echo $this->Form->input('open');
                        ?>
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
	


