<?php 

session_start();
require_once ("../GestionarDB.php");
//include_once('gestionUsuarios.php');
$conexion = conectarBD();
include_once 'GestionPacientes.php';
unset($_SESSION["paciente"]);
$_SESSION["paciente"]=" ";
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
				print("<div class='error'>");
				print ("$exitoPacientes");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModPacientes"]);
		}
		if(isset($_SESSION['errorModPacientes'])){
		 	$errorPacientes = $_SESSION['errorModPacientes'];
			echo "<div id='muestraErrores'>";
			foreach($errorPacientes as $status){
				print("<div class='error'>");
				print("$status");
				#print ("$errorPacientes");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModPacientes"]);
		}
	?>
<body>	
	<!--<div id='tablamuestra'>
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
	<h3>Muestra pacientes modificado</h3>-->
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
			<input id="nombre" name="nombre" type="hidden" value="<?php echo $fila["NOMBRE"]?>"/>
			<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $fila["APELLIDOS"]?>"/>
			<input id="nuhsa" name="nuhsa" type="hidden" value="<?php echo $fila["NUHSA"]?>"/>
			<input id="nhc" name="nhc" type="hidden" value="<?php echo $fila["NHC"]?>"/>
			<input id="diagnostico" name="diagnostico" type="hidden" value="<?php echo $fila["DIAGNOSTICO"]?>"/>
			<input id="medicacion" name="medicacion" type="hidden" value="<?php echo $fila["MEDICACION_AUX"]?>"/>
			<input id="fechaInclusion" name="fechaInclusion" type="hidden" value="<?php echo $fila["FECHA_INCLUSION"]?>"/>
			<input id="idEnsayoClinico" name="idEnsayoClinico" type="hidden" value="<?php echo $fila["ID_EC"]?>"/>
			<td><?php echo $fila["ID_PAC"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accion" name="accion" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accion" name="accion" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accion" name="accion" type="submit" value="more" class="editar_fila">
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