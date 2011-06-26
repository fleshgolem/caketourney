<?php
//Get the match data
$open_invitations = $this->requestAction('/invitations/open_invitations');
?>

<?php echo ($open_invitations);?> 