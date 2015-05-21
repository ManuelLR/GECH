<?php
	session_start();
	require_once("../GestionarDB.php"); 
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
	<?php include_once("../CabeceraGenerica.php");?>
	<h3>Muestra Paciente</h3>
<body>	
	<div id='tablamuestra'>
	<?php
		$stmp = seleccionarPacientes($conexion);
		echo "<table>";
		echo "<tr>";
		echo "<th class='nombre'>Nombre</th>";
		echo "<th class='apellidos'>Apellidos</th>";
		echo "<th class='diagnostico'>Diagnostico</th>";
		echo "<th class='medicacion'>Medicación auxiliar</th>";
		echo "</tr>";
		foreach ($stmp as $fila) {
			echo "<tr>";
			echo "<td class='nombre'>".$fila["NOMBRE"]."</td>";
			echo "<td class='apellidos'>".$fila["APELLIDOS"]."</td>";
			echo "<td class='diagnostico'>".$fila["DIAGNOSTICO"]."</td>";
			echo "<td class='medicacion'>".$fila["MEDICACION_AUX"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	?>
	</div>
	<h3>Muestra pacientes modificado</h3>
	<div id='tablamuestra'>
		<table>
		<?php 
			$stmp = seleccionarPacientes($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>			
		<form method="post" action="ProcesaPaciente.php">
			<td><input id="OID_PACIENTE" name="OID_PACIENTE" type="text" value="<?php echo $fila["ID_PAC"]?>"/></td>
			<td><?php	
			
				echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]." ". "<div class='titulo'>" .$fila["DIAGNOSTICO"] . "</div>"; 
						?></td>
		</form></tr>
<?php
		}
		?>
		</table>
		
	</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>