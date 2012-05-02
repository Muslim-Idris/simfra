<?php

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
		$this->name = strtolower($name);
		$this->file = 'templates/'.$this->name.'.php';
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

}
