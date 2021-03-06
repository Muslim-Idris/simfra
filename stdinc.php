﻿<?php

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

// It's always safe to execute
// PHP code in seperate namespace
function stdinc_namespace() {

	function append_include_path() {
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
	function include_once_namespace($__file__, $__vars__ = array()) {
		extract($__vars__);
		return include_once($__file__);
	}
	function require_once_namespace($__file__, $__vars__ = array()) {
		extract($__vars__);
		return require_once($__file__);
	}

	function load() {
		foreach(func_get_args() as $filename) {
			require_once_namespace($filename);
		}
	}

	spl_autoload_register(function($className) {
		require_once_namespace('modules/class.'.$className.'.php');
	});

};

stdinc_namespace();
append_include_path(__DIR__);
