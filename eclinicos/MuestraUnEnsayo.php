<?php session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionEnsayos.php';
if (isset($_SESSION["ensayo"])) {
	$ensayo = $_SESSION["ensayo"];
} else {
	Header("Location: MuestraEnsayos.php");
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
	<h3>Muestra Ensayo</h3>
<body>	
	<h3>Detalles Ensayo</h3>
	<a href="MuestraEnsayos.php"><img src="/images/volver.bmp" /></a>
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Situación actual</th><th>Criterio de inclusión</th><th>Criterio de exclusión</th><th>Inicio de reclutamiento</th><th>Fin de reclutamiento</th><th>Fármaco</th><th>Controles</th></tr>
		<tr>
		<div class="ensayo">		
		<form method="post" action="ProcesaEnsayo.php">
			<input id="ID_EC" name="ID_EC" type="hidden" value="<?php echo $ensayo["ID_EC"]?>"/>
			<input id="situacion_actual" name="situacion_actual" type="hidden" value="<?php echo $ensayo["situacion_actual"]?>"/>
			<input id="criterio_inc" name="criterio_inc" type="hidden" value="<?php echo $ensayo["criterio_inc"]?>"/>
			<input id="criterio_exc" name="criterio_exc" type="hidden" value="<?php echo $ensayo["criterio_exc"]?>"/>
			<input id="inicio_rec" name="inicio_rec" type="hidden" value="<?php echo $ensayo["inicio_rec"]?>"/>
			<input id="fin_rec" name="fin_rec" type="hidden" value="<?php echo $ensayo["fin_rec"]?>"/>
			<input id="farmaco" name="farmaco" type="hidden" value="<?php echo $ensayo["farmaco"]?>"/>

			<td><?php echo $ensayo["ID_EC"]?></td>
			<td><?php echo $ensayo["situacion_actual"]?></td>
			<td><?php echo $ensayo["criterio_inc"]?></td>
			<td><?php echo $ensayo["criterio_exc"]?></td>
			<td><?php echo $ensayo["inicio_rec"]?></td>
			<td><?php echo $ensayo["fin_rec"]?></td>
			<td><?php echo $ensayo["farmaco"]?></td>
			<td>
				<div id="botones_fila">						
				<button id="accionEc" name="accionEc" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionEc" name="accionEc" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
					
				</div>
			</td>	
		</form></div></tr>
<?php  ?>
		</table>
		
	</div>
<?php
		include_once ("../Pie.php");
desconectarDB($conexion);
 ?>
</body>
</html>