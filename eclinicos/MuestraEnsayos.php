<?php
	session_start();
	require_once("../GestionarDB.php"); 
	//include_once('gestionUsuarios.php');
	$conexion = conectarBD(); 
	include_once 'GestionEnsayos.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Crear nueva entrada</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Tablas.css">  
	</head>
	<?php include_once("../CabeceraGenerica.php");?>
	<h3>Muestra Ensayos</h3>
<body>	
	<div id='tablamuestra'>
	<?php
		$stmp = seleccionarEnsayos($conexion);
		echo "<table>";
		echo "<tr>";
		echo "<th class='situacion_actual'>Situación actual</th>";
		echo "<th class='criterio_inc'>Criterio de inclusión</th>";
		echo "<th class='criterio_exc'>Criterio de exclusión</th>";
		echo "<th class='farmaco'>Fármaco</th>";
		echo "</tr>";
		foreach ($stmp as $fila) {
			echo "<tr>";
			echo "<td class='situacion_actual'>".$fila["SITUACION_ACTUAL"]."</td>";
			echo "<td class='criterio_inc'>".$fila["CRITERIO_INC"]."</td>";
			echo "<td class='criterio_exc'>".$fila["CRITERIO_EXC"]."</td>";
			echo "<td class='farmaco'>".$fila["FARMACO"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	?>
	</div>

<?php 	include_once("../Pie.php"); ?>
</body>
</html>