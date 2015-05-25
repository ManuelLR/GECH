<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GECH</title>
		<link type="text/css" rel="stylesheet" href="css/BaseDiseno.css">
	</head>
	<body>
		<?php
		include_once ("CabeceraGenerica.php");
		?>
<div id="contenidoPag">
		<h1>Mapa de la web</h1>
		<div id="indiceInterno">

			<h2>Pacientes</h2>
			<?php
				include_once ("/pacientes/pacientes.html");
			?>
			<h2>Promotores</h2>
			<?php
				include_once ("/promotores/promotores.html");
			?>
			<h2>Ensayos Clínicos</h2>
			<?php
				include_once ("/eclinicos/ensayosclinicos.html");
			?>
			<h2>Empleados</h2>
			<?php
				include_once ("/empleados/empleados.html");
			?>
		</div>
</div>
		<?php 	include_once("Pie.php");
		?>
	</body>
</html>