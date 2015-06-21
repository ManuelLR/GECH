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
		<title>Estado Registro del Empleado</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
		<h3>Estado Registro del Empleado</h3>
<?php
$conexion=conectarBD();
if($empleado["accionEmp"]=="insert"){
	
	if (insertarEmpleado($empleado["nombre"], $empleado["apellidos"], $empleado["dni"], $empleado["telefono"],
       $empleado["email"], $conexion)){
			$_SESSION["exitoModEmpleados"]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." ha sido insertado correctamente.";
			header("Location: MuestraEmpleados.php");
	}else{ 
		echo $_SESSION["errorDB"];
		?>
		<div id="div_errorRegistro">
			Lo sentimos, el empleado <?php echo $empleado["nombre"] . " " . $empleado["apellidos"]; ?>
			<b>NO</b> ha sido insertado.
		</div>
		</br> Para volver al formulario pincha <a href="FormEmpleados.php">AQUÍ</a>
		</br> Para volver a la tabla pincha <a href="MuestraEmpleados.php">AQUÍ</a><?php

		$_SESSION["empleado"] = $empleado;
	}

}elseif($empleado["accionEmp"]=="update"){
		if(modificarEmpleado($conexion,$empleado["ID_EMP"], $empleado["nombre"], $empleado["apellidos"], $empleado["dni"], $empleado["telefono"],
			$empleado["email"])){

			$_SESSION["exitoModEmpleados"]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." ha sido actualizado correctamente.";
			header("Location: MuestraEmpleados.php");
		 }else{
		echo $_SESSION["errorDB"];
		
		 	$empleado["accionEmp"]="pre-update";
		 	$_SESSION["empleado"] = $empleado;
			?> <div id="div_errorRegistro">
				Lo sentimos, el empleado 
				<b>NO</b> ha sido actualizado.
			</div><?php 
			#$errores[]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." <b>NO</b> ha sido actualizado correctamente.";
			#$_SESSION["errorModEmpleados"]=$errores;
			?></br> Para volver al formulario pincha <a href="FormEmpleados.php">AQUÍ</a>
			</br> Para volver a la tabla pincha <a href="MuestraEmpleados.php">AQUÍ</a><?php			
			#header("Location: MuestraEmpleados.php");
		}
}
 elseif($empleado["accionEmp"]=="remove"){
 		$_SESSION["empleado"] = $empleado;
		?> <div id="div_errorRegistro">
			Lo sentimos, el empleado 
			<b>NO</b> ha sido eliminado debido a políticas del sistema.
		</div><?php
 		#$errores[]="El empleado ". $empleado["nombre"] . " " . $empleado["apellidos"]." no se puede borrar debido a políticas del sistema";
		#$_SESSION["errorModEmpleados"]=$errores;
		?></br> Para volver a la tabla pincha <a href="MuestraEmpleados.php">AQUÍ</a><?php
		
		#header("Location: MuestraEmpleados.php");	
 }
		 
	desconectarDB($conexion);
		?>
</div>
		<?php 	include_once("../Pie.php");
		?>
	</body>
</html>
