<?php

class User {

	private $firstname = '';
	private $lastname = '';
	private $age = '';

	function __construct($firstname, $lastname, $age) {
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->age = $age;
	}

}
