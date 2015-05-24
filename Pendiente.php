<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GECH</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
	</head>
	<body>
		<?php
		include_once ("CabeceraGenerica.php");
		?>
<div id="contenidoPag">
		<h1>Cosas que nos faltan</h1>
		Puesto así para evitar concurrencia <b>NO</b> porque debamos hacerlo cada uno.
		<div id="indiceInterno">
			<h3>Apuntado por Manolo</h3>
		<?php
		include_once ("PendienteManolo.html");
		?>
			<h3>Apuntado por Migue</h3>
		<?php
		include_once ("PendienteMigue.html");
		?>			
		</div>
</div>
		<?php
			include_once ("Pie.php");
		?>
	</body>
</html>