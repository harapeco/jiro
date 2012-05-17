<?php

/**
 * Message related to the action
 *
 * @package app.Lib.Message
 * @author harapeco
 */
class ActionMessage extends AbstractMessage {

	/* Message constants */
	const INDEX_BUTTON = 'indexButton';
	const INDEX_LINK = 'indexLink';
	const VIEW_BUTTON = 'viewButton';
	const VIEW_LINK = 'viewLink';
	const ADD_BUTTON = 'addButton';
	const ADD_LINK = 'addLink';
	const ADD_ERROR = 'addError';
	const ADD_COMPLETE = 'addComplete';
	const EDIT_BUTTON = 'editButton';
	const EDIT_LINK = 'editLink';
	const EDIT_ERROR = 'editError';
	const EDIT_COMPLETE = 'editComplete';
	const DELETE_BUTTON = 'deleteButton';
	const DELETE_LINK = 'deleteLink';
	const DELETE_ERROR = 'deleteError';
	const DELETE_COMPLETE = 'deleteComplete';
	const DATA_NOTFOUND = 'dataNotfound';

	/**
	 * Messages
	 *
	 * @var array
	 * @access protected
	 */
	protected static $_messages = array(
		self::INDEX_BUTTON => 'Index',
		self::INDEX_LINK => '',
		self::VIEW_BUTTON => 'View',
		self::VIEW_LINK => '',
		self::ADD_BUTTON => 'Add',
		self::ADD_LINK => '',
		self::ADD_ERROR => 'The %s could not be saved. Please, try again.',
		self::ADD_COMPLETE => 'The %s has been saved.',
		self::EDIT_BUTTON => 'Edit',
		self::EDIT_LINK => '',
		self::EDIT_ERROR => 'The %s could not be updated. Please, try again.',
		self::EDIT_COMPLETE => 'The %s has been updated.',
		self::DELETE_BUTTON => 'Delete',
		self::DELETE_LINK => '',
		self::DELETE_ERROR => 'The %s cound not be deleted. Please, try again.',
		self::DELETE_COMPLETE => 'The %s has been deleted.',
		self::DATA_NOTFOUND => 'Invalid %s'
	);
}