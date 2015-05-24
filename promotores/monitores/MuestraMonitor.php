<?php
	session_start();
require_once ("../../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionMonitores.php';
unset($_SESSION["monitor"]);
$monitor["accionMonitor"]="lee";
$_SESSION["monitor"]=$monitor;
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Muestra Monitores</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Muestra Monitores</h3>
<?php 
		if(isset($_SESSION['exitoModMonitor'])){
		 	$exitoMonitor = $_SESSION['exitoModMonitor'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoMonitor");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModMonitor"]);
		}
		if(isset($_SESSION['errorModMonitor'])){
		 	$errorMonitor = $_SESSION['errorModMonitor'];
			echo "<div id='muestraErrores'>";
			foreach($errorMonitor as $status){
				print("<div class='error'>");
				print("$status");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModMonitor"]);
		}
?>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["clean"])){
			unset($_SESSION["promotor"]);
			header("Location: MuestraMonitor.php");
		}?>">
	<button id="clean" name="clean" type="submit" class="Limpiar formulario">
		Todas los monitores</button>
</form>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["new"])){
			#$monitor["accionMonitor"]="insert";
			#$_SESSION["monitor"]=$monitor;
			#$_SESSION["promotor"]=$promotor;
			unset($_SESSION["monitor"]);
			$monitor["accionMonitor"]="pre-insert";
			$_SESSION["monitor"]=$monitor;
			header("Location:ProcesaMonitor.php");
		}?>">
	<button id="new" name="new" type="submit" class="Limpiar formulario">
		Inserta Monitor</button>
</form>
<?php
if (isset($_SESSION["promotor"])) {
	$promotor = $_SESSION["promotor"];

?>
<h4>Monitores para el promotor: <?php echo $promotor["nombre"];?></h4>

		<?php 
	$stmp = seleccionarMonitorUno($conexion, $promotor);
}else{
	echo "Muestra todos los monitores";
	$stmp = seleccionarMonitores($conexion);
	}
?>
	<div id='tablamuestra'>
		<table>
			<tr><th>ID Monitor</th><th>Nombre</th><th>Apellidos</th><th>Telefono</th><th>Email</th><th>Id ensayo</th><th>Id promotor</th><th>Controles</th></tr>
<?php	
	foreach($stmp as $fila) {
		?>
		
		<tr>
		<div class="monitor">		
		<form method="post" action="ProcesaMonitor.php">
			<input id="ID_MON" name="ID_MON" type="hidden" value="<?php echo $fila["ID_MON"]?>"/>
			<input id="nombre" name="nombre" type="hidden" value="<?php echo $fila["NOMBRE"]?>"/>
			<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $fila["APELLIDOS"]?>"/>
			<input id="telefono" name="telefono" type="hidden" value="<?php echo $fila["TELEFONO"]?>"/>
			<input id="email" name="email" type="hidden" value="<?php echo $fila["EMAIL"]?>"/>
			<input id="idEc" name="idEc" type="hidden" value="<?php echo $fila["ID_EC"]?>"/>
			<input id="idPro" name="idPro" type="hidden" value="<?php echo $fila["ID_PRO"]?>"/>
			

			<td><?php echo $fila["ID_MON"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
			<td><?php echo $fila["TELEFONO"]?></td>
			<td><?php echo $fila["EMAIL"]?></td>
			<td><?php echo $fila["ID_EC"]?></td>
			<td><?php echo $fila["ID_PRO"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionMonitor" name="accionMonitor" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionMonitor" name="accionMonitor" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionMonitor" name="accionMonitor" type="submit" value="calendar" class="editar_fila">
					<img src="/images/calendarFila.bmp" class="editar_fila" width="25px"></button>
				</div>
			</td>	
		</form></div></tr>
<?php 
	} ?>
		</table>
		
	</div>
</div>
<?php 
	
include_once("../../Pie.php"); 
?>
</body>
</html>
	