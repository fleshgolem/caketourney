<?php
//Get the match data
$unread_messages = $this->requestAction('/messages/unread_messages');
?>

<?php echo ($unread_messages);?> Unread Messages 