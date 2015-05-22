<?php session_start(); ?>
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
		<h1>Mapa de la web</h1>
		<div id="indiceInterno">
<h2>ordenar ! ! !</h2>
			<h2>Pacientes</h2>
			<?php
				include_once ("/pacientes/CodigoSQLPaciente.html");
			?>
			<h2>Fecha Pacientes</h2>
			<?php
				include_once ("/pacientes/citas/CodigoSQLPacCitas.html");
			?>
			
		</div>

		<?php 	include_once("Pie.php");
		?>
	</body>
</html>