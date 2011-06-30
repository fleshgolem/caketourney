<?php
class Contact extends AppModel {
	var $name = 'Contact';
    var $useTable = false;
    var $_schema = array(
        'name'		=>array('type'=>'string', 'length'=>100), 
        'email'		=>array('type'=>'string', 'length'=>255), 
        'details'	=>array('type'=>'text'),
		'details2'	=>array('type'=>'text')
    );
	
	var $validate = array(
    'name' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Name is required' ),
    'email' => array(
        'rule'=>'email', 
        'message'=>'Must be a valid email address' ),
    'details' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Feedback is required' ),
	'details2' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Feedback is required' )
	);
	
}
?>