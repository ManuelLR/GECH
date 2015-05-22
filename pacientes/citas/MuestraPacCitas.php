<?php
	session_start();
require_once ("../../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionPacCitas.php';
unset($_SESSION["citaPac"]);
$citaPac["accionCitaPac"]="lee";
$_SESSION["citaPac"]=$citaPac;
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Citas</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
		<script src="validacionPaciente.js"></script>
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
	<h3>Muestra Citas</h3>
<?php 
		if(isset($_SESSION['exitoModPacCita'])){
		 	$exitoPacCita = $_SESSION['exitoModPacCita'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoPacCita");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModPacCita"]);
		}
		if(isset($_SESSION['errorModPacCita'])){
		 	$errorPacCita = $_SESSION['errorModPacCita'];
			echo "<div id='muestraErrores'>";
			foreach($errorPacCita as $status){
				print("<div class='error'>");
				print("$status");
				#print ("$errorPacientes");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModPacCita"]);
		}
?>
	<form method="post" action="
	<?php 
		if (isset($_REQUEST["unset"])){
			unset($_SESSION["paciente"]);
			header("Location: MuestraPacCitas.php");
		}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Todas las citas</button>
</form>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["new"])){
			#$citaPac["accionCitaPac"]="insert";
			#$_SESSION["citaPac"]=$citaPac;
			$_SESSION["paciente"]=$paciente;
			unset($_SESSION["citaPac"]);
			header("Location:FormPacCitas.php");
		}?>">
<button id="new" name="new" type="submit" class="Limpiar formulario">
Inserta cita</button>
</form>
<?php
if (isset($_SESSION["paciente"])) {
	$paciente = $_SESSION["paciente"];
?>

	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Fecha</th><th>Tipo</th><th>ID_PAC</th><th>Controles</th></tr>
		<?php 
	$stmp = seleccionarPacCitas($conexion);
	foreach($stmp as $fila) {
		?>		
		<tr>
		<div class="paciente">		
		<form method="post" action="ProcesaPacCita.php">
			<input id="ID_FECHA" name="ID_FECHA" type="hidden" value="<?php echo $fila["ID_FECHA"]?>"/>
			<input id="fecha" name="fecha" type="hidden" value="<?php echo $fila["FECHA"]?>"/>
			<input id="tipo" name="tipo" type="hidden" value="<?php echo $fila["TIPO"]?>"/>
			<input id="idPac" name="idPac" type="hidden" value="<?php echo $fila["ID_PAC"]?>"/>

			<td><?php echo $fila["ID_FECHA"]?></td>
			<td><?php echo $fila["FECHA"]?></td>
			<td><?php echo $fila["TIPO"]?></td>
			<td><?php echo $fila["ID_PAC"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionCitaPac" name="accionCitaPac" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionCitaPac" name="accionCitaPac" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<!--<button id="accionPac" name="accionPac" type="submit" value="more" class="editar_fila">
					<img src="/images/masFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionPac" name="accionPac" type="submit" value="calendar" class="editar_fila">
					<img src="/images/calendarFila.bmp" class="editar_fila" width="25px"></button>-->
					
				</div>
			</td>	
		</form></div></tr>
<?php 
	} ?>
		</table>
		
	</div>
<?php }else {
	echo "NO Ha entrado paciente por lo que debe mostrar todas las citas";
}
	
	
include_once("../../Pie.php"); 
?>
</body>
</html>
	