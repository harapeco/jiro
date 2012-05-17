<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package app.Controller
 * @author harapeco
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	/**
	 * index method
	 *
	 * @return void
	 * @access public
	 */
	public function index() {
		$this->{$this->uses[0]}->recursive = 0;
		$this->set(strtolower($this->name), $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 * @throws NotFoundException
	 * @access public
	 */
	public function view($id = null) {
		$this->{$this->uses[0]}->id = $id;
		if (!$this->{$this->uses[0]}->exists())
			throw new NotFoundException($this->_getMessage(ActionMessage::DATA_NOTFOUND));
		$this->set(strtolower($this->uses[0]), $this->{$this->uses[0]}->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 * @access public
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->{$this->uses[0]}->create();
			if ($this->{$this->uses[0]}->save($this->request->data)) {
				$this->Session->setFlash($this->_getMessage(ActionMessage::ADD_COMPLETE));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->_getMessage(ActionMessage::ADD_ERROR));
			}
		}
	}

	/**
	 * Get message
	 *
	 * @param string $identify message identify
	 * @param string | array $args string to replaced
	 * @access protected
	 */
	protected function _getMessage($identify, $args = array()) {
		!empty($args) && !is_array($args) && $args = (array)$args;
		array_unshift($args, strtolower($this->uses[0]));
		return ActionMessage::get($identify, $args);
	}

	/**
	 * Set flash message
	 *
	 * @param string $identify message identify
	 * @param string | array $args string to replaced
	 * @access protected
	 */
	protected function _setFlash($identify, $args = array()) {
		$this->Session->setFlash($this->_getMessage($identify, $args));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 * @access public
	 * @throws NotFoundException
	 * @access public
	 */
	public function edit($id = null) {
		$this->{$this->uses[0]}->id = $id;
		if (!$this->{$this->uses[0]}->exists())
			throw new NotFoundException($this->_getMessage(ActionMessage::DATA_NOTFOUND));
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->{$this->uses[0]}->save($this->request->data)) {
				$this->Session->setFlash($this->_getMessage(ActionMessage::EDIT_COMPLETE));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash($this->_getMessage(ActionMessage::EDIT_ERROR));
			}
		} else {
			$this->request->data = $this->{$this->uses[0]}->read(null, $id);
		}
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 * @access public
	 * @throws MethodNotAllowedException
	 * @access public
	 */
	public function delete($id = null) {
		if (!$this->request->is('post'))
			throw new MethodNotAllowedException();
		$this->{$this->uses[0]}->id = $id;
		if (!$this->{$this->uses[0]}->exists())
			throw new NotFoundException($this->_getMessage(ActionMessage::DATA_NOTFOUND));
		if ($this->{$this->uses[0]}->delete())
			$this->Session->setFlash($this->_getMessage(ActionMessage::DELETE_COMPLETE));
		else
			$this->Session->setFlash($this->_getMessage(ActionMessage::DELETE_ERROR));
		$this->redirect(array('action' => 'index'));
	}
}
