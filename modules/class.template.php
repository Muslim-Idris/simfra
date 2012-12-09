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

class Template {

	/**
	 * Template Name.
	 * @var string $name
	 */
	private $name;

	/**
	 * Template file path.
	 * @var string $file
	 */
	private $file;

	/**
	 * Assigned variables.
	 * @var array $vars
	 */
	private $vars = array();

	/**
	 * Constructor which expects the template name in $name.
	 * @var  string $name
	 */
	public function __construct($name) {
		$this->name = $name;
		$this->file = 'templates/'.$name.'.php';
	}

	/**
	 * Assign $key to the variables.
	 * @param  string $key
	 * @param  mixed  $value
	 */
	public function assign($key, $value = '') {
		$this->vars[$key] = $value;
	}

	/**
	 * Assign key-value pairs to the variables.
	 * @param  array $vars
	 */
	public function assignArray(Array $vars) {
		$this->vars = array_merge($this->vars, $vars);
	}

	/**
	 * Execute the template.
	 */
	public function exec() {
		$prevErrorLevel = error_reporting(E_ERROR);
		require_namespace($this->file, $this->vars);
		// restore previouse error level
		error_reporting($prevErrorLevel);
	}

	/**
	 * Execute the template $name if it is an instance available.
	 * @param  string $name
	 */
	public static function execStatic($name) {
		if($template = Singleton::getExistingInstance(__CLASS__, array($name))) {
			$template->exec();
		}
	}

	/**
	 * Setter method to assign or change value without using the assign() method.
	 */
	public static __set($key, $value) {
		$this->vars[$key] = $value;
	}

	/**
	 * Getter method to get value without using the get() method.
	 */
	public static __get($key) {
		return $this->vars[$key];
	}

}
