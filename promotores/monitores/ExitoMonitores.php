<?php 
session_start();
include_once ("../../GestionarDB.php");
include_once ('GestionMonitores.php');
if (isset($_SESSION["monitor"])) {
	$monitor = $_SESSION["monitor"];
	unset($_SESSION["monitor"]);
	unset($_SESSION["erroresmonitor"]);
} else {
	$_SESSION["erroresCreaMonitor"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormMonitor.php");
}
if(isset($_SESSION["promotor"])){
	$promotor = $_SESSION["promotor"];
}else{
	$promotor["nombre"] = "";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Estado Registro del Monitor</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">
	</head>
	<?php
		include_once ("../../CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
		<h3>Estado Registro del Monitor</h3>
<?php
$conexion=conectarBD();
if($monitor["accionMonitor"]=="insert"){
	
	if (insertarMonitor($conexion, $monitor["nombre"], $monitor["apellidos"], $monitor["telefono"], $monitor["email"], $monitor["idEc"], $monitor["idPro"])){
			$_SESSION["exitoModMonitor"]="El monitor ". $monitor["nombre"]. " ".$monitor["apellidos"]." ha sido insertado correctamente.";
			header("Location: MuestraMonitor.php"); 
	}else{ 
		echo $_SESSION["errorDB"];
		?>
		<div id="div_errorRegistro">
			Lo sentimos, el monitor <?php echo $monitor["nombre"]. " ".$monitor["apellidos"];?> para el promotor<?php echo $promotor["nombre"]; ?>
			<b>NO</b> ha sido insertado.
		</div>
		</br> Para volver al formulario pincha <a href="FormMonitor.php">AQUÍ</a>
		</br> Para volver a la tabla pincha <a href="MuestraMonitor.php">AQUÍ</a><?php
		$_SESSION["monitor"] = $monitor;
	}
		?>
<?php
}elseif($monitor["accionMonitor"]=="update"){
		if(modificarMonitor($conexion,$monitor["ID_MON"], $monitor["nombre"], $monitor["apellidos"], $monitor["telefono"], $monitor["email"], $monitor["idEc"], $monitor["idPro"])){
			$_SESSION["exitoModMonitor"]="El monitor ". $monitor["nombre"]. " ".$monitor["apellidos"]." ha sido actualizado correctamente.";
			header("Location: MuestraMonitor.php");
		 }else{
		echo $_SESSION["errorDB"];
		
		 	$monitor["accionMonitor"]="pre-update";
		 	$_SESSION["monitor"] = $monitor;
			?> <div id="div_errorRegistro">
				Lo sentimos, el monitor <?php echo $monitor["nombre"]. " ".$monitor["apellidos"];?> para el promotor<?php echo $promotor["nombre"]; ?> 
				<b>NO</b> ha sido actualizado.
			</div><?php 		 	
			#$errores[]="El monitor ". $monitor["nombre"]. " ".$monitor["apellidos"]." para el promotor".$promotor["nombre"]." <b>NO</b> ha sido actualizado correctamente.";
			#$_SESSION["errorModMonitor"]=$errores;
			
			?></br> Para volver al formulario pincha <a href="FormMonitor.php">AQUÍ</a>
			</br> Para volver a la tabla pincha <a href="MuestraMonitor.php">AQUÍ</a><?php			
			#header("Location: MuestraMonitor.php");
		}
}
 elseif($monitor["accionMonitor"]=="remove"){?>
		<?php
		$_SESSION["monitor"] = $monitor;
		?> <div id="div_errorRegistro">
				Lo sentimos, el monitor <?php echo $monitor["nombre"]. " ".$monitor["apellidos"];?> 
				<b>NO</b> ha sido eliminado por políticas del sistema.
		</div><?php  	
			#$errores[]="El monitor ". $monitor["nombre"]. " ".$monitor["apellidos"]." <b>NO</b> ha sido eliminado por políticas del sistema.";
			#$_SESSION["errorModMonitor"]=$errores;
		
		?></br> Para volver a la tabla pincha <a href="MuestraMonitor.php">AQUÍ</a><?php
		
			#header("Location: MuestraMonitor.php");		
 		
	
 }
		 
	desconectarDB($conexion);
		?>
</div>
		<?php 	include_once("../../Pie.php");
		?>
	</body>
</html>