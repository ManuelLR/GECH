<?php
//http://www.lsi.us.es/docencia/get.php?id=7938 página 6, abajo
	session_start();
	include_once("../GestionarDB.php"); 
	include_once('GestionEnsayos.php');
	if(isset($_SESSION["crearEnsayo"]) ){//&& !(count($_SESSION["erroresCreaEnsayos"]>0))){//En las transparencias no era así
		$crearEnsayo = $_SESSION["crearEnsayo"];
		unset($_SESSION["crearEnsayo"]);
		unset($_SESSION["erroresCreaEnsayos"]);
	}else{
		Header("Location: FormCreaEnsayos.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Ensayo Clínico</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">  
	</head>
	<?php include_once("../CabeceraGenerica.php");?>
	<body>
	<h3>Estado Registro del Ensayo Clínico</h3>
<?php
	$conexion=conectarBD();
	if (insertarEnsayo($crearEnsayo["situacion_actual"], $crearEnsayo["criterio_inc"], $crearEnsayo["criterio_exc"], $crearEnsayo["inicio_rec"],
		$crearEnsayo["fin_rec"], $crearEnsayo["farmaco"], $conexion)){
		?> <div id="div_exito">El Ensayo ha sido insertado correctamente.</div>	
	<?php }else{ ?>
		<div id="div_errorRegistro">Lo sentimos, el Ensayo <b>NO</b> ha sido insertado.</div>
	<?php 
		$_SESSION["crearEnsayo"]=$crearEnsayo;
		}
	desconectarDB($conexion);
?>	
<div id="div_volver"> Para volver al formulario pulsa <a href="FormCreaEnsayos.php">aquí</a>.</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>

