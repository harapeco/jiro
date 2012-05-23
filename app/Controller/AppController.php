<?php
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package app.Controller
 * @author harapeco
 */
class AppController extends Controller {

	/**
	 * Use components
	 *
	 * @var array
	 * @access public
	 */
	public $components = array(
		'Acl',
		'Auth' => array(
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers')
			)
		),
		'Session',
		'Security'
	);
	/**
	 * Use helpers
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array('Html', 'Form', 'Session');

	/**
	 * Before action callback
	 *
	 * @return void
	 * @see Controller::beforeFilter()
	 * @access public
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		// Configure AuthComponent
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'add');
		//$this->Auth->actionPath = 'controllers/';
		$this->Auth->allow('display');
	}

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
		// Invalid id.
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
			// Insert data
			if ($this->{$this->uses[0]}->save($this->request->data))
				$this->_redirectWithFlash(null, ActionMessage::ADD_COMPLETE);
			else
				$this->_setFlash(ActionMessage::ADD_ERROR);
		}
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 * @throws NotFoundException
	 * @access public
	 */
	public function edit($id = null) {
		$this->{$this->uses[0]}->id = $id;
		// Invalid id.
		if (!$this->{$this->uses[0]}->exists())
			throw new NotFoundException($this->_getMessage(ActionMessage::DATA_NOTFOUND));
		// Update data.
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->{$this->uses[0]}->save($this->request->data))
				$this->_redirectWithFlash(null, ActionMessage::EDIT_COMPLETE);
			else
				$this->_setFlash(ActionMessage::EDIT_ERROR);
		} else {
			$this->request->data = $this->{$this->uses[0]}->read(null, $id);
		}
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 * @throws MethodNotAllowedException
	 * @access public
	 */
	public function delete($id = null) {
		// Invalid http method.
		if (!$this->request->is('post'))
			throw new MethodNotAllowedException();
		$this->{$this->uses[0]}->id = $id;
		// Invalid id.
		if (!$this->{$this->uses[0]}->exists())
			throw new NotFoundException($this->_getMessage(ActionMessage::DATA_NOTFOUND));
		// Delete data.
		if ($this->{$this->uses[0]}->delete())
			$this->_redirectWithFlash(null, ActionMessage::DELETE_COMPLETE);
		else
			$this->_redirectWithFlash(null, ActionMessage::DELETE_ERROR);
	}

	/**
	 * Get message
	 *
	 * @param string $identify message identify
	 * @param string | array $args string to replaced
	 * @return string action message
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
	 * @return void
	 * @access protected
	 */
	protected function _setFlash($identify, $args = array()) {
		$this->Session->setFlash($this->_getMessage($identify, $args));
	}

	/**
	 * Set flash message and redirect url
	 *
	 * @param string | array $url redirect url
	 * @param string $identify message identify
	 * @param string | array $args string to replace
	 * @return void
	 * @access protected
	 */
	protected function _redirectWithFlash($url = null, $identify, $args = array()) {
		if (empty($url)) $url = array('action' => 'index');
		$this->_setFlash($identify, $args);
		$this->redirect($url);
	}
}
