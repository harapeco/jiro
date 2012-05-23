<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	/*
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('initDB');
	}

	public function initDB() {
		$group = $this->User->Group;
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');
		$this->Acl->allow($group, 'controllers/Widgets');
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts/add');
		$this->Acl->allow($group, 'controllers/Posts/edit');
		$this->Acl->allow($group, 'controllers/Widgets/add');
		$this->Acl->allow($group, 'controllers/Widgets/edit');
		echo "all done";
		exit;
	}
	*/

	/**
	 * add method
	 *
	 * @return void
	 * @see AppController::add()
	 * @access public
	 */
	public function add() {
		parent::add();
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 * @see AppController::edit()
	 * @access public
	 */
	public function edit($id = null) {
		parent::edit();
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * Login method
	 *
	 * @return void
	 * @access public
	 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login())
				$this->redirect($this->Auth->redirect());
			else
				$this->_setFlash(ActionMessage::AUTH_ERROR);
		}
	}

	/**
	 * Logout method
	 *
	 * @return void
	 * @access public
	 */
	public function logout() {
		$this->_setFlash(ActionMessage::AUTH_LOGOUT);
		$this->redirect($this->Auth->logout());
	}
}
