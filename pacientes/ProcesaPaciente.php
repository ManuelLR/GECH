<?php
	session_start();
	
if(!isset($_REQUEST["accionPac"])) {
			$erroresCreaPacientes[]="Acción indefinida";
			$_SESSION["erroresCreaPacientes"]=$erroresCreaPacientes;
			Header("Location: FormPacientes.php");
}else{
			$paciente["ID_PAC"]=$_REQUEST["ID_PAC"];		
			$paciente["nombre"] = $_REQUEST["nombre"];
			$paciente["apellidos"] = $_REQUEST["apellidos"];
			$paciente["nuhsa"] = $_REQUEST["nuhsa"];
			$paciente["nhc"]=$_REQUEST["nhc"];
			$paciente["diagnostico"]=$_REQUEST["diagnostico"];
			$paciente["medicacion"]=$_REQUEST["medicacion"];
			$paciente["fechaInclusion"]=$_REQUEST["fechaInclusion"];
			$paciente["idEnsayoClinico"]=$_REQUEST["idEnsayoClinico"];
			$paciente["accionPac"]=$_REQUEST["accionPac"];
			$_SESSION["paciente"]=$paciente;	
		

		if($_REQUEST["accionPac"]=="insert"){	
			$erroresPacientes = validar($paciente);
			if(count ($erroresPacientes) > 0){
				$_SESSION["erroresCreaPacientes"]=$erroresPacientes;
				Header("Location: FormPacientes.php");
			}else{
				Header("Location: ExitoPacientes.php");}
		}
		elseif($_REQUEST["accionPac"]=="update"){
			$erroresPacientes = validar($paciente);
			if(count ($erroresPacientes) > 0){
				$_SESSION["erroresCreaPacientes"]=$erroresPacientes;
				$paciente["accionPac"]="pre-update";
				$_SESSION["paciente"]=$paciente;
				Header("Location: FormPacientes.php");
			}else{
				header("Location: ExitoPacientes.php");}
		}
		elseif($_REQUEST["accionPac"]=="pre-update"){
			header("Location: FormPacientes.php");
		}
		elseif($_REQUEST["accionPac"]=="more"){
			header("Location: MuestraUnPaciente.php");
		}
		elseif($_REQUEST["accionPac"]=="calendar"){
			$citaPac["accionCitaPac"]="view";
			$_SESSION["citaPac"]=$citaPac;
			header("Location: citas/ProcesaPacCita.php");
			
		}elseif($_REQUEST["accionPac"]=="remove"){
			header("Location: ExitoPacientes.php");			
		}
}


	function validar($paciente) {
		if (empty($paciente["nombre"])) {
			$errores[] = "El nombre no puede estar vacio";}
		if (empty($paciente["apellidos"])) {
			$errores[] = "Los apellidos no pueden estar vacios";}
		if (empty($paciente["nuhsa"])) {
			$errores[] = "El NUHSA no pueden estar vacio";}
		if (empty($paciente["nhc"])) {
			$errores[] = "El NHC no puede estar vacio";}
		if (empty($paciente["idEnsayoClinico"])) {
			$errores[] = "El ID Ensayo Clínico no puede estar vacio";}			
		return $errores;
	}


?>