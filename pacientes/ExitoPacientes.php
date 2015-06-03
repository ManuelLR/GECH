<?php 
session_start();
include_once ("../GestionarDB.php");
include_once ('GestionPacientes.php');
if (isset($_SESSION["paciente"])) {
	$paciente = $_SESSION["paciente"];
	unset($_SESSION["paciente"]);
	unset($_SESSION["erroresCreaPacientes"]);
} else {
	$_SESSION["erroresCreaPacientes"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormPacientes.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Estado Registro del Paciente</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
		<h3>Estado Registro del Paciente</h3>
<?php
$conexion=conectarBD();
if($paciente["accionPac"]=="insert"){
	
	if (insertarPaciente($paciente["nombre"], $paciente["apellidos"], $paciente["nuhsa"], $paciente["nhc"],
       $paciente["diagnostico"], $paciente["medicacion"], $paciente["fechaInclusion"], $paciente["idEnsayoClinico"], $conexion)){
			$_SESSION["exitoModPacientes"]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." ha sido creado correctamente.";
			header("Location: MuestraPacientes.php");
	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]; ?>
			<b>NO</b> ha sido insertado.-
		</div>
		</br> Para volver al formulario pincha <a href="FormPacientes.php">AQUÍ</a>
		</br> Para volver a la tabla pincha <a href="MuestraPacientes.php">AQUÍ</a><?php
		$_SESSION["paciente"] = $paciente;
	}
}elseif($paciente["accionPac"]=="update"){
		if(modificarPaciente($conexion,$paciente["ID_PAC"], $paciente["nombre"], $paciente["apellidos"], $paciente["nuhsa"], $paciente["nhc"],
			$paciente["diagnostico"], $paciente["medicacion"], $paciente["fechaInclusion"], $paciente["idEnsayoClinico"])){

			$_SESSION["exitoModPacientes"]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." ha sido actualizado correctamente.";
			header("Location: MuestraPacientes.php");
		 }else{
		 	$paciente["accionPac"]="pre-update";
		 	$_SESSION["paciente"] = $paciente;
			?> <div id="div_errorRegistro">
				Lo sentimos, el paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]." (".$paciente["fechaInclusion"].")"; ?>
				<b>NO</b> ha sido actualizado.
			</div><?php 		 	 
			#$errores[]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." <b>NO</b> ha sido actualizado correctamente.";
			#$_SESSION["errorModPacientes"]=$errores;
			
			?></br> Para volver al formulario pincha <a href="FormPacientes.php">AQUÍ</a>
			</br> Para volver a la tabla pincha <a href="MuestraPacientes.php">AQUÍ</a><?php			
			#header("Location: MuestraPacientes.php");
		}
}
 elseif($paciente["accionPac"]=="remove"){
		 $_SESSION["paciente"] = $paciente;
		?> <div id="div_errorRegistro">
			Lo sentimos, el paciente <?php echo $paciente["nombre"] . " " . $paciente["apellidos"]; ?>
			<b>NO</b> ha sido eliminado debido a políticas del sistema.
		</div><?php  	
 		#$errores[]="El paciente ". $paciente["nombre"] . " " . $paciente["apellidos"]." no se puede borrar debido a políticas del sistema";
		#$_SESSION["errorModPacientes"]=$errores;
		
		?></br> Para volver a la tabla pincha <a href="MuestraPacientes.php">AQUÍ</a><?php
		#header("Location: MuestraPacientes.php");	
 }
		 
	desconectarDB($conexion);
		?>
</div>
		<?php 	include_once("../Pie.php");
		?>
		
	</body>
</html>

