<?php
	session_start();
	
if(!isset($_REQUEST["accionEmp"])) {
			$erroresCreaEmpleados[]="Acción indefinida";
			$_SESSION["erroresCreaEmpleados"]=$erroresCreaEmpleados;
			Header("Location: FormEmpleados.php");
}else{
			$empleado["ID_EMP"]=$_REQUEST["ID_EMP"];		
			$empleado["nombre"] = $_REQUEST["nombre"];
			$empleado["apellidos"] = $_REQUEST["apellidos"];
			$empleado["dni"] = $_REQUEST["dni"];
			$empleado["telefono"]=$_REQUEST["telefono"];
			$empleado["email"]=$_REQUEST["email"];
			$empleado["accionEmp"]=$_REQUEST["accionEmp"];
			$_SESSION["empleado"]=$empleado;	
		

		if($_REQUEST["accionEmp"]=="insert"){	
			$erroresEmpleados = validar($empleado);
			if(count ($erroresEmpleados) > 0){
				$_SESSION["erroresCreaEmpleados"]=$erroresEmpleados;
				Header("Location: FormEmpleados.php");
			}else{
				Header("Location: ExitoEmpleados.php");}
		}
		elseif($_REQUEST["accionEmp"]=="update"){
			$erroresEmpleados = validar($empleado);
			if(count ($erroresEmpleados) > 0){
				$_SESSION["erroresCreaEmpleados"]=$erroresEmpleados;
				$empleado["accionEmp"]="pre-update";
				$_SESSION["empleado"]=$empleado;
				Header("Location: FormEmpleados.php");
			}else{
				header("Location: ExitoEmpleados.php");}
		}
		elseif($_REQUEST["accionEmp"]=="pre-update"){
			header("Location: FormEmpleados.php");
		}
		elseif($_REQUEST["accionEmp"]=="more"){
			header("Location: MuestraUnempleado.php");
		}
		elseif($_REQUEST["accionEmp"]=="trabajaEn"){
			$trabajaEn["accionTraEn"]="view";
			$_SESSION["trabajaEn"]=$trabajaEn;
			header("Location: trabajaEn/ProcesaTrabajaEn.php");
		}		
		elseif($_REQUEST["accionEmp"]=="remove"){
			header("Location: ExitoEmpleados.php");			
		}
}


	function validar($empleado) {
		if (empty($empleado["nombre"])) {
			$errores[] = "El nombre no puede estar vacio";}
		if (empty($empleado["apellidos"])) {
			$errores[] = "Los apellidos no pueden estar vacios";}
		if (empty($empleado["dni"])) {
			$errores[] = "El DNI no pueden estar vacio";}
		if (empty($empleado["telefono"])) {
			$errores[] = "El teléfono no puede estar vacio";}
		if (empty($empleado["email"])) {
			$errores[] = "El email no pueden estar vacio";}
				
		return $errores;
	}


?>