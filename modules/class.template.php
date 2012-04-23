<?php

class Template {

	private $name;
	private $file;
	private $vars = array();

	public function __construct($name) {
		$this->name = strtolower($name);
		$this->file = "templates/{$this->name}.php";
	}

	public function assign($key, $value = '') {
		if(is_array($key)) {
			$this->vars = array_merge($this->vars, $key);
		} else {
			$this->vars[$key] = $value;
		}
	}

	public function exec() {
		$prevErrorLevel = error_reporting(E_ERROR);
		require_namespace($this->file, $this->vars);
		// restore previouse error level
		error_reporting($prevErrorLevel);
	}

	public static function execStatic($name) {
		Singleton::getInstance(__CLASS__, array($name))->exec();
	}

}
