<?php //http://www.lsi.us.es/docencia/get.php?id=7938 página 6, abajo
session_start();
include_once ("../GestionarDB.php");
include_once ('GestionPacientes.php');
if (isset($_SESSION["paciente"])) {//&& !(count($_SESSION["erroresCreaPacientes"]>0))){//En las transparencias no era así
	$paciente = $_SESSION["paciente"];
	unset($_SESSION["paciente"]);
	unset($_SESSION["erroresCreaPacientes"]);
} else {
	$_SESSION["erroresCreaPacientes"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormPacientes.php");
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
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro del Paciente</h3>
		<?php
$conexion=conectarBD();
if($paciente["accion"]=="insert"){
if (insertarPaciente($paciente["nombre"], $paciente["apellidos"], $paciente["nuhsa"], $paciente["nhc"],
$paciente["diagnostico"], $paciente["medicacion"], $paciente["fechaInclusion"], $paciente["idEnsayoClinico"], $conexion)){
?>
		<div id="div_exito">
			El paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]; ?>
			ha sido insertado correctamente.
		</div>
		<?php }else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]; ?>
			<b>NO</b> ha sido insertado.-
		</div>
		<?php $_SESSION["paciente"] = $paciente;
		}
	?> <div id="div_volver"> Para volver al formulario pulsa <a href="FormPacientes.php">aquí</a>.</div>
		<?php }elseif($paciente["accion"]=="update"){
			if(modificarPaciente($conexion,$paciente["ID_PAC"], $paciente["nombre"], $paciente["apellidos"], $paciente["nuhsa"], $paciente["nhc"],
			$paciente["diagnostico"], $paciente["medicacion"], $paciente["fechaInclusion"], $paciente["idEnsayoClinico"])){

		$_SESSION["exitoModPacientes"]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." ha sido actualizado correctamente.";
		header("Location: MuestraPacientes.php");
		 }else{ 
		$errores[]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." <b>NO</b> ha sido actualizado correctamente.";
		$_SESSION["errorModPacientes"]=$errores;
		header("Location: MuestraPacientes.php");
 }}
 elseif($paciente["accion"]=="remove"){
 		$errores[]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." no se puede borrar debido a políticas del sistema";
		$_SESSION["errorModPacientes"]=$errores;
		header("Location: MuestraPacientes.php");	
 }
		 
		 
		 
		  ?>
		<?php 
	desconectarDB($conexion);
		?>
		<?php 	include_once("../Pie.php");
		?>
	</body>
</html>

