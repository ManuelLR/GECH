<?php //http://www.lsi.us.es/docencia/get.php?id=7938 página 6, abajo
session_start();
include_once ("../GestionarDB.php");
include_once ('GestionPacientes.php');
if (isset($_SESSION["crearPaciente"])) {//&& !(count($_SESSION["erroresCreaPacientes"]>0))){//En las transparencias no era así
	$crearPaciente = $_SESSION["crearPaciente"];
	unset($_SESSION["crearPaciente"]);
	unset($_SESSION["modPaciente"]);
	unset($_SESSION["erroresCreaPacientes"]);
} else {
	$_SESSION["erroresCreaPacientes"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
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
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro del Paciente</h3>
		<?php
$conexion=conectarBD();
if($crearPaciente["modificacion"]!="true"){
if (insertarPaciente($crearPaciente["nombre"], $crearPaciente["apellidos"], $crearPaciente["nuhsa"], $crearPaciente["nhc"],
$crearPaciente["diagnostico"], $crearPaciente["medicacion"], $crearPaciente["fechaInclusion"], $crearPaciente["idEnsayoClinico"], $conexion)){
?>
		<div id="div_exito">
			El paciente <?php echo $crearPaciente["nombre"] . " " . $crearPaciente["apellidos"]; ?>
			ha sido insertado correctamente.
		</div>
		<?php }else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el paciente <?php echo $crearPaciente["nombre"] . " " . $crearPaciente["apellidos"]; ?>
			<b>NO</b> ha sido insertado.
		</div>
		<?php $_SESSION["crearPaciente"] = $crearPaciente;
		}
	?><
		div id="div_volver"> Para volver al formulario pulsa <a href="FormCreaPacientes.php">aquí</a>.</div>
		<?php }else{
			if(modificarPaciente($conexion,$crearPaciente["ID_PAC"], $crearPaciente["nombre"], $crearPaciente["apellidos"], $crearPaciente["nuhsa"], $crearPaciente["nhc"],
			$crearPaciente["diagnostico"], $crearPaciente["medicacion"], $crearPaciente["fechaInclusion"], $crearPaciente["idEnsayoClinico"])){

		$_SESSION["exitoModPacientes"]="El paciente ". $crearPaciente["nombre"] . " " . $crearPaciente["apellidos"]." ha sido actualizado correctamente.";
		header("Location: MuestraPacientes.php");
		 }else{ 
			
		$_SESSION["errorModPacientes"]="El paciente ". $crearPaciente["nombre"] . " " . $crearPaciente["apellidos"]." <b>NO</b> ha sido actualizado correctamente.";
		header("Location: MuestraPacientes.php");
 } ?>
		<div id="div_volver">
			Para volver a la lista de pacientes pulsa <a href="MuestraPacientes.php">aquí</a>.
		</div>

		<?php }
	desconectarDB($conexion);
		?>
		<?php 	include_once("../Pie.php");
		?>
	</body>
</html>

