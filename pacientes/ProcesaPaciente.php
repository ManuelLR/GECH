<?php
	session_start();
	
	$paciente["ID_PAC"]=$_REQUEST["ID_PAC"];
	$paciente["nombre"]=$_REQUEST["NOMBRE"];
	$paciente["apellidos"]=$_REQUEST["APELLIDOS"];
	$paciente["nuhsa"]=$_REQUEST["NUHSA"];
	$paciente["nhc"]=$_REQUEST["NHC"];
	$paciente["diagnostico"]=$_REQUEST["DIAGNOSTICO"];
	$paciente["medicacion"]=$_REQUEST["MEDICACION_AUX"];
	$paciente["fechaInclusion"]=$_REQUEST["FECHA_INCLUSION"];
	$paciente["idEnsayoClinico"]=$_REQUEST["ID_EC"];

	
	$_SESSION["paciente"]=$paciente;
	
	if(isset($_REQUEST["editar"])){
		header("Location:FormCreaPacientes.php");
		$_SESSION["crearPaciente"]=$paciente;
	}elseif(isset($_REQUEST["quitar"])){
		
	}elseif(isset($_REQUEST["masInfo"])){
		
	}else{
		echo "Has seleccionado una opción invalida";
	}



?>
