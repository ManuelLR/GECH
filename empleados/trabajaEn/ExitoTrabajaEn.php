<?php 
session_start();
include_once ("../../GestionarDB.php");
include_once ('GestionTrabajaEn.php');
if (isset($_SESSION["trabajaEn"])) {
	$trabajaEn = $_SESSION["trabajaEn"];
	unset($_SESSION["trabajaEn"]);
	unset($_SESSION["erroresCreaTrabajaEn"]);
} else {
	$_SESSION["erroresCreaTrabajaEn"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormTrabajaEn.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Trabaja En</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">
	</head>
	<?php
		include_once ("../../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro del Trabaja En</h3>
<?php
$conexion=conectarBD();
if($trabajaEn["accionTraEn"]=="insert"){
	
	if (insertarTrabajaEn($trabajaEn["ID_EC"], $trabajaEn["ID_EMP"], $trabajaEn["cargo"], $conexion)){
	?>
		<div id="div_exito">
			El Trabaja En ha sido insertado correctamente.
		</div>
	<?php 
	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el Trabaja En <b>NO</b> ha sido insertado.-
		</div>
		<?php
		$_SESSION["trabajaEn"] = $trabajaEn;
	}
		?> <div id="div_volver"> Para volver al formulario pulsa <a href="FormTrabajaEn.php">aquí</a>.</div>
<?php
}elseif($trabajaEn["accionTraEn"]=="update"){
		if(modificarTrabajaEn($conexion, $trabajaEn["ID_EC"], $trabajaEn["ID_EMP"], $trabajaEn["cargo"])){

			$_SESSION["exitoModTrabajaEn"]="El Trabaja En ha sido actualizado correctamente.";
			header("Location: MuestraTrabajaEn.php");
		 }else{ 
			$errores[]="El Trabaja En <b>NO</b> ha sido actualizado correctamente.";
			$_SESSION["errorModTrabajaEn"]=$errores;
			header("Location: MuestraTrabajaEn.php");
		}
}
 elseif($trabajaEn["accionTraEn"]=="remove"){
 		$errores[]="El Trabaja En no se puede borrar debido a políticas del sistema";
		$_SESSION["errorModTrabajaEn"]=$errores;
		header("Location: MuestraTrabajaEn.php");	
 }
		 
	desconectarDB($conexion);
		?>
		<?php 	include_once("../../Pie.php");
		?>
	</body>
</html>

