<div class="users view">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo $user['User']['username']; ?>'s Page</h2>
	</div> 

	<p style="clear: both;">  </p>  
</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBoxBig">
			<div class="PostContentBox">
				<div class="PostMainContentbox">

					asd 
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


</div>

