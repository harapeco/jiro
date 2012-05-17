<?php

/**
 * Abstract message
 *
 * @package app.Lib.Message
 * @author harapeco
 */
class AbstractMessage implements MessageInterface {
	/**
	 *
	 * Messages
	 *
	 * @var Array
	 * @access protected
	 */
	protected static $_messages;

	/**
	 * Get message
	 *
	 * @param string $identify message identify
	 * @param string | array $args string to be replaced
	 * @throws LogicException
	 * @access public
	 */
	public static function get($identify, $args = array()) {
		if (empty(static::$_messages[$identify]))
			throw new LogicException(sprintf('Message is not found. identify: %s', $identify));
		$msg = static::$_messages[$identify];
		if (!empty($args)) {
			!is_array($args) && $args = (array)$args;
			$msg = vsprintf($msg, $args);
		}
		return __($msg, TRUE);
	}
}