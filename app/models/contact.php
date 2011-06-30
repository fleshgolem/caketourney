<?php
class Contact extends AppModel {
	var $name = 'Contact';
    var $useTable = false;
    var $_schema = array(
        'name'		=>array('type'=>'string', 'length'=>100), 
        'email'		=>array('type'=>'string', 'length'=>255), 
		'topic'		=>array('type'=>'string', 'length'=>255), 
        'body'	=>array('type'=>'text'),
		'validate'	=>array('type'=>'boolean')
    );
	
	var $validate = array(
    'name' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Name is required' ),
    'email' => array(
        'rule'=>'email', 
        'message'=>'Must be a valid email address' ),
    'title' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Mail title is required' ),
	'body' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Mail content is required' ),
	'validate' => array(
        'rule'=>array( 'equalTo','1'), 
        'message'=>'Need to be checked' )
	);
	
}
?>