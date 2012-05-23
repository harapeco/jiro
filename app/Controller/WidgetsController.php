<?php
App::uses('AppController', 'Controller');
/**
 * Widgets Controller
 *
 * @property Widget $Widget
 */
class WidgetsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'view'));
	}
}
