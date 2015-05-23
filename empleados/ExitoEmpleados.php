<?php 
session_start();
include_once ("../GestionarDB.php");
include_once ('GestionEmpleados.php');
if (isset($_SESSION["empleado"])) {
	$empleado = $_SESSION["empleado"];
	unset($_SESSION["empleado"]);
	unset($_SESSION["erroresCreaEmpleados"]);
} else {
	$_SESSION["erroresCreaEmpleados"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormEmpleados.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Empleado</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro del Empleado</h3>
<?php
$conexion=conectarBD();
if($empleado["accionEmp"]=="insert"){
	
	if (insertarEmpleado($empleado["nombre"], $empleado["apellidos"], $empleado["dni"], $empleado["telefono"],
       $empleado["email"], $conexion)){
	?>
		<div id="div_exito">
			El Empleado <?php echo $empleado["nombre"] . " " . $empleado["apellidos"]; ?>
			ha sido insertado correctamente.
		</div>
	<?php 
	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el empleado <?php echo $empleado["nombre"] . " " . $empleado["apellidos"]; ?>
			<b>NO</b> ha sido insertado.-
		</div>
		<?php
		$_SESSION["empleado"] = $empleado;
	}
		?> <div id="div_volver"> Para volver al formulario pulsa <a href="FormEmpleados.php">aquí</a>.</div>
<?php
}elseif($empleado["accionEmp"]=="update"){
		if(modificarEmpleado($conexion,$empleado["ID_EMP"], $empleado["nombre"], $empleado["apellidos"], $empleado["dni"], $empleado["telefono"],
			$empleado["email"])){

			$_SESSION["exitoModEmpleados"]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." ha sido actualizado correctamente.";
			header("Location: MuestraEmpleados.php");
		 }else{ 
			$errores[]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." <b>NO</b> ha sido actualizado correctamente.";
			$_SESSION["errorModEmpleados"]=$errores;
			header("Location: MuestraEmpleados.php");
		}
}
 elseif($empleado["accionEmp"]=="remove"){
 		$errores[]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." no se puede borrar debido a políticas del sistema";
		$_SESSION["errorModEmpleados"]=$errores;
		header("Location: MuestraEmpleados.php");	
 }
		 
	desconectarDB($conexion);
		?>
		<?php 	include_once("../Pie.php");
		?>
	</body>
</html>
