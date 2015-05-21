<?php
	session_start();
	if (isset($_SESSION["crearEnsayo"]) ){
		$crearEnsayo["situacion_actual"] = $_REQUEST["situacion_actual"];
		$crearEnsayo["criterio_inc"] = $_REQUEST["criterio_inc"];
		$crearEnsayo["criterio_exc"] = $_REQUEST["criterio_exc"];
		$crearEnsayo["inicio_rec"] = $_REQUEST["inicio_rec"];
		$crearEnsayo["fin_rec"]=$_REQUEST["fin_rec"];
		$crearEnsayo["farmaco"]=$_REQUEST["farmaco"];
		$_SESSION["crearEnsayo"]=$crearEnsayo;

		
		$erroresCreaEnsayos = validar($crearEnsayo);
		
		if ( count ($erroresCreaEnsayos) > 0 ) {
			$_SESSION["erroresCreaEnsayos"] = $erroresCreaEnsayos;
			Header("Location: FormCreaEnsayos.php");
		}
		else Header("Location: ExitoCreaEnsayos.php");
	}
	else Header("Location: FormCreaEnsayos.php");

	function validar($crearEnsayo) {
		if (empty($crearEnsayo["criterio_inc"])) {
			$errores[] = "El criterio de inclusión no puede estar vacio";}
		if (empty($crearEnsayo["criterio_exc"])) {
			$errores[] = "El criterio de exclusión no puede estar vacio";}
		if (empty($crearEnsayo["inicio_rec"])) {
			$errores[] = "La fecha de inicio de reclutamiento no pueden estar vacia";}
		if (empty($crearEnsayo["fin_rec"])) {
			$errores[] = "La fecha de fin del reclutamiento no puede estar vacia";}
		if (empty($crearEnsayo["farmaco"])) {
			$errores[] = "El farmaco no pueden estar vacio";}
				
		
		return $errores;
	}


?>