<?php

/**
 * Copyright (C) 2012 Muslim Idris <gelamu@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
 * USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

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
		return $args
		     ? hash('crc32b', serialize(array($className, $args)))
		     : $className;
	}

	private function __construct() { }
	private function __clone() { }

}
