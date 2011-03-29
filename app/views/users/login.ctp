<div class="view">
<?php
echo $this->Form->create(array('action' => 'login'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $form->input('remember_me', array('label' => 'Remember Me', 'type' => 'checkbox'));
echo $this->Form->end('Login');
?>

<a href="register">Register</a>
</div>