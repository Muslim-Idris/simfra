<?php

class Config implements ArrayAccess, Countable {

	/**
	 * Contains all configuration key-value pairs.
	 * @var array $data
	 */
	private $data = array();

	/**
	 * Copy of $data.
	 * @var array $origData
	 */
	private $origData = array();

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
		$data = include_namespace($this->file);
		if(is_array($data)) {
			$this->data = $this->origData = $data;
		}
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
	 * Getter method for configuration values.
	 * @param  string $key
	 * @return mixed
	 */
	function __get($key) {
		return $this->data[$key];
	}

	/**
	 * Setter method for configuration values.
	 * @param  string $key
	 * @param  mixed  $value
	 */
	function __set($key, $value) {
		$this->data[$key] = $value;
	}

	/**
	 * Change or set configuration $key to $value.
	 */
	public function offsetSet($key, $value) {
		$this->data[$key] = $value;
	}

	/**
	 * Get configuration $key.
	 */
	public function offsetGet($key) {
		return $this->data[$key];
	}

	/**
	 * Delete $key from configuration.
	 */
	public function offsetUnset($key) {
		unset($this->data[$key]);
	}

	/**
	 * Check if $key exists in configuration.
	 */
	public function offsetExists($key) {
		return isset($this->data[$key]);
	}

	/**
	 * Make each Config instance countable.
	 */
	public function count() {
		return count($this->data);
	}

}
