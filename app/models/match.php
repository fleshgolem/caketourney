<?php
class Match extends AppModel {
	var $name = 'Match';
	var $recursive = 1;
	var $validate = array(
		'round_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'player1_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'player2_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'open' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'match_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Replay' => array(
			'className' => 'Replay',
			'foreignKey' => 'match_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		));
	var $belongsTo = array(
		'Round' => array(
			'className' => 'Round',
			'foreignKey' => 'round_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Player1' => array(
			'className' => 'User',
			'foreignKey' => 'player1_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Player2' => array(
			'className' => 'User',
			'foreignKey' => 'player2_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>