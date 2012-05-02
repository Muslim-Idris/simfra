<?php

class Config {

	/**
	 * Contains all configuration key-value pairs.
	 * @var array $data
	 */
	private $data = null;

	/**
	 * Copy of $data.
	 * @var array $origData
	 */
	private $origData = null;

	/**
	 * Configuration name.
	 * @var string $name
	 */
	private $name;

	/**
	 * Configuration file path.
	 * @var string $file
	 */
	private $file;

	/**
	 * The constructor expects the configuration filename.
	 * @param string $name
	 */
	public function __construct($name) {
		$this->name = strtolower($name);
		$this->file = 'configs/'.$this->name.'.php';
	}

	/**
	 * The destructor saves changes to the configuration file.
	 */
	public function __destruct() {
		if($this->data !== $this->origData) {
			$content = "<?php\n"
			         . "\n"
						. "return " . var_export($this->data, true)
						;
			file_put_contents($this->file, var_export($this->data, true));
		}
	}

	/**
	 * Load configuration data.
	 */
	private function initData() {
		$this->data = $this->origData = include_namespace($this->file);
	}

	/**
	 * Getter method for configuration values.
	 * @param  string $key
	 * @return mixed
	 */
	function __get($key) {
		if($this->data === null)
			$this->initData();
		return $this->data[$key];
	}

	/**
	 * Setter method for configuration values.
	 * @param  string $key
	 * @param  mixed  $value
	 */
	function __set($key, $value) {
		if($this->data === null)
			$this->initData();
		$this->data[$key] = $value;
	}

}
