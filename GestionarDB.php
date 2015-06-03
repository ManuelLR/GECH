<?php

	function conectarBD(){
		$host='oci:dbname=localhost/XE;charset=UTF8';
		$username='con123456';
		$password='1234';
		try{
			$con = new PDO($host, $username, $password);
			$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			//echo 'Conectados a la base de datos';
			return $con;
		}catch (PDOException $e){
			$error[]="<b>Error durante la conexión a la base de datos: </b>". $e->GetMessage();
			$_SESSION["errorConDB"]=$error;
			header("Location: /ErrorConexionBD.php");
		}
	}
	function desconectarDB($conexion){
		$conexion=null;
		return $conexion;
	}
?>
