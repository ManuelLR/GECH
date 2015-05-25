<?php
session_start();

if (#!isset($_REQUEST["accionFecMon"])){#&&
	!isset($_SESSION["fecMon"])){
	$erroresCita[]="Acción indefinida";
	$_SESSION["erroresCreaFecMon"]=$erroresCita;
	Header("Location: FormFecMon.php");
	
}else{
	$fecMon=$_SESSION["fecMon"];
	if($fecMon["accionFecMon"]=="view"){
		header("Location: MuestraFecMon.php");
		#$fecMon["ID_FECHA"]="";
		#$fecMon["fecha"]="";
		#$fecMon["tipo"]="";
		#$fecMon["idPac"]=$paciente["ID_PAC"];
		#$fecMon["accionFecMon"]="insert";
		#$_SESSION["fecMon"]=$fecMon;
		#header("Location: FormFecMon.php");
		
	}elseif($fecMon["accionFecMon"]=="insert"){
		$fecMon["fecha"] = $_REQUEST["fecha"];
		$fecMon["idMon"] = $_REQUEST["idMon"];
		$fecMon["accionFecMon"]=$_REQUEST["accionFecMon"];
		$_SESSION["fecMon"]=$fecMon;
		header("Location: ExitoFecMon.php");
	}elseif($fecMon["accionFecMon"]=="update"){
		$fecMon["fecha"] = $_REQUEST["fecha"];
		$fecMon["idMon"] = $_REQUEST["idMon"];
		$fecMon["accionFecMon"]=$_REQUEST["accionFecMon"];
		$_SESSION["fecMonNew"]=$fecMon;
		header("Location: ExitoFecMon.php");
	
	}elseif($fecMon["accionFecMon"]=="lee"){
		$fecMon["fecha"] = $_REQUEST["fecha"];
		$fecMon["idMon"] = $_REQUEST["idMon"];
		$fecMon["accionFecMon"]=$_REQUEST["accionFecMon"];
		$_SESSION["fecMon"]=$fecMon;
		header("Location: ProcesaFecMon.php");	
	}
	elseif($fecMon["accionFecMon"]=="pre-update"){
		header("Location: FormFecMon.php");		
	}elseif($fecMon["accionFecMon"]=="pre-insert"){
		unset($_SESSION["fecMon"]);
		header("Location: FormFecMon.php");
	}elseif($fecMon["accionFecMon"]=="remove"){
		header("Location: ExitoFecMon.php");
	}

	else{
	$fecMon["fecha"] = $_REQUEST["fecha"];
	$fecMon["idMon"] = $_REQUEST["idMon"];
	$fecMon["accionFecMon"]=$_REQUEST["accionFecMon"];
	$_SESSION["fecMon"]=$fecMon;


	if($_REQUEST["accionFecMon"]=="view"){
		header("Location: MuestraFecMon.php");
	}elseif($_REQUEST["accionFecMon"]=="insert"){
		header("Location: ExitoFecMon.php");
	}elseif($_REQUEST["accionFecMon"]=="pre-insert"){
		header("Location: FormFecMon.php");
	}	
}}
?>