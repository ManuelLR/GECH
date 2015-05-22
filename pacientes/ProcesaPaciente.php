<?php
	session_start();
	if (isset($_SESSION["paciente"])){
		$paciente["ID_PAC"]=$_REQUEST["ID_PAC"];		
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
		$paciente["nuhsa"] = $_REQUEST["nuhsa"];
		$paciente["nhc"]=$_REQUEST["nhc"];
		$paciente["diagnostico"]=$_REQUEST["diagnostico"];
		$paciente["medicacion"]=$_REQUEST["medicacion"];
		$paciente["fechaInclusion"]=$_REQUEST["fechaInclusion"];
		$paciente["idEnsayoClinico"]=$_REQUEST["idEnsayoClinico"];
		$paciente["accion"]=$_REQUEST["accion"];
		$_SESSION["paciente"]=$paciente;

		
		$erroresPacientes = validar($paciente);
		
		if(!isset($_REQUEST["accion"])) {
			$erroresCreaPacientes[]="Acción indefinida";
			$_SESSION["erroresCreaPacientes"]=$erroresCreaPacientes;
			Header("Location: FormPacientes.php");
		}
		elseif($_REQUEST["accion"]=="insert"){
			if(count ($erroresPacientes) > 0){
				$_SESSION["erroresCreaPacientes"]=$erroresCreaPacientes;
				Header("Location: FormPacientes.php");
			}else{
			Header("Location: ExitoPacientes.php");}
		}
		elseif($_REQUEST["accion"]=="update"){
			if(count ($erroresPacientes) > 0){
				$_SESSION["erroresCreaPacientes"]=$erroresCreaPacientes;
				$paciente["accion"]="pre-update";
				$_SESSION["paciente"]=$paciente;
				Header("Location: FormPacientes.php");
			}else{
				header("Location: ExitoPacientes.php");}
		}
		elseif($_REQUEST["accion"]=="pre-update"){
			header("Location: FormPacientes.php");
		}
	}else{
		$erroresCreaPacientes[]="La sesión no ha sido iniciada";
		Header("Location: FormPacientes.php");
		unset($_SESSION["paciente"]);
		$_SESSION["erroresCreaPacientes"]=$erroresCreaPacientes;}

	function validar($paciente) {
		if (empty($paciente["nombre"])) {
			$errores[] = "El nombre no puede estar vacio";}
		if (empty($paciente["apellidos"])) {
			$errores[] = "Los apellidos no pueden estar vacios";}
		if (empty($paciente["nuhsa"])) {
			$errores[] = "El NUHSA no pueden estar vacio";}
		if (empty($paciente["nhc"])) {
			$errores[] = "El NHC no puede estar vacio";}
		if (empty($paciente["diagnostico"])) {
			$errores[] = "El diagnostico no pueden estar vacio";}
		if (empty($paciente["medicacion"])) {
			$errores[] = "La medicación no pueden estar vacia";}		
		if (empty($paciente["fechaInclusion"])) {
			$errores[] = "La fecha de inclusión no pueden estar vacia";}
		if (empty($paciente["idEnsayoClinico"])) {
			$errores[] = "El ID Ensayo Clínico no puede estar vacio";}			
		return $errores;
	}


?>