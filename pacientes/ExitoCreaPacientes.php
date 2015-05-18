<?php
//http://www.lsi.us.es/docencia/get.php?id=7938 página 6, abajo
	session_start();
	include_once("../GestionarDB.php"); 
	include_once('GestionPacientes.php');
	if(isset($_SESSION["crearPaciente"]) ){//&& !(count($_SESSION["erroresCreaPacientes"]>0))){//En las transparencias no era así
		$crearPaciente = $_SESSION["crearPaciente"];
		unset($_SESSION["crearPaciente"]);
		unset($_SESSION["erroresCreaPacientes"]);
	}else{
		Header("Location: FormCreaPacientes.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Paciente</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">  
	</head>
	<?php include_once("../CabeceraGenerica.php");?>
	<body>
	<h3>Estado Registro del Paciente</h3>
<?php
	$conexion=conectarBD();
	if (insertarPaciente($crearPaciente["nombre"], $crearPaciente["apellidos"], $crearPaciente["nuhsa"], $crearPaciente["nhc"],
		$crearPaciente["diagnostico"], $crearPaciente["medicacion"], $crearPaciente["fechaInclusion"], $crearPaciente["idEnsayoClinico"], $conexion)){
		?> <div id="div_exito">El paciente <?php echo $crearPaciente["nombre"] . " " . $crearPaciente["apellidos"];?> ha sido insertado correctamente.</div>	
	<?php }else{ ?>
		<div id="div_errorRegistro">Lo sentimos, el paciente <?php echo $crearPaciente["nombre"] . " " . $crearPaciente["apellidos"];?> <b>NO</b> ha sido insertado.</div>
	<?php 
		$_SESSION["crearPaciente"]=$crearPaciente;
		}
	desconectarDB($conexion);
?>	
<div id="div_volver"> Para volver al formulario pulsa <a href="FormCreaPacientes.php">aquí</a>.</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>

