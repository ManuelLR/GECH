<?php
	session_start();
	if (isset($_SESSION["crearPaciente"]) ){
		$crearPaciente["nombre"] = $_REQUEST["nombre"];
		$crearPaciente["apellidos"] = $_REQUEST["apellidos"];
		$crearPaciente["nuhsa"] = $_REQUEST["nuhsa"];
		$crearPaciente["nhc"]=$_REQUEST["nhc"];
		$crearPaciente["diagnostico"]=$_REQUEST["diagnostico"];
		$crearPaciente["medicacion"]=$_REQUEST["medicacion"];
		$crearPaciente["fechaInclusion"]=$_REQUEST["fechaInclusion"];
		$crearPaciente["idEnsayoClinico"]=$_REQUEST["idEnsayoClinico"];
		$_SESSION["crearPaciente"]=$crearPaciente;

		
		$erroresCreaPacientes = validar($crearPaciente);
		
		if ( count ($erroresCreaPacientes) > 0 ) {
			$_SESSION["erroresCreaPacientes"] = $erroresCreaPacientes;
			Header("Location: FormCreaPacientes.php");
		}
		else Header("Location: ExitoCreaPacientes.php");
	}
	else Header("Location: FormCreaPacientes.php");

	function validar($crearPaciente) {
		if (empty($crearPaciente["nombre"])) {
			$errores[] = "El nombre no puede estar vacio";}
		if (empty($crearPaciente["apellidos"])) {
			$errores[] = "Los apellidos no pueden estar vacios";}
		if (empty($crearPaciente["nuhsa"])) {
			$errores[] = "El NUHSA no pueden estar vacio";}
		if (empty($crearPaciente["nhc"])) {
			$errores[] = "El NHC no puede estar vacio";}
		if (empty($crearPaciente["diagnostico"])) {
			$errores[] = "El diagnostico no pueden estar vacio";}
		if (empty($crearPaciente["medicacion"])) {
			$errores[] = "La medicación no pueden estar vacia";}		
		if (empty($crearPaciente["fechaInclusion"])) {
			$errores[] = "La fecha de inclusión no pueden estar vacia";}
		if (empty($crearPaciente["idEnsayoClinico"])) {
			$errores[] = "El ID Ensayo Clínico no puede estar vacio";}		
		
		return $errores;
	}


?>