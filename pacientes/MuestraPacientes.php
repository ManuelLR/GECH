<?php session_start();
require_once ("../GestionarDB.php");
//include_once('gestionUsuarios.php');
$conexion = conectarBD();
include_once 'GestionPacientes.php';
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
	<h3>Muestra Paciente</h3>
		<?php 
		if(isset($_SESSION['exitoModPacientes'])){
		 	$exitoPacientes = $_SESSION['exitoModPacientes'];
			echo "<div id='muestraExitos'>";
			#foreach($exitoPacientes as $status){
				print("<div class='error'>");
				#print("$status");
				print ("$exitoPacientes");
				print("</div>");
			#}
			echo "</div>";
		unset($_SESSION["exitoModPacientes"]);
		}
		if(isset($_SESSION['errorModPacientes'])){
		 	$errorPacientes = $_SESSION['errorModPacientes'];
			echo "<div id='muestraErrores'>";
			#foreach($exitoPacientes as $status){
				print("<div class='error'>");
				#print("$status");
				print ("$errorPacientes");
				print("</div>");
			#}
			echo "</div>";
		unset($_SESSION["exitoModPacientes"]);
		}
	?>
<body>	
	<div id='tablamuestra'>
	<?php $stmp = seleccionarPacientes($conexion);
	echo "<table>";
	echo "<tr>";
	echo "<th class='nombre'>Nombre</th>";
	echo "<th class='apellidos'>Apellidos</th>";
	echo "<th class='diagnostico'>Diagnostico</th>";
	echo "<th class='medicacion'>Medicación auxiliar</th>";
	echo "</tr>";
	foreach ($stmp as $fila) {
		echo "<tr>";
		echo "<td class='nombre'>" . $fila["NOMBRE"] . "</td>";
		echo "<td class='apellidos'>" . $fila["APELLIDOS"] . "</td>";
		echo "<td class='diagnostico'>" . $fila["DIAGNOSTICO"] . "</td>";
		echo "<td class='medicacion'>" . $fila["MEDICACION_AUX"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	?>
	</div>
	<h3>Muestra pacientes modificado</h3>
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Controles</th></tr>
		<?php 
			$stmp = seleccionarPacientes($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="paciente">		
		<form method="post" action="ProcesaPaciente.php">
			<input id="ID_PAC" name="ID_PAC" type="hidden" value="<?php echo $fila["ID_PAC"]?>"/>
			<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]?>"/>
			<input id="APELLIDOS" name="APELLIDOS" type="hidden" value="<?php echo $fila["APELLIDOS"]?>"/>
			<input id="NUHSA" name="NUHSA" type="hidden" value="<?php echo $fila["NUHSA"]?>"/>
			<input id="NHC" name="NHC" type="hidden" value="<?php echo $fila["NHC"]?>"/>
			<input id="DIAGNOSTICO" name="DIAGNOSTICO" type="hidden" value="<?php echo $fila["DIAGNOSTICO"]?>"/>
			<input id="MEDICACION_AUX" name="MEDICACION_AUX" type="hidden" value="<?php echo $fila["MEDICACION_AUX"]?>"/>
			<input id="FECHA_INCLUSION" name="FECHA_INCLUSION" type="hidden" value="<?php echo $fila["FECHA_INCLUSION"]?>"/>
			<input id="ID_EC" name="ID_EC" type="hidden" value="<?php echo $fila["ID_EC"]?>"/>
			<td><?php echo $fila["ID_PAC"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="editar" name="editar" type="submit" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="quitar" name="quitar" type="submit" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<button id="masInfo" name="masInfo" type="submit" class="editar_fila">
					<img src="/images/masFila.bmp" class="editar_fila" width="25px"></button>
					
				</div>
			</td>	
				<!--<?php	
			
				echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]." ". "<div class='titulo'>" .$fila["DIAGNOSTICO"] . "</div>"; 
						?></td>-->
		</form></div></tr>
<?php } ?>
		</table>
		
	</div>
<?php
		include_once ("../Pie.php");
desconectarDB($conexion);
 ?>
</body>
</html>