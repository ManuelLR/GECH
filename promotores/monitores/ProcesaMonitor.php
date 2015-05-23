<?php
session_start();

if (#!isset($_REQUEST["accionMonitor"])){#&&
	!isset($_SESSION["monitor"])){
	$erroresCita[]="Acción indefinida";
	$_SESSION["erroresCreaMonitor"]=$erroresCita;
	Header("Location: FormMonitor.php");
	
}else{
	$monitor=$_SESSION["monitor"];
	if($monitor["accionMonitor"]=="view"){
		header("Location: MuestraMonitor.php");
		#$monitor["ID_FECHA"]="";
		#$monitor["fecha"]="";
		#$monitor["tipo"]="";
		#$monitor["idPac"]=$paciente["ID_PAC"];
		#$monitor["accionMonitor"]="insert";
		#$_SESSION["monitor"]=$monitor;
		#header("Location: FormMonitor.php");
		
	}elseif($monitor["accionMonitor"]=="insert" or $monitor["accionMonitor"]=="update"){
		$monitor["ID_MON"]=$_REQUEST["ID_MON"];
		$monitor["nombre"]=$_REQUEST["nombre"];
		$monitor["apellidos"]=$_REQUEST["apellidos"];
		$monitor["telefono"]=$_REQUEST["telefono"];
		$monitor["email"]=$_REQUEST["email"];
		$monitor["idEc"]=$_REQUEST["idEc"];
		$monitor["idPro"]=$_REQUEST["idPro"];
		$monitor["accionMonitor"]=$_REQUEST["accionMonitor"];
		
		$_SESSION["monitor"]=$monitor;
		header("Location: ExitoMonitores.php");
	}elseif($monitor["accionMonitor"]=="lee"){
		$monitor["ID_MON"]=$_REQUEST["ID_MON"];
		$monitor["nombre"]=$_REQUEST["nombre"];
		$monitor["apellidos"]=$_REQUEST["apellidos"];
		$monitor["telefono"]=$_REQUEST["telefono"];
		$monitor["email"]=$_REQUEST["email"];
		$monitor["idEc"]=$_REQUEST["idEc"];
		$monitor["idPro"]=$_REQUEST["idPro"];
		$monitor["accionMonitor"]=$_REQUEST["accionMonitor"];
		$_SESSION["monitor"]=$monitor;
		header("Location: ProcesaMonitor.php");	
	}
	elseif($monitor["accionMonitor"]=="pre-update"){
		header("Location: FormMonitor.php");		
	}elseif($monitor["accionMonitor"]=="pre-insert"){
		unset($_SESSION["monitor"]);
		header("Location: FormMonitor.php");
	}elseif($monitor["accionMonitor"]=="remove"){
		header("Location: ExitoMonitores.php");
	}elseif($monitor["accionMonitor"]=="calendar"){
		$fecMon["accionFecMon"]="view";
		$_SESSION["fecMon"]=$fecMon;
		header("Location: ../fechasMonitores/ProcesaFecMon.php");
	}

	else{
		$monitor["ID_MON"]=$_REQUEST["ID_MON"];
		$monitor["nombre"]=$_REQUEST["nombre"];
		$monitor["apellidos"]=$_REQUEST["apellidos"];
		$monitor["telefono"]=$_REQUEST["telefono"];
		$monitor["email"]=$_REQUEST["email"];
		$monitor["idEc"]=$_REQUEST["idEc"];
		$monitor["idPro"]=$_REQUEST["idPro"];
		$monitor["accionMonitor"]=$_REQUEST["accionMonitor"];
	$_SESSION["monitor"]=$monitor;


	if($_REQUEST["accionMonitor"]=="view"){
		header("Location: MuestraMonitor.php");
	}elseif($_REQUEST["accionMonitor"]=="insert"){
		header("Location: ExitoMonitores.php");
	}elseif($_REQUEST["accionMonitor"]=="pre-insert"){
		header("Location: FormMonitor.php");
	}	
}}
?>