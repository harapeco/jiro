<?php
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package app.Model
 * @author harapeco
 */
class AppModel extends Model {
	/**
	 * True if add a audit data automatically when you save the data,
	 * false if it should abort.
	 *
	 * @var boolean
	 */
	protected $_audit = true;

	/**
	 * Before save callback
	 *
	 * @return boolean True if the operation should continue, false if it should abort
	 * @see Model::beforeSave()
	 * @access public
	 */
	public function beforeSave($options = array()) {
		$ret = parent::beforeSave($options);
		$this->_audit && $this->data[$this->name] = array_merge(
			$this->data[$this->name],
			$this->_createAudit()
		);
		return $ret;
	}

	/**
	 * Create data to be inserted into the column
	 *
	 * @return array audit data
	 * @access protected
	 */
	protected function _createAudit() {
		return array(
			'create_at' => 'test',
			'modify_at' => 'test'
		);
	}
}
