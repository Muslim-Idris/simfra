<?php

class Config {

	private $entries;

	function __construct($configName) {
		$this->entries = include_namespace('configs/'.strtolower($configName).'.php');
	}

	function get($key) {
		return $this->entries[$key];
	}

}
