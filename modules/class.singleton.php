<?php

class Singleton {

	private static $instances = array();

	public function getInstance($className, $args = array()) {
		$hash = hash('crc32b', serialize(compact('className', 'args')));
		if(!isset(self::$instances[$hash])) {
			$rc = new ReflectionClass($className);
			self::$instances[$hash] = $rc->newInstanceArgs($args);
		}
		return self::$instances[$hash];
	}

	private function __construct() { }
	private function __clone() { }

}
