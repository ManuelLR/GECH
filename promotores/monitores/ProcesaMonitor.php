<?php
session_start();

if (
	!isset($_SESSION["monitor"])){
	$erroresCita[]="Acción indefinida";
	$_SESSION["erroresCreaMonitor"]=$erroresCita;
	Header("Location: FormMonitor.php");
	
}else{
	$monitor=$_SESSION["monitor"];
	if($monitor["accionMonitor"]=="view"){
		header("Location: MuestraMonitor.php");

		
	}elseif($monitor["accionMonitor"]=="insert" or $monitor["accionMonitor"]=="update"){
		$monitor["ID_MON"]=$_REQUEST["ID_MON"];
		$monitor["nombre"]=$_REQUEST["nombre"];
		$monitor["apellidos"]=$_REQUEST["apellidos"];
		$monitor["telefono"]=$_REQUEST["telefono"];
		$monitor["email"]=$_REQUEST["email"];
		$monitor["idEc"]=$_REQUEST["idEc"];
		$monitor["idPro"]=$_REQUEST["idPro"];
		$monitor["accionMonitor"]=$_REQUEST["accionMonitor"];
		
		$erroresMonitor = validar($monitor);	
	
		$_SESSION["monitor"]=$monitor;
		if(count ($erroresMonitor) > 0){
				$_SESSION["erroresCreaMonitor"]=$erroresMonitor;
				Header("Location: FormMonitor.php");
		}else{
				Header("Location: ExitoMonitores.php");
		}		

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


function validar($monitor) {
		
		
		$expresion = '/^[9|6|7|8][0-9]{8}$/';
		
		$_SESSION["monitor"]=$monitor;
		
		if (empty($monitor["nombre"])) {
			$errores[] = "El nombre no puede estar vacio";}
		if (empty($monitor["apellidos"])) {
			$errores[] = "Los apellidos no pueden estar vacios";}
		if (empty($monitor["telefono"])) {
			$errores[] = "El teléfono no puede estar vacio";
			}else if(!preg_match($expresion, $monitor["telefono"])){
				$errores[] = "El teléfono es invalido";}
		if (empty($monitor["email"])) {
			$errores[] = "El email no pueden estar vacio";
			}else if (!filter_var($monitor["email"], FILTER_VALIDATE_EMAIL)) {
				$errores[] = "El email es invalido";
			}
		if (empty($monitor["idEc"])) {
			$errores[] = "El identificador del ensayo no puede estar vacio";}
		if (empty($monitor["idPro"])) {
			$errores[] = "El identificador del promotor no puede estar vacio";}
			
				
		return $errores;
	}






?>