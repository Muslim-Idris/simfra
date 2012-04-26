<!DOCTYPE html>
<html>
	<head>
		<title>Closures und Lambda-Funktionen</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Closures und Lambda-Funktionen</h1>
		<ul>
			<li>Lambdas und Closures unterscheiden sich lediglich durch das Schlüsselwort "use"</li>
			<li>Lambdas werden nur solange im Speicher gehalten, wie es nötig ist</li>
			<li>Möglichkeiten wie in JavaScript, nur besser kontrollierbar</li>
			<li>Sinnvoll eingesetzt sind Closures sehr schnell</li>
			<li>Closures können auch static sein (spart evtl. Resourcen)</li>
		</ul>

		<h2>Beispiel: Debugger-Funktion</h2>
		<code><?php
highlight_string('
<?php

	function createDebugger($ype) {
		return function($msg) use($type) {
			echo "[", $type, "] ", $msg, "\n";
		};
	}

?>');
?></code>
	</body>
</html>
