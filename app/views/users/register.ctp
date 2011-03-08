<?php
echo $this->Form->create(array('action' => 'register'));
echo $this->Form->input('name');
echo $this->Form->input('email');
echo $this->Form->input('username');
echo $this->Form->input('password_confirm', array('label' => 'Password', 'type' => 'password'));
echo $this->Form->input('password', array('label' => 'Password Confirm'));
echo $this->Form->input('bnetaccount', array('label' => 'Battle.net Account'));
echo $this->Form->input('bnetcode', array('label' => 'Battle.net Character Code'));
echo $this->Form->input('race', array('options' => array("Terran","Protoss","Zerg","Random",)));
echo $this->Form->end('Register');
?>