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
	<h3>Número de pacientes en cada ensayo</h3>

<body>
	</br>		
	<div id='tablamuestra'>
		<table>
			<tr><th>Id ensayo</th><th>Número de pacientes</th></tr>
		<?php 
			$stmp = cuentaPacEnsayos($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="pacEnsEst">		
			<td><?php echo $fila["ID_EC"]?></td>
			<td><?php echo $fila["NUM_PACIENTES"]?></td>
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