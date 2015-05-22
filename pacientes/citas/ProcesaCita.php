<?php
session_start();

if (!isset($_SESSION["accionCitaPac"])){
	$erroresCita[]="Acción indfeinida";
	$_SESSION["erroresCita"]=$erroresCita;
	Header("Location: FormCitas.php");
	
}else{
	$citaPac["ID_PAC"]=$_REQUEST["ID_PAC"];		
	$citaPac["nombre"] = $_REQUEST["nombre"];
	$citaPac["apellidos"] = $_REQUEST["apellidos"];
	$citaPac["nuhsa"] = $_REQUEST["nuhsa"];
	$citaPac["nhc"]=$_REQUEST["nhc"];
	$citaPac["diagnostico"]=$_REQUEST["diagnostico"];
	$citaPac["medicacion"]=$_REQUEST["medicacion"];
	$citaPac["fechaInclusion"]=$_REQUEST["fechaInclusion"];
	$citaPac["idEnsayoClinico"]=$_REQUEST["idEnsayoClinico"];
	$citaPac["accionCitaPac"]=$_REQUEST["accionCitaPac"];
	$_SESSION["citaPac"]=$citaPac;
	$citaPac=$_SESSION["citaPac"];


	if($_SESSION["accionCitaPac"]=="view"){
		header("Location: MuestraCitas.php");
	}if($_SESSION["accionCitaPac"]=="insert"){
		header("Location: ExitoPacCitas.php");
	}	
}
?>