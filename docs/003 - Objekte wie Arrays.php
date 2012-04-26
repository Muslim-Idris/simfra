<!DOCTYPE html>
<html>
	<head>
		<title>003 - Objekte wie Arrays</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>003 - Objekte wie Arrays</h1>
		<ul>
			<li>Nützlich für Container-Klassen wie Sessions oder Cookies</li>
			<li>Zusätzliche Vorteile durch den Destruktor der Klasse (z.B. Speichern der Session-Variablen)</li>
		</ul>
		<h2>Beispielcode: kleine Session-Klasse</h2>
		<code><?php
highlight_string('
<?php

class Session {

	private $vars = array();
	private $prevVars = array();

	public function __constructor() {
		// $this->vars initialisieren
	}

	public function __destructor() {
		if($this->vars !== $this->prevVars) {
			// $this->vars wieder speichern
			// wenn neue Einträge gemacht oder
			// gelöscht wurden
		}
	}

	public function offsetExists($offset) {
		return isset($this->vars[$offset]);
	}

	public function offsetGet($offset) {
		return $this->vars[$offset];
	}

	public function offsetSet($offset, $value) {
		$this->vars[$offset] = $value;
	}

	public function offsetUnset($offset) {
		unset($this->vars[$offset];
	}

}

?>
');
?></code>
	</body>
</html>
