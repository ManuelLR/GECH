<?php 
session_start();
include_once ("../../GestionarDB.php");
include_once ('GestionPacCitas.php');
if (isset($_SESSION["citaPac"])) {
	$citaPac = $_SESSION["citaPac"];
	$paciente = $_SESSION["paciente"];
	unset($_SESSION["citaPac"]);
	unset($_SESSION["erroresCitaPac"]);
} else {
	$_SESSION["erroresCreaPacCitas"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormPacCitas.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro de la Cita</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">
	</head>
	<?php
		include_once ("../../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro del Paciente</h3>
<?php
$conexion=conectarBD();
if($citaPac["accionCitaPac"]=="insert"){
	
	if (insertarPacCitas($conexion, $citaPac["fecha"], $citaPac["tipo"], $citaPac["idPac"])){
	?>
		<div id="div_exito">
			La cita para el paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]; ?>
			ha sido creada para el día <?php echo $citaPac["fecha"]?>.
		</div>
	<?php 
	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, la cita para el paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]; ?>
			el día <?php echo $citaPac["fecha"]?> <b>NO</b> ha sido insertado.
		</div>
		<?php
		#$_SESSION["paciente"] = $paciente;
	}
		?>
<?php
}elseif($citaPac["accionCitaPac"]=="update"){
		if(modificarPacCitas($conexion,$citaPac["ID_FECHA"],$citaPac["fecha"], $citaPac["tipo"], $citaPac["idPac"])){
			$_SESSION["exitoModPacCita"]="La cita del paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." ha sido actualizado correctamente.";
			header("Location: MuestraPacCitas.php");
		 }else{ 
			$errores[]="La cita del paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." <b>NO</b> ha sido actualizado correctamente.";
			$_SESSION["errorModPacCita"]=$errores;
			header("Location: MuestraPacCitas.php");
		}
}
 elseif($citaPac["accionCitaPac"]=="remove"){
 		if(eliminaPacCitas($conexion, $citaPac["ID_FECHA"])){
 			$_SESSION["exitoModPacCita"]="La cita del paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." ha sido eliminada.";
			header("Location: MuestraPacCitas.php");	
 		}else{
 	 		$errores[]="La cita del paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." no se ha podido borrar.";
			$_SESSION["errorModPacCita"]=$errores;
			header("Location: MuestraPacCitas.php");		
 		}
	
 }
		 
	desconectarDB($conexion);
		?>
		<?php 	include_once("../../Pie.php");
		?>
	</body>
</html>