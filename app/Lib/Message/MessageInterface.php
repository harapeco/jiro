<?php
/**
 * Messages
 *
 * Interface of message contant class.
 *
 * @package app.Lib.Message
 * @author harapeco
 */
interface MessageInterface {

	/**
	 * Get message
	 *
	 * @param string $identify message identify
	 * @param array $args string to replace
	 */
	public static function get($identify, $args = array());
}