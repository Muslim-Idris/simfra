<!DOCTYPE html>
<html>
	<head>
		<title>004 - Objekte iterieren</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>004 - Objekte iterieren</h1>
		<ul>
			<li>Iteratoren sind nützlich für Objekte, die Daten zur Verfügung stellen</li>
		</li>

		<code><?php
highlight_string('
<?php

	class DB_Result {

		private $key = 0;
		private $stmt;
		private $current;

		public function __constructor($stmt) {
			$this->stmt = $stmt;
			$this->stmt->setFetchMode(PDO::FETCH_CLASS);
			$this->current = $this->stmt->fetch();
		}

		public function rewind() {
			$this->current = false;
		}

		public function next() {
			$this->key++;
			$this->current = $this->stmt->fetch();
		}

		public function key() {
			return $this->key;
		}

		public function current() {
			return $this->current;
		}

		public function valid() {
			return $this->current;
		}

	}

?>
');

?></code>
	</body>
</html>
