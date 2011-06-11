<?php
//Get the match data
$unread_messages = $this->requestAction('/messages/unread_messages');
?>

Unread Messages: <?php echo ($unread_messages);?>