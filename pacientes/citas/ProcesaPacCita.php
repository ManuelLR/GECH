<?php
session_start();

if (#!isset($_REQUEST["accionCitaPac"])){#&&
	!isset($_SESSION["citaPac"])){
	$erroresCita[]="Acción indefinida";
	$_SESSION["erroresCreaPacCitas"]=$erroresCita;
	Header("Location: FormPacCitas.php");
	
}else{
	$citaPac=$_SESSION["citaPac"];
	if($citaPac["accionCitaPac"]=="view"){
		header("Location: MuestraPacCitas.php");
		#$citaPac["ID_FECHA"]="";
		#$citaPac["fecha"]="";
		#$citaPac["tipo"]="";
		#$citaPac["idPac"]=$paciente["ID_PAC"];
		#$citaPac["accionCitaPac"]="insert";
		#$_SESSION["citaPac"]=$citaPac;
		#header("Location: FormPacCitas.php");
		
	}elseif($citaPac["accionCitaPac"]=="insert"){
		$citaPac["ID_FECHA"]=$_REQUEST["ID_FECHA"];		
		$citaPac["fecha"] = $_REQUEST["fecha"];
		$citaPac["tipo"] = $_REQUEST["tipo"];
		$citaPac["idPac"] = $_REQUEST["idPac"];
		$citaPac["accionCitaPac"]=$_REQUEST["accionCitaPac"];
		$_SESSION["citaPac"]=$citaPac;
		
		
		$erroresPacCitas = validar($citaPac);
		if(count ($erroresPacCitas) > 0){
				$_SESSION["erroresCreaPacCitas"]=$erroresPacCitas;
				Header("Location: FormPacCitas.php");
		}else{
				Header("Location: ExitoPacCitas.php");
		}	
		
	}elseif($citaPac["accionCitaPac"]=="update"){
		$citaPac["ID_FECHA"]=$_REQUEST["ID_FECHA"];		
		$citaPac["fecha"] = $_REQUEST["fecha"];
		$citaPac["tipo"] = $_REQUEST["tipo"];
		$citaPac["idPac"] = $_REQUEST["idPac"];
		$citaPac["accionCitaPac"]=$_REQUEST["accionCitaPac"];
		$_SESSION["citaPac"]=$citaPac;
		
		
		$erroresPacCitas = validar($citaPac);
		if(count ($erroresPacCitas) > 0){
				$citaPac["accionCitaPac"]="pre-update";
				$_SESSION["citaPac"]=$citaPac;
				$_SESSION["erroresCreaPacCitas"]=$erroresPacCitas;
				Header("Location: FormPacCitas.php");
		}else{
				Header("Location: ExitoPacCitas.php");
		}	
		
	}elseif($citaPac["accionCitaPac"]=="lee"){
		$citaPac["ID_FECHA"]=$_REQUEST["ID_FECHA"];		
		$citaPac["fecha"] = $_REQUEST["fecha"];
		$citaPac["tipo"] = $_REQUEST["tipo"];
		$citaPac["idPac"] = $_REQUEST["idPac"];
		$citaPac["accionCitaPac"]=$_REQUEST["accionCitaPac"];
		$_SESSION["citaPac"]=$citaPac;
		header("Location: ProcesaPacCita.php");	
	}
	elseif($citaPac["accionCitaPac"]=="pre-update"){
		header("Location: FormPacCitas.php");		
	}elseif($citaPac["accionCitaPac"]=="pre-insert"){
		unset($_SESSION["citaPac"]);
		header("Location: FormPacCitas.php");
	}elseif($citaPac["accionCitaPac"]=="remove"){
		header("Location: ExitoPacCitas.php");
	}

	else{
	$citaPac["ID_FECHA"]=$_REQUEST["ID_FECHA"];		
	$citaPac["fecha"] = $_REQUEST["fecha"];
	$citaPac["tipo"] = $_REQUEST["tipo"];
	$citaPac["idPac"] = $_REQUEST["idPac"];
	$citaPac["accionCitaPac"]=$_REQUEST["accionCitaPac"];
	$_SESSION["citaPac"]=$citaPac;


	if($_REQUEST["accionCitaPac"]=="view"){
		header("Location: MuestraPacCitas.php");
	}elseif($_REQUEST["accionCitaPac"]=="insert"){
		header("Location: ExitoPacCitas.php");
	}elseif($_REQUEST["accionCitaPac"]=="pre-insert"){
		header("Location: FormPacCitas.php");
	}	
}}

function validar($citaPac) {
		if (empty($citaPac["fecha"])) {
			$errores[] = "La fecha no puede estar vacia";}
		if (empty($citaPac["idPac"])) {
			$errores[] = "El identificador del Paciente no puede estar vacio";}
		return $errores;
	}


?>