<?php
	session_start();
	
if(!isset($_REQUEST["accionPro"])) {
			$erroresCreaPromotores[]="Acción indefinida";
			$_SESSION["erroresCreaPromotores"]=$erroresCreaPromotores;
			Header("Location: FormPromotores.php");
}else{
			$promotor["ID_PRO"]=$_REQUEST["ID_PRO"];		
			$promotor["nombre"] = $_REQUEST["nombre"];
			$promotor["cif"] = $_REQUEST["cif"];
			$promotor["accionPro"]=$_REQUEST["accionPro"];
			$_SESSION["promotor"]=$promotor;	
		

		if($_REQUEST["accionPro"]=="insert"){	
			$erroresPromotores = validar($promotor);
			if(count ($erroresPromotores) > 0){
				$_SESSION["erroresCreaPromotores"]=$erroresPromotores;
				Header("Location: FormPromotores.php");
			}else{
				Header("Location: ExitoPromotores.php");}
		}
		elseif($_REQUEST["accionPro"]=="update"){
			$erroresPromotores = validar($promotor);
			if(count ($erroresPromotores) > 0){
				$_SESSION["erroresCreaPromotores"]=$erroresPromotores;
				$promotor["accionPro"]="pre-update";
				$_SESSION["paciente"]=$promotor;
				Header("Location: FormPromotores.php");
			}else{
				header("Location: ExitoPromotores.php");}
		}
		elseif($_REQUEST["accionPro"]=="pre-update"){
			header("Location: FormPromotores.php");
		}
		elseif($_REQUEST["accionPro"]=="more"){
			header("Location: MuestraUnPromotor.php");
		}
		elseif($_REQUEST["accionPro"]=="remove"){
			header("Location: ExitoPromotores.php");			
		}
}


	function validar($promotor) {
		if (empty($promotor["nombre"])) {
			$errores[] = "El nombre de la empresa no puede estar vacio";}
		if (empty($promotor["cif"])) {
			$errores[] = "El CIF no pueden estar vacios";}			
		return $errores;
	}


?>