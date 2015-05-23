<?php 
session_start();
include_once ("../../GestionarDB.php");
include_once ('GestionFecMon.php');
if (isset($_SESSION["fecMon"])) {
	$fecMon = $_SESSION["fecMon"];
	$monitor = $_SESSION["monitor"];
	unset($_SESSION["fecMon"]);
	unset($_SESSION["erroresFecMon"]);
} else {
	$_SESSION["erroresCreaFecMon"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormFecMon.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro de la Fecha Monitor</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">
	</head>
	<?php
		include_once ("../../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro de la Fecha del Monitor</h3>
<?php
$conexion=conectarBD();
if($fecMon["accionFecMon"]=="insert"){
	
	if (insertarFecMon($conexion, $fecMon["fecha"], $fecMon["idMon"])){
	?>
		<div id="div_exito">
			La cita para el monitor <?php echo $monitor["nombre"]; ?>
			ha sido creada para el día <?php echo $fecMon["fecha"]?>.
		</div>
	<?php 
			$_SESSION["exitoModFecMon"]="La cita del monitor ". $monitor["nombre"] . " " . $monitor["apellidos"]." ha sido insertada.";
			header("Location: MuestraFecMon.php");	
	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, la cita para el monitor <?php echo $monitor["nombre"]; ?>
			el día <?php echo $fecMon["fecha"]?> <b>NO</b> ha sido insertado.
		</div>
		<?php
		#$_SESSION["monitor"] = $monitor;
		 	$errores[]="La cita del monitor ". $monitor["nombre"] . " " . $monitor["apellidos"]." <b>no</b> se ha podido insertar.";
			$_SESSION["errorModFecMon"]=$errores;
			header("Location: MuestraFecMon.php");	
	}
		?>
<?php
}elseif($fecMon["accionFecMon"]=="update"){
			$errores[]="La cita del monitor ". $monitor["nombre"] . " " . $monitor["apellidos"]." <b>NO</b> ha sido actualizado correctamente ya que la función no está implementada. </br> La modificación debe consistir en, primeramente, insertar la nueva cita y después eliminar la antigua";
			$_SESSION["errorModFecMon"]=$errores;
			header("Location: MuestraFecMon.php");

}
 elseif($fecMon["accionFecMon"]=="remove"){
 		if(eliminaFecMon($conexion, $fecMon["ID_FECHA"])){
 			$_SESSION["exitoModFecMon"]="La cita del monitor ". $monitor["nombre"] ." ha sido eliminada.";
			header("Location: MuestraFecMon.php");	
 		}else{
 	 		$errores[]="La cita del monitor ". $monitor["nombre"] ." no se ha podido borrar.";
			$_SESSION["errorModFecMon"]=$errores;
			header("Location: MuestraFecMon.php");		
 		}
	
 }
		 
	desconectarDB($conexion);
		?>
		<?php 	include_once("../../Pie.php");
		?>
	</body>
</html>