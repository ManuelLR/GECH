<?php 
session_start();
include_once ("../../GestionarDB.php");
include_once ('GestionTrabajaEn.php');
if (isset($_SESSION["trabajaEn"])) {
	$trabajaEn = $_SESSION["trabajaEn"];
#	$empleado = $_SESSION["empleado"];
	unset($_SESSION["trabajaEn"]);
	unset($_SESSION["erroresTrabajaEn"]);
} else {
	$_SESSION["erroresCreaTrabajaEn"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormTrabajaEn.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Trabaja En</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">
	</head>
	<?php
		include_once ("../../CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
		<h3>Estado Registro del Trabaja En</h3>
<?php
$conexion=conectarBD();
if($trabajaEn["accionTraEn"]=="insert"){
	
	if (insertarTrabajaEn($trabajaEn["ID_EC"], $trabajaEn["ID_EMP"], $trabajaEn["cargo"], $conexion)){
		$_SESSION["exitoModTrabajaEn"]="El Trabaja En ha sido actualizado correctamente.";
		header("Location: MuestraTrabajaEn.php");

	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el Trabaja En <b>NO</b> ha sido insertado.
		</div>
		</br> Para volver al formulario pincha <a href="FormTrabajaEn.php">AQUÍ</a>
		</br> Para volver a la tabla pincha <a href="MuestraTrabajaEn.php">AQUÍ</a><?php
		$_SESSION["trabajaEn"] = $trabajaEn;
	}

}elseif($trabajaEn["accionTraEn"]=="update"){
	 	$trabajaEnNew=$_SESSION["trabajaEnNew"];
		if(modificarTrabajaEn($conexion,$trabajaEn, $trabajaEnNew["ID_EC"], $trabajaEnNew["ID_EMP"], $trabajaEnNew["cargo"])){

			$_SESSION["exitoModTrabajaEn"]="El Trabaja En ha sido actualizado correctamente.";
			header("Location: MuestraTrabajaEn.php");
		 }else{
		 	$trabajaEn["accionTraEn"]="pre-update";
		 	$_SESSION["trabajaEn"] = $trabajaEn;
			?> <div id="div_errorRegistro">
				Lo sentimos, el ensayo 
				<b>NO</b> ha sido actualizado.
			</div><?php 		 	 
			$errores[]="El Trabaja En <b>NO</b> ha sido actualizado correctamente.";
			$_SESSION["errorModTrabajaEn"]=$errores;
			?></br> Para volver al formulario pincha <a href="FormTrabajaEn.php">AQUÍ</a>
			</br> Para volver a la tabla pincha <a href="MuestraTrabajaEn.php">AQUÍ</a><?php
			#header("Location: MuestraTrabajaEn.php");
		}
}
 elseif($trabajaEn["accionTraEn"]=="remove"){

 		if(eliminaTrabajaEn($conexion,$trabajaEn["ID_EC"], $trabajaEn["ID_EMP"])){
			$_SESSION["exitoModTrabajaEn"]="El Trabaja En ha sido eliminado correctamente.";
			header("Location: MuestraTrabajaEn.php"); 			
 		}else{
 		 	$_SESSION["trabajaEn"] = $trabajaEn;
			?> <div id="div_errorRegistro">
				Lo sentimos, el Trabaja En 
			<b>NO</b> ha sido eliminado correctamente.
			</div><?php 
 			$errores[]="El Trabaja En <b>NO</b> ha sido eliminado correctamente.";
			$_SESSION["errorModTrabajaEn"]=$errores;
			
			?></br> Para volver a la tabla pincha <a href="MuestraTrabajaEn.php">AQUÍ</a><?php
			
			#header("Location: MuestraTrabajaEn.php");
		}	
 }
		 
	desconectarDB($conexion);
		?>
</div>
		<?php 	include_once("../../Pie.php");
		?>
	</body>
</html>

