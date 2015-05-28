<?php 
session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionConEsp.php';
#unset($_SESSION["promotor"]);
#$_SESSION["paciente"]=" ";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Muestra ConEsp</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
<div id="contenidoPag">
	<h3>Monitores con visita en la próxima semana</h3>

<body>
	</br>		
	<div id='tablamuestra'>
		<table>
			<tr><th>Nombre del Monitor</th><th>Apellidos del Monitor</th><th>Fecha visita</th></tr>
		<?php 
			$stmp = monitoresProxSemana($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="pacEnsEst">		
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
			<td><?php echo $fila["FECHA"]?></td>

		</div></tr>
<?php } ?>
		</table>
		
	</div>
</div>
<?php
		include_once ("../Pie.php");
desconectarDB($conexion);
 ?>
</body>
</html>