<?php
session_start();

if (!isset($_SESSION["citaPac"])){
	$citaPac["ID_PAC"]=$_REQUEST["ID_PAC"];		
	$citaPac["nombre"] = $_REQUEST["nombre"];
	$citaPac["apellidos"] = $_REQUEST["apellidos"];
	$citaPac["nuhsa"] = $_REQUEST["nuhsa"];
	$citaPac["nhc"]=$_REQUEST["nhc"];
	$citaPac["diagnostico"]=$_REQUEST["diagnostico"];
	$citaPac["medicacion"]=$_REQUEST["medicacion"];
	$citaPac["fechaInclusion"]=$_REQUEST["fechaInclusion"];
	$citaPac["idEnsayoClinico"]=$_REQUEST["idEnsayoClinico"];
	$citaPac["accion"]=$_REQUEST["accion"];
	$_SESSION["citaPac"]=$citaPac;
}else{
	$citaPac=$_SESSION["citaPac"];
}

if($citaPac["accion"]=="view"){
	header("Location: MuestraCitas.php");
}

?>