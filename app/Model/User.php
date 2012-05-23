<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array('Group');
	public $hasMany = array('Post');
	public $actsAs = array('Acl' => array('type' => 'requester'));

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role' => array(
			'inlist' => array(
				'rule' => array('inlist', array('admin', 'shop', 'user')),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
	 * Before save callback
	 *
	 * @param array $options
	 * @return boolean True if the operation should continue, false if it should abort
	 * @see Model::beforeSave()
	 * @access public
	 */
	public function beforeSave($options = array()) {
		parent::beforeSave($options);
		$this->data['User']['password'] = AuthComponent::password(
				$this->data['User']['password']
		);
		return true;
	}

	/**
	 * After save callback
	 *
	 * @return void
	 * @see Model::afterSave()
	 * @access public
	 */
	public function afterSave($created) {
		parent::afterDelete();
		if (!$created) {
			$parent = $this->parentNode();
			$parent = $this->node($parent);
			$node = $this->node();
			$aro = $node[0];
			$aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
			$this->Aro->save($aro);
		}
	}

	/**
	 *
	 *
	 */
	public function parentNode() {
		if (!$this->id && empty($this->data)) return null;
		if (isset($this->data['User']['group_id']))
			$groupId = $this->data['User']['group_id'];
		else
			$groupId = $this->field('group_id');
		if (!$groupId)
			return null;
		else
			return array('Group' => array('id' => $groupId));
	}

	/**
	 *
	 *
	 * @param array $user User model object
	 * @return array bind node object
	 */
	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}
}
