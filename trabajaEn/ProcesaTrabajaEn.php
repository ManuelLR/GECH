<?php
	session_start();
	
if(!isset($_REQUEST["accionTraEn"])) {
			$erroresCreaTrabajaEn[]="Acción indefinida";
			$_SESSION["erroresCreaTrabajaEn"]=$erroresCreaTrabajaEn;
			Header("Location: FormTrabajaEn.php");
}else{
			$trabajaEn["ID_EC"]=$_REQUEST["ID_EC"];		
			$trabajaEn["ID_EMP"] = $_REQUEST["ID_EMP"];
			$trabajaEn["cargo"] = $_REQUEST["cargo"];
			$trabajaEn["accionTraEn"]=$_REQUEST["accionTraEn"];
			$_SESSION["trabajaEn"]=$trabajaEn;	
		

		if($_REQUEST["accionTraEn"]=="insert"){	
			$erroresTrabajaEn = validar($trabajaEn);
			if(count ($erroresTrabajaEn) > 0){
				$_SESSION["erroresCreaTrabajaEn"]=$erroresTrabajaEn;
				Header("Location: FormTrabajaEn.php");
			}else{
				Header("Location: ExitoTrabajaEn.php");}
		}
		elseif($_REQUEST["accionTraEn"]=="update"){
			$erroresTrabajaEn = validar($trabajaEn);
			if(count ($erroresTrabajaEn) > 0){
				$_SESSION["erroresCreaTrabajaEn"]=$erroresTrabajaEn;
				$trabajaEn["accionTraEn"]="pre-update";
				$_SESSION["trabajaEn"]=$trabajaEn;
				Header("Location: FormTrabajaEn.php");
			}else{
				header("Location: ExitoTrabajaEn.php");}
		}
		elseif($_REQUEST["accionTraEn"]=="pre-update"){
			header("Location: FormTrabajaEn.php");
		}
		elseif($_REQUEST["accionTraEn"]=="more"){
			header("Location: MuestraUnTrabajaEn.php");
		}
		elseif($_REQUEST["accionTraEn"]=="remove"){
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