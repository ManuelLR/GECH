<?php
	session_start();
	
if(!isset($_SESSION["trabajaEn"])) {
			$erroresCreaTrabajaEn[]="Acción indefinida";
			$_SESSION["erroresCreaTrabajaEn"]=$erroresCreaTrabajaEn;
			Header("Location: FormTrabajaEn.php");
}else{
	$trabajaEn=$_SESSION["trabajaEn"];
	
	if($trabajaEn["accionTraEn"]=="view"){
		header("Location: MuestraTrabajaEn.php");
	}
	elseif ($trabajaEn["accionTraEn"]=="insert") {
		$trabajaEn["ID_EC"]=$_REQUEST["ID_EC"];		
		$trabajaEn["ID_EMP"] = $_REQUEST["ID_EMP"];
		$trabajaEn["cargo"] = $_REQUEST["cargo"];
		$trabajaEn["accionTraEn"]=$_REQUEST["accionTraEn"];
		$_SESSION["trabajaEn"]=$trabajaEn;
		$erroresTrabajaEn = validar($trabajaEn);
		if(count ($erroresTrabajaEn) > 0){
			$_SESSION["erroresCreaTrabajaEn"]=$erroresTrabajaEn;
			Header("Location: FormTrabajaEn.php");
		}else{
			Header("Location: ExitoTrabajaEn.php");}
	}elseif($trabajaEn["accionTraEn"]=="update"){
		$trabajaEn["ID_EC"]=$_REQUEST["ID_EC"];		
		$trabajaEn["ID_EMP"] = $_REQUEST["ID_EMP"];
		$trabajaEn["cargo"] = $_REQUEST["cargo"];
		$trabajaEn["accionTraEn"]=$_REQUEST["accionTraEn"];
		$_SESSION["trabajaEn"]=$trabajaEn;
		$erroresTrabajaEn = validar($trabajaEn);
		if(count ($erroresTrabajaEn) > 0){
			$_SESSION["erroresCreaTrabajaEn"]=$erroresTrabajaEn;
			$trabajaEn["accionTraEn"]="pre-update";
			$_SESSION["trabajaEnNew"]=$trabajaEn;
			Header("Location: FormTrabajaEn.php");
		}else{
			header("Location: ExitoTrabajaEn.php");}
	}elseif($trabajaEn["accionTraEn"]=="lee"){
		$trabajaEn["ID_EC"]=$_REQUEST["ID_EC"];		
		$trabajaEn["ID_EMP"] = $_REQUEST["ID_EMP"];
		$trabajaEn["cargo"] = $_REQUEST["cargo"];
		$trabajaEn["accionTraEn"]=$_REQUEST["accionTraEn"];
		$_SESSION["trabajaEn"]=$trabajaEn;
		header("Location: ProcesaTrabajaEn.php");			
	}
	elseif($trabajaEn["accionTraEn"]=="pre-update"){
			header("Location: FormTrabajaEn.php");
	}
	elseif($trabajaEn["accionTraEn"]=="pre-insert"){
		unset($_SESSION["trabajaEn"]);
		header("Location: FormTrabajaEn.php");
	}
	elseif($trabajaEn["accionTraEn"]=="remove"){
		header("Location: ExitoTrabajaEn.php");			
	}
}


	function validar($trabajaEn) {
		if (empty($trabajaEn["ID_EC"])) {
			$errores[] = "El identificador del Ensayo Clínico no puede estar vacio";}
		if (empty($trabajaEn["ID_EMP"])) {
			$errores[] = "El identificador del empleado no puede estar vacio";}
		if (empty($trabajaEn["cargo"])) {
			$errores[] = "El cargo no pueden estar vacios";}			
		return $errores;
	}


?>