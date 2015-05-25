<?php session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionEmpleados.php';
if (isset($_SESSION["empleado"])) {
	$empleado = $_SESSION["empleado"];
} else {
	Header("Location: MuestraEmpleados.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Crear nueva entrada</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Tablas.css">  
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
	<h3>Detalles Empleado</h3>
	<a href="MuestraEmpleados.php"><img src="/images/volver.bmp" /></a>
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>TELEFONO</th><th>EMAIL</th><th>Controles</th></tr>
		<tr>
		<div class="empleado">		
		<form method="post" action="ProcesaEmpleado.php">
			<input id="ID_EMP" name="ID_EMP" type="hidden" value="<?php echo $empleado["ID_EMP"]?>"/>
			<input id="nombre" name="nombre" type="hidden" value="<?php echo $empleado["nombre"]?>"/>
			<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $empleado["apellidos"]?>"/>
			<input id="dni" name="dni" type="hidden" value="<?php echo $empleado["dni"]?>"/>
			<input id="telefono" name="telefono" type="hidden" value="<?php echo $empleado["telefono"]?>"/>
			<input id="email" name="email" type="hidden" value="<?php echo $empleado["email"]?>"/>

			<td><?php echo $empleado["ID_EMP"]?></td>
			<td><?php echo $empleado["nombre"]?></td>
			<td><?php echo $empleado["apellidos"]?></td>
			<td><?php echo $empleado["dni"]?></td>
			<td><?php echo $empleado["telefono"]?></td>
			<td><?php echo $empleado["email"]?></td>
			<td>
				<div id="botones_fila">						
				<button id="accionEmp" name="accionEmp" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionEmp" name="accionEmp" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
					
				</div>
			</td>	
		</form></div></tr>
<?php  ?>
		</table>
		
	</div>
</div>
<?php
		include_once ("../Pie.php");
desconectarDB($conexion);
 ?>
</body>
</html>