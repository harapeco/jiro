<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property  $
 */
class Group extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $hasMany = array('User');
	public $actsAs = array('Acl' => array('type' => 'requester'));
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

	public function parentNode() {
		return null;
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed



}
