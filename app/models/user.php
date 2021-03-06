<?php


class User extends AppModel {
	var $name = 'User';
	var $actsAs = array(
					'Containable',
					'Searchable',
                    'FileUpload.FileUpload' => array(
                        'uploadDir' => 'img/avatar',
                        'forceWebroot' => true,  //if false, files will be upload to the exact path of uploadDir
                        'fields' => array('name'=>'avatar_name','type'=>'avatar_type','size'=>'avatar_size'),
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
	var $displayField = 'username';
	
	public $filterArgs = array(	
			array('name' => 'username', 'type' => 'like'),
			array('name' => 'bnetaccount', 'type' => 'like'),
			
	);
	
	var $hasAndBelongsToMany = array(
		'Tournament' => array(
			'className' => 'Tournament',
			'joinTable' => 'users_tournaments',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'tournament_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Team' => array(
			'className' => 'Team',
			'joinTable' => 'users_teams',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'team_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
	);
	
	

	var $hasMany = array(
		//Do not associate comments with users, to keep db queries low
		/*'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		/*'Signup' => array(
			'className' => 'Signup',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		'Match' => array(
			'className' => 'Match',
			'foreignKey' => 'player1_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Match' => array(
			'className' => 'Match',
			'foreignKey' => 'player2_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'recipient_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Ranking' => array(
			'className' => 'Ranking',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Casts' => array(
			'className' => 'Match',
			'foreignKey' => 'caster_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	var $validate = array(
	
		'avatar_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	
		'name' => array(
            'length' => array(
                'rule'      => array('minLength', 3),
                'message'   => 'Please enter your full name (more than 3 chars)',
                'required'  => true,
            ),
        ),
        'username' => array(
            'length' => array(
                'rule'      => array('minLength', 3),
                'message'   => 'Must be more than 3 characters',
                'required'  => true,
            ),
            'alphanum' => array(
                'rule'      => 'alphanumeric',
                'message'   => 'May only contain letters and numbers',
            ),
            'unique' => array(
                'rule'      => 'isUnique',
                'message'   => 'Already taken',
            ),
        ),
        'email' => array(
            'email' => array(
                'rule'      => 'email',
                'message'   => 'Must be a valid email address',
            ),
            'unique' => array(
                'rule'      => 'isUnique',
                'message'   => 'Already taken',
            ),
        ),
        'password' => array(
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
                'required'  => true,
            ),
        ),
        'password_confirm' => array(
            'compare'    => array(
                'rule'      => array('password_match', 'password', true),
                'message'   => 'The password you entered does not match',
                'required'  => true,
            ),
            'length' => array(
                'rule'      => array('between', 6, 20),
                'message'   => 'Use between 6 and 20 characters',
            ),
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
            ),
        ),
		'bnetaccount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'bnetcode' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'race' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	 /**
     * Ensure two password fields match
     *
     * @param   array   data provided by the controller
     * @param   string  the original (already hashed) password fieldname
     * @param   bool    whether the password field has been hashed,
     *                  only hashed when a username input is present
     */
    function password_match($data, $password_field, $hashed = true)
    {
        $password         = $this->data[$this->alias][$password_field];
        $keys             = array_keys($data);
        $password_confirm = $hashed ?
              Security::hash($data[$keys[0]], null, true) :
              $data[$keys[0]];
        return $password === $password_confirm;
    }
	/**
     * Extra form dependent validation rules
     */
    var $validateChangePassword = array(
        '_import' => array('password', 'password_confirm'),
        'password_old' => array(
            'correct' => array(
                'rule'      => 'password_old',
                'message'   => 'Does not match',
                'required'  => true,
            ),
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
            ),
        ),
    );
 
    /**
     * Dynamically adjust our validation behaviour
     *
     * Look for an _import key in new ruleset, and import
     * those rules from the base validation ruleset
     *
     * @param   string  array key of the validation ruleset to use
     */
    function useValidationRules($key)
    {
        $variable = 'validate' . $key;
        $rules = $this->$variable;
 
        if (isset($rules['_import'])) {
            foreach ($rules['_import'] as $key) {
                $rules[$key] = $this->validate[$key];
            }
            unset($rules['_import']);
        }
 
        $this->validate = $rules;
    }
 
    /**
     * Ensure password matches the user session
     *
     * @param   array   data provided by the controller
     */
    function password_old($data)
    {
        $password = $this->field('password',
            array('User.id' => $this->id));
        return $password ===
            Security::hash($data['password_old'], null, true);
    }
	function createFileName($fileName){
         //Logic for sanitizing your filename
         return stripslashes($fileName);
    }
	/**
     * Generate a random pronounceable password
     */
    function generatePassword($length = 10) {
        // Seed
        srand((double) microtime()*1000000);
 
        $vowels = array('a', 'e', 'i', 'o', 'u');
        $cons = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n',
            'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
            'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph',
            'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl');
 
        $num_vowels = count($vowels);
        $num_cons = count($cons);
 
        $password = '';
        for ($i = 0; $i < $length; $i++){
            $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
        }
 
        return substr($password, 0, $length);
    }
}
?>