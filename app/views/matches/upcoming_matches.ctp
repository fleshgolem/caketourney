<div class="matches view">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2>Upcoming Matches</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Player 1</th>
                        <th>Player 2</th>
                        <th>Date</th>
                    </tr>
                    
                    <?php foreach ($matches as $match){?>
                    
                    <tr>
                        <td>
                        <?php
                        if ($match['Player1']!=null)
                            {
                                echo $this->Race->small_img($match['Player1']['race']);
                                echo ($this->Html->link($match['Player1']['username'],array('controller'=>'users','action'=>'view',$match['Player1']['id'])));
                            }?>
                        </td>
                        <td>
                        <?php
                        if ($match['Player2']!=null)
                            {
                                echo $this->Race->small_img($match['Player2']['race']);
                                echo ($this->Html->link($match['Player2']['username'],array('controller'=>'users','action'=>'view',$match['Player2']['id'])));
                            }?>
                        </td>
                        <td>
                            <?php echo ($this->Html->link($match['Match']['date'],array('action'=>'view',$match['Match']['id'])));?>
                        </td>
                    </tr>
                    <?}?>
                </table>
			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction">  </div>
		<p style="clear: both;">  </p>
	</div>
</div>

</div>