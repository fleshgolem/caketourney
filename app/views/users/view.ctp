<div class="users view">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo $user['User']['username']; ?>'s Page</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="users view">
<div class="PostBox">
<div class="ThreadTitleBox">
	
	<div class="bottomaction"> <?php
		echo $this->Html->link(__('Statistics', true), array('action' => 'statistics', $user['User']['id'])); 
		?>
     </div>
	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBoxBig">
			<div class="PostContentBox">
				<div class="PostMainContentbox" margin-left: auto;  margin-right: auto>
					<?php echo $this->Html->image('avatar_l.png', array('width' => '200')); ?> 
				</div>
			</div>
		</div>
		<div class="rightBoxSmall">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<dl>
                        
                    
                        <dt><?php __('Name'); ?></dt>
                        <dd>
                            <?php echo $user['User']['name']; ?>
                            &nbsp;
                        </dd>
                        
                        <dt><?php __('Username'); ?></dt>
                        <dd>
                            <?php echo $user['User']['username']; ?>
                            &nbsp;
                        </dd>
                
                        <dt><?php __('Bnetaccount'); ?></dt>
                        <dd>
                            <?php echo $user['User']['bnetaccount']; ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Bnetcode'); ?></dt>
                        <dd>
                            <?php echo $user['User']['bnetcode']; ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Race'); ?></dt>
                        <dd>
                            <?php echo $this->Race->small_img($user['User']['race']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Elo'); ?></dt>
                        <dd>
                            <?php echo $user['User']['elo']; ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Division'); ?></dt>
                        <dd>
                            <?php echo $user['User']['division']; ?>
                            &nbsp;
                        </dd>
                 </dl>
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
        <div class="PostFooter">
            
            <div class="bottomaction">
            <?php 
                //Only show edit and delete if admin
                if ($this->Session->read('Auth.User.admin')) 
                {
                    
                    echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); 
                }
            ?>
        </div>
        <div class="bottomaction">
            <?php 
                //Only show edit and delete if admin
                if ($this->Session->read('Auth.User.admin')) 
                {
                    echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); 
                    
                }
            ?>
        </div>
        <p style="clear: both;">  </p>
	</div>
</div>


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $user['User']['username']; ?>'s Achievements </h3>
	</div> 

	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				<div class="PostMainContentbox" margin-left: auto;  margin-right: auto>
					 <?php if ($user['User']['division']=='Code A') 
               		{
                    	echo $this->Html->image('CodeA-b2.png');
                	}
					if ($user['User']['division']=='Code S') 
					{
						echo $this->Html->image('CodeS-b2.png');
					}
					if ($user['User']['division']!='Code A' && $user['User']['division']!='Code S')
					{
						echo $this->Html->image('Unranked.png');
					}
					  ?>
				</div>
			</div>
		
		
		
	</div>
                            
        <div class="PostFooter">
            
            <div class="bottomaction">
            
        </div>
       
        <p style="clear: both;">  </p>
	</div>
</div>


<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $user['User']['username']; ?>'s Recent Matches </h3>
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
                        <th>Score</th>
                        <th>Tournament</th>
                    </tr>
                    
                    <?php foreach ($matches as $match){?>
                    
                    <tr>
                        <td>
                        <?php
                        if ($match['Player1']!=null)
                            {
                                echo $this->Race->small_img($match['Player1']['race']);
								echo $this->Html->link(($match['Player1']['username']),array('controller' => 'users', 'action' => 'view', $match['Player1']['id']));
                            }?>
                        </td>
                        <td>
                        <?php
                        if ($match['Player2']!=null)
                            {
                                echo $this->Race->small_img($match['Player2']['race']);
                                echo $this->Html->link(($match['Player2']['username']),array('controller' => 'users', 'action' => 'view', $match['Player2']['id']));
                            }?>
                        </td>
                        <td>
                        	
                        	<?php
								$scorelink = '';
								$scorelink .=($match['Match']['player1_score']);
								$scorelink .= ' : ' ;
								$scorelink .=($match['Match']['player2_score']);
								
							 echo $this->Html->link(($scorelink),array('controller' => 'matches', 'action' => 'view',$match['Match']['id']))?>
                           
                        </td>
                        <td>
                           <?php echo $this->Html->link(($match['Round']['Tournament']['name']),array('controller' => 'tournaments', 'action' => 'view',$match['Round']['Tournament']['id']))?>
                        </td>
                    </tr>
                    <?}?>
                </table>
				
			</div>
		
		
		
	</div>
                            
        <div class="PostFooter">
            
            <div class="bottomaction">
            
        </div>
       
        <p style="clear: both;">  </p>
	</div>
</div>

</div>

