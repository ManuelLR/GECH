<?php
	session_start();
require_once ("../../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionFecMon.php';
unset($_SESSION["fecMon"]);
$fecMon["accionFecMon"]="lee";
$_SESSION["fecMon"]=$fecMon;
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Muestra Fechas Monitores</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Muestra Fechas Monitores</h3>
<?php 
		if(isset($_SESSION['exitoModFecMon'])){
		 	$exitoFecMon = $_SESSION['exitoModFecMon'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoFecMon");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModFecMon"]);
		}
		if(isset($_SESSION['errorModFecMon'])){
		 	$errorFecMon = $_SESSION['errorModFecMon'];
			echo "<div id='muestraErrores'>";
			foreach($errorFecMon as $status){
				print("<div class='error'>");
				print("$status");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModFecMon"]);
		}
?>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["clean"])){
			unset($_SESSION["monitor"]);
			header("Location: MuestraFecMon.php");
		}?>">
	<button id="clean" name="clean" type="submit" class="Limpiar formulario">Mostrar todas las Fechas</button>
</form>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["new"])){
			#$fecMon["accionFecMon"]="insert";
			#$_SESSION["fecMon"]=$fecMon;
			#$_SESSION["monitor"]=$monitor;
			unset($_SESSION["fecMon"]);
			$fecMon["accionFecMon"]="pre-insert";
			$_SESSION["fecMon"]=$fecMon;
			header("Location:ProcesaFecMon.php");
		}?>">
	<button id="new" name="new" type="submit" class="Limpiar formulario">Inserta cita</button>
</form>
<?php
if (isset($_SESSION["monitor"])) {
	$monitor = $_SESSION["monitor"];

?>
<h4>Citas del monitor: <?php echo $monitor["nombre"];?></h4>

		<?php 
	$stmp = seleccionarFecMonUno($conexion, $monitor);
}else{
?><h4>Muestra todas las citas</h4><?php
	$stmp = seleccionarFecMon($conexion);
	}
?>
	<div id='tablamuestra'>
		<table>
			<tr><th>Fecha</th><th>ID_MON</th><th>Nombre Monitor</th><th>Apellido Monitor</th><th>Ensayo Clínico</th><th>Controles</th></tr>
<?php
#	if(count($stmp)<0){
#		echo "vacio";
#		echo count($stmp);
#		#echo $stmp;
#		
#	}else{
#		echo count($stmp, COUNT_RECURSIVE);
	foreach($stmp as $fila) {
		?>
		
		<tr>
		<div class="monitor">		
		<form method="post" action="ProcesaFecMon.php">
			<input id="fecha" name="fecha" type="hidden" value="<?php echo $fila["FECHA"]?>"/>
			<input id="idMon" name="idMon" type="hidden" value="<?php echo $fila["ID_MON"]?>"/>

			<td><?php echo $fila["FECHA"]?></td>
			<td><?php echo $fila["ID_MON"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
			<td><?php echo $fila["ID_EC"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionFecMon" name="accionFecMon" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionFecMon" name="accionFecMon" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				</div>
			</td>	
		</form></div></tr>
<?php 
#	}
} ?>
		</table>
		
	</div>
</div>
<?php 
	
include_once("../../Pie.php"); 
?>
</body>
</html>
	