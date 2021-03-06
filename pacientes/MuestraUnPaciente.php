<?php session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionPacientes.php';
if (isset($_SESSION["paciente"])) {
	$paciente = $_SESSION["paciente"];
} else {
	Header("Location: MuestraPacientes.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Detalles paciente</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Tablas.css">  
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
<body>
<div id="contenidoPag">
	
	<h3>Detalles paciente</h3>
	<a href="MuestraPacientes.php"><img src="/images/volver.bmp" /></a>
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>NUHSA</th><th>NHC</th><th>Diagnóstico</th><th>Medicación</th><th>Fecha Inclusión</th><th>ID Ensayo Clínico</th><th>Controles</th></tr>
		<tr>
		<div class="paciente">		
		<form method="post" action="ProcesaPaciente.php">
			<input id="ID_PAC" name="ID_PAC" type="hidden" value="<?php echo $paciente["ID_PAC"]?>"/>
			<input id="nombre" name="nombre" type="hidden" value="<?php echo $paciente["nombre"]?>"/>
			<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $paciente["apellidos"]?>"/>
			<input id="nuhsa" name="nuhsa" type="hidden" value="<?php echo $paciente["nuhsa"]?>"/>
			<input id="nhc" name="nhc" type="hidden" value="<?php echo $paciente["nhc"]?>"/>
			<input id="diagnostico" name="diagnostico" type="hidden" value="<?php echo $paciente["diagnostico"]?>"/>
			<input id="medicacion" name="medicacion" type="hidden" value="<?php echo $paciente["medicacion"]?>"/>
			<input id="fechaInclusion" name="fechaInclusion" type="hidden" value="<?php echo $paciente["fechaInclusion"]?>"/>
			<input id="idEnsayoClinico" name="idEnsayoClinico" type="hidden" value="<?php echo $paciente["idEnsayoClinico"]?>"/>
			<td><?php echo $paciente["ID_PAC"]?></td>
			<td><?php echo $paciente["nombre"]?></td>
			<td><?php echo $paciente["apellidos"]?></td>
			<td><?php echo $paciente["nuhsa"]?></td>
			<td><?php echo $paciente["nhc"]?></td>
			<td><?php echo $paciente["diagnostico"]?></td>
			<td><?php echo $paciente["medicacion"]?></td>
			<td><?php echo $paciente["fechaInclusion"]?></td>
			<td><?php echo $paciente["idEnsayoClinico"]?></td>
			<td>
				<div id="botones_fila">						
				<button id="accionPac" name="accionPac" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionPac" name="accionPac" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionPac" name="accionPac" type="submit" value="calendar" class="editar_fila">
					<img src="/images/calendarFila.bmp" class="editar_fila" width="25px"></button>
					
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