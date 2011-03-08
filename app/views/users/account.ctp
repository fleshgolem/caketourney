<h2>Account Page</h2>
<h3>Change your password</h3>
<p>You are <?php echo $current_user['User']['name']; ?></p>
 
<?php
echo $this->Form->create(array('action' => 'account'));
echo $this->Form->input('password_old',     array('label' => 'Old password', 'type' => 'password', 'autocomplete' => 'off'));
echo $this->Form->input('password_confirm', array('label' => 'New password', 'type' => 'password', 'autocomplete' => 'off'));
echo $this->Form->input('password',         array('label' => 'Re-enter new password', 'type' => 'password', 'autocomplete' => 'off'));
echo $this->Form->input('bnetaccount', array('label' => 'Battle.net Account', 'default' => $current_user['User']['bnetaccount']));
echo $this->Form->input('bnetcode', array('label' => 'Battle.net Character Code', 'default' => $current_user['User']['bnetcode']));
echo $this->Form->input('race', array('options' => array("Terran","Protoss","Zerg","Random",), 'selected' => $current_user['User']['race']));
echo $this->Form->end('Update');
?>