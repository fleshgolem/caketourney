<?php
class Replay extends AppModel {
	var $name = 'Replay';
	var $actsAs = array(
                    'FileUpload.FileUpload' => array(
                        'uploadDir' => 'files',
                        'forceWebroot' => true,  //if false, files will be upload to the exact path of uploadDir
                        'fields' => array('name'=>'name','type'=>'type','size'=>'size'),
                        'allowedTypes' => array('sc2replay' => array('application/octet-stream')),
                        'required' => false, //default is false, if true a validation error would occur if a file wsan't uploaded.
                        'maxFileSize' => '500000', //bytes OR false to turn off maxFileSize (default false)
                        'unique' => true, //filenames will overwrite existing files of the same name. (default true)
                        'fileNameFunction' => 'createFileName' //execute the Sha1 function on a filename before saving it (default false)
                    )
                );
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'size' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'match_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Match' => array(
			'className' => 'Match',
			'foreignKey' => 'match_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function createFileName($fileName){
         //Logic for sanitizing your filename
         return $this->data['Match']['id']. ' ' . stripslashes($fileName);
    }
}
?>