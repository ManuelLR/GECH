<?php
	session_start();
	
if(!isset($_REQUEST["accionEc"])) {
			$erroresCreaEnsayos[]="Acción indefinida";
			$_SESSION["erroresCreaEnsayos"]=$erroresCreaEnsayos;
			Header("Location: FormEnsayos.php");
}else{
			$ensayo["ID_EC"]=$_REQUEST["ID_EC"];
			$ensayo["situacion_actual"]=$_REQUEST["situacion_actual"];		
			$ensayo["criterio_inc"] = $_REQUEST["criterio_inc"];
			$ensayo["criterio_exc"] = $_REQUEST["criterio_exc"];
			$ensayo["inicio_rec"]=$_REQUEST["inicio_rec"];
			$ensayo["fin_rec"]=$_REQUEST["fin_rec"];
			$ensayo["farmaco"] = $_REQUEST["farmaco"];
			$ensayo["accionEc"]=$_REQUEST["accionEc"];
			$_SESSION["ensayo"]=$ensayo;	
		

		if($_REQUEST["accionEc"]=="insert"){	
			$erroresEnsayos = validar($ensayo);
			if(count ($erroresEnsayos) > 0){
				$_SESSION["erroresCreaEnsayos"]=$erroresEnsayos;
				Header("Location: FormEnsayos.php");
			}else{
				Header("Location: ExitoEnsayos.php");}
		}
		elseif($_REQUEST["accionEc"]=="update"){
			$erroresEnsayos = validar($ensayo);
			if(count ($erroresEnsayos) > 0){
				$_SESSION["erroresCreaEnsayos"]=$erroresEnsayos;
				$ensayo["accionEc"]="pre-update";
				$_SESSION["ensayo"]=$ensayo;
				Header("Location: FormEnsayos.php");
			}else{
				header("Location: ExitoEnsayos.php");}
		}
		elseif($_REQUEST["accionEc"]=="pre-update"){
			header("Location: FormEnsayos.php");
		}
		elseif($_REQUEST["accionEc"]=="more"){
			header("Location: MuestraUnEnsayo.php");
		}
		elseif($_REQUEST["accionEc"]=="calendar"){
			$citaEc["accionCitaEc"]="view";
			$_SESSION["citaEc"]=$citaEc;
			header("Location: citas/ProcesaEcCita.php");
			
		}elseif($_REQUEST["accionEc"]=="remove"){
			header("Location: ExitoEnsayos.php");			
		}
}


	function validar($ensayo) {
		if (empty($ensayo["criterio_inc"])) {
			$errores[] = "El criterio de inclusión no puede estar vacio";}
		if (empty($ensayo["criterio_exc"])) {
			$errores[] = "El criterio de exclusión no puede estar vacio";}
		if (empty($ensayo["inicio_rec"])) {
			$errores[] = "La fecha de inicio de reclutamiento no puede estar vacia";}
		if (empty($ensayo["fin_rec"])) {
			$errores[] = "La fecha de fin de reclutamiento no puede estar vacia";}
		if (empty($ensayo["farmaco"])) {
			$errores[] = "El fármaco no pueden estar vacio";}
					
		return $errores;
	}


?>