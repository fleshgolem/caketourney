<div class="teams view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo $team['Team']['name']; ?>'s Page</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="users view">
<div class="PostBox">
<div class="ThreadTitleBox">
	
	<div class="bottomactionleft"> <?php
		echo $this->Html->link(__('Statistics', true), array('action' => 'statistics', $team['Team']['id'])); 
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
					<?php 
					if($team['Team']['logo_name']=='default'){
						echo $this->Html->image('avatar_l.png', array('width' => '200'));
					}
					else{
						echo $this->Html->image('/img/teamlogo/'.$team['Team']['logo_name'], array('width' => '200', 'height' => '200'));
					}?> 
				</div>
			</div>
		</div>
		<div class="rightBoxSmall">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				<dl>
                        
                    
                        <dt><?php __('Team Name'); ?></dt>
                        <dd>
                            <?php echo $team['Team']['name']; ?>
                            &nbsp;
                        </dd>
                        
                        <dt><?php __('Team Type'); ?></dt>
                        <dd>
                            <?php echo $team['Team']['team_type']; ?>
                            &nbsp;
                        </dd>
                		<dt><?php __('Leader'); ?></dt>
                        <dd>
                            <?php echo $this->Html->link($team['Leader']['username'], array('controller' => 'users', 'action' => 'view', $team['Leader']['id'])); ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Creation Date'); ?></dt>
                        <dd>
                            <?php echo $team['Team']['date_created']; ?>
                            &nbsp;
                        </dd>
                       
                        
                        <dt><?php __('Elo'); ?></dt>
                        <dd>
                            <?php echo $team['Team']['elo']; ?>
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
                if ($this->Session->read('Auth.User.admin')||$this->Session->read('Auth.User.id')==$team['Team']['leader_id']) 
                {
                    echo $this->Html->link(__('Delete', true), array('action' => 'delete', $team['Team']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $team['Team']['id']));
                    
                }
            ?>
        </div>
        <div class="bottomaction">
            <?php 
                //Only show edit and delete if admin or teamleader
                if ($this->Session->read('Auth.User.admin')||$this->Session->read('Auth.User.id')==$team['Team']['leader_id'])
                {
                    echo $this->Html->link(__('Edit', true), array('action' => 'edit', $team['Team']['id']));  
                    
                }
            ?>
        </div>
          <div class="bottomaction">
            <?php 
                //Only show edit and delete if admin or teamleader
                if ($this->Session->read('Auth.User.id')==$team['Team']['leader_id'])
                {
                    echo $this->Html->link(__('Invite Player', true), array('action' => 'invite', $team['Team']['id']));  
                    
                }
            ?>
        </div>
        
        <div class="bottomaction">
            <?php 
                //Only show edit and delete if admin or teamleader
                if ($this->Session->read('Auth.User.id')==$team['Team']['leader_id'])
                {
                    echo $this->Html->link(__('Upload Teamlogo', true), array('action' => 'upload_logo', $team['Team']['id']));  
                    
                }
            ?>
        </div>
        
        <div class="bottomaction">
            <?php 
                //Only show edit and delete if in team
                if($in_team)
				{
					echo $this->Html->link('Leave Team',array('action'=>'leave',$team['Team']['id']), null, sprintf(__('Are you sure you want to leave the team?', true), $team['Team']['id']));
			}?>
        </div>
        
        
        <p style="clear: both;">  </p>
	</div>
</div>

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h3><?php echo $team['Team']['name']; ?>'s Members </h3>
	</div> 

	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				
                	<table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Player </th>
                        <th>Race</th>
                        <th>Elo</th>
                        <th>Division</th>
                        <?php 
						if($this->Session->read('Auth.User.id')==$team['Team']['leader_id']){?>
                        <th></th>
                        <?}?>
                    </tr>
                     
                    <?php 
					foreach ($members as $members){
						foreach ($members['User'] as $user){?>
                    
                        <tr>
                            <td><?php echo $this->Html->link(__($user['username'], true), array('controller' => 'users','action' => 'view', $user['id'])); ?> &nbsp;</td>
                            
                           	<td><?php echo $this->Race->small_img($user['race']); ?>&nbsp;</td>
                            <td><?php echo $user['elo']; ?>&nbsp;</td>
                            <td><?php echo $user['division']; ?>&nbsp;</td>
                            <?php 
								if($this->Session->read('Auth.User.id')==$team['Team']['leader_id']){?>
                            <td width="25%"><?php 
								
								echo $this->Html->link('Kick Teammember',array('action'=>'kick_member',$team['Team']['id'],$user['id']));?></td>
                        </tr>
                        <?}?>
                        <?}?>
                    <?}?>
                </table>
                     <p style="clear: both;">  </p>
				
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
		<h3><?php echo $team['Team']['name']; ?>'s Achievements </h3>
	</div> 

	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				<div class="PostMainContentbox" margin-left: auto;  margin-right: auto>
                	
                     <p style="clear: both;">  </p>
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
		<h3><?php echo $team['Team']['name']; ?>'s Recent Matches </h3>
	</div> 

	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		
			<div class="PostContentBox">
				
					<table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Team 1</th>
                        <th>Team 2</th>
                        <th>Score</th>
                        <th>Team Type</th>
                        <th>Tournament</th>
                    </tr>
                    
                    
                </table>
				
			</div>
		
		
		
	</div>
                            
        <div class="PostFooter">
            
            <div class="bottomaction">
            
        </div>
       
        <p style="clear: both;">  </p>
	</div>
</div>


