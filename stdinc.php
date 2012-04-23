<?php

function stdinc_namespace() {

	function append_include_path($path) {
		$arrIncPath = explode(':', get_include_path());
		foreach(func_get_args() as $path) {
			if(in_array($path, $arrIncPath) === false) {
				$arrIncPath[] = $path;
			}
		}
		set_include_path(implode(':', $arrIncPath));
	}

	function include_namespace($__file__, $__vars__ = array()) {
		extract($__vars__);
		return include($__file__);
	}
	function require_namespace($__file__, $__vars__ = array()) {
		extract($__vars__);
		return require($__file__);
	}
	function include_once_namespace($__file__) {
		return include_once($__file__);
	}
	function require_once_namespace($__file__) {
		return require_once($__file__);
	}

	function load() {
		foreach(func_get_args() as $filename) {
			require_once_namespace($filename);
		}
	}

	spl_autoload_register(function($className) {
		require_once_namespace('modules/class.'.strtolower($className).'.php');
	});

};

stdinc_namespace();
append_include_path(__DIR__);
