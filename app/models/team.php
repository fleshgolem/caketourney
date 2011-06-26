<?php
class Team extends AppModel {
	var $name = 'Team';
	var $actsAs = array(
					'Containable',
                    'FileUpload.FileUpload' => array(
                        'uploadDir' => 'img/teamlogo',
                        'forceWebroot' => true,  //if false, files will be upload to the exact path of uploadDir
                        'fields' => array('name'=>'logo_name','type'=>'logo_type','size'=>'logo_size'),
                        'allowedTypes' => array(
												  'jpg' => array('image/jpeg', 'image/pjpeg'),
												  'jpeg' => array('image/jpeg', 'image/pjpeg'), 
												  'gif' => array('image/gif'),
												  'png' => array('image/png','image/x-png'),
												),
                        'required' => false, //default is false, if true a validation error would occur if a file wsan't uploaded.
                        'maxFileSize' => '500000', //bytes OR false to turn off maxFileSize (default false)
                        'unique' => true, //filenames will overwrite existing files of the same name. (default true)
                        'fileNameFunction' => false, //execute the Sha1 function on a filename before saving it (default false)
						'Containable'
                    )
    );
	var $validate = array(
		'leader_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
                'rule'      => 'isUnique',
                'message'   => 'Already taken',
            )
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Leader' => array(
			'className' => 'User',
			'foreignKey' => 'leader_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Invitation' => array(
			'className' => 'Invitation',
			'foreignKey' => 'team_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	var $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_teams',
			'foreignKey' => 'team_id',
			'associationForeignKey' => 'user_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'User.username ASC',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>