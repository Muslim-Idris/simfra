<?php

class Singleton {

	/**
	 * Array containing all instances.
	 * @var array $instances
	 */
	private static $instances = array();

	/**
	 * Returns an existing instance of $className or creates a new instance.
	 * @param  string $className Class name
	 * @param  array  $args      Arguments (optional)
	 * @return object
	 */
	public static function getInstance($className, $args = array()) {
		$hash = self::getHash($className, $args);
		if(!isset(self::$instances[$hash])) {
			if($args) {
				$rc = new ReflectionClass($className);
				self::$instances[$hash] = $rc->newInstanceArgs($args);
			} else {
				self::$instances[$hash] = new $className();
			}
		}
		return self::$instances[$hash];
	}

	/**
	 * Check if an instance is existing or not.
	 * @param  string $className Class name
	 * @param  array  $args      Arguments (optional)
	 * @return bool
	 */
	public static function hasInstance($className, $args = array()) {
		$hash = self::getHash($className, $args);
		return isset(self::$instances[$hash]);
	}

	/**
	 * Return instance of $className only if it already exists.
	 * @param  string $className Class name
	 * @param  array  $args      Arguments (optional)
	 * @return object
	 */
	public static function getExistingInstance($className, $args = array()) {
		$hash = self::getHash($className, $args);
		return isset(self::$instances[$hash]) ? self::$instances[$hash] : false;
	}

	/**
	 * Return the hash value for $className and $args.
	 * @param  string $className Class name
	 * @param  array  $args      Arguments (optional)
	 * @return string
	 */
	private static function getHash($className, $args) {
		$className = strtolower($className);
		return $args
		     ? hash('crc32b', serialize(array($className, $args)))
		     : $className;
	}

	private function __construct() { }
	private function __clone() { }

}
