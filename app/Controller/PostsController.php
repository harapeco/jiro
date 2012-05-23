<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class PostsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'view'));
	}
}
