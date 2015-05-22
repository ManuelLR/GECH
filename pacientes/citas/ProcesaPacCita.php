<?php
session_start();

if (!isset($_SESSION["accionCitaPac"])){
	$erroresCita[]="Acción indfeinida";
	$_SESSION["erroresCita"]=$erroresCita;
	Header("Location: FormPacCitas.php");
	
}else{
	$citaPac["ID_FECHA"]=$_REQUEST["ID_FECHA"];		
	$citaPac["fecha"] = $_REQUEST["fecha"];
	$citaPac["tipo"] = $_REQUEST["tipo"];
	$citaPac["idPac"] = $_REQUEST["idPac"];
	$citaPac["accionCitaPac"]=$_REQUEST["accionCitaPac"];
	$_SESSION["citaPac"]=$citaPac;


	if($_SESSION["accionCitaPac"]=="view"){
		header("Location: MuestraPacCitas.php");
	}elseif($_SESSION["accionCitaPac"]=="insert"){
		header("Location: ExitoPacCitas.php");
	}elseif($_SESSION["accionCitaPac"]=="pre-insert"){
		header("Location: FormPacCitas.php");
	}	
}
?>