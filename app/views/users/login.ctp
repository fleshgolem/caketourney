<?php
echo $this->Form->create(array('action' => 'login'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Login');
?>

<a href="register">Register</a>