<?php
	session_start();
if (isset($_SESSION["paciente"])) {
	$paciente = $_SESSION["paciente"];
	if($paciente["accion"]=="calendar"){
		echo "Ha entrado un paciente por lo que solo debe mostrar las citas del paciente";
	}else{
		$errores[]="No se ha podido mostrar la cita del paciente ". $paciente["nombre"] . " " . $paciente["apellidos"];
		$_SESSION["errorModPacientes"]=$errores;
		header("Location: MuestraPacientes.php");
	}
} else {
	echo "NO Ha entrado paciente por lo que solo debe mostrar todas las citas";
}
	
	
?>