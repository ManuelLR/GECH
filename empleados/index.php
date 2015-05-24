<?php 
session_start(); 
unset($_SESSION["empleado"]);
unset($_SESSION["trabajaEn"]);
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
		include_once ("../CabeceraGenerica.php");
		?>
<div id="contenidoPag">
		<div id="indiceInterno">
			<?php
			include_once ("empleados.html");
			include_once ("trabajaEn/trabajaEn.html");
			?>
		</div>
</div>
		<?php
			include_once ("../Pie.php");
		?>
	</body>
</html>