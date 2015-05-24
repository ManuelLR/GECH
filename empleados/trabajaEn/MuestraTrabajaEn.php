<?php 

session_start();
require_once ("../../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionTrabajaEn.php';
unset($_SESSION["trabajaEn"]);
$trabajaEn["accionTraEn"]="lee";
$_SESSION["trabajaEn"]=$trabajaEn;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Crear nueva entrada</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head>
	<?php
		include_once ("../../CabeceraGenerica.php");
	?>
	<h3>Muestra Trabaja En</h3>
		<?php 
		if(isset($_SESSION['exitoModTrabajaEn'])){
		 	$exitoTrabajaEn = $_SESSION['exitoModTrabajaEn'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoTrabajaEn");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModTrabajaEn"]);
		}
		if(isset($_SESSION['errorModTrabajaEn'])){
		 	$errorTrabajaEn = $_SESSION['errorModTrabajaEn'];
			echo "<div id='muestraErrores'>";
			foreach($errorTrabajaEn as $status){
				print("<div class='error'>");
				print("$status");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModTrabajaEn"]);
		}
	?>
<body>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["clean"])){
			unset($_SESSION["empleado"]);
			header("Location: MuestraTrabajaEn.php");
		}?>">
	<button id="clean" name="clean" type="submit" class="Limpiar formulario">Todas los TrabajaEN</button>
</form>
<form method="post" action="
	<?php 
		if (isset($_REQUEST["new"])){
			#$citaPac["accionCitaPac"]="insert";
			#$_SESSION["citaPac"]=$citaPac;
			#$_SESSION["paciente"]=$paciente;
			unset($_SESSION["trabajaEn"]);
			$trabajaEn["accionTraEn"]="pre-insert";
			$_SESSION["trabajaEn"]=$trabajaEn;
			header("Location:ProcesaTrabajaEn.php");
		}?>">
	<button id="new" name="new" type="submit" class="Limpiar formulario">Inserta trabajaEn</button>
</form>	
<?php
if (isset($_SESSION["empleado"])) {
	$empleado = $_SESSION["empleado"];

?>
<h4>Trabaja en del empleado: <?php echo $empleado["nombre"]." ".$empleado["apellidos"]?></h4>

		<?php 
	$stmp = seleccionarTrabajaEnUno($conexion, $empleado);
}else{
	echo "Muestra todos los trabajaEn";
	$stmp = seleccionarTrabajaEn($conexion);
	}
?>
		
	<div id='tablamuestra'>
		<table>
			<tr><th>ID_EC</th><th>ID_EMP</th><th>Nombre</th><th>Apellidos</th><th>Cargo</th><th>Controles</th></tr>
		<?php 
			$stmp = seleccionarTrabajaEn($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="trabajaEn">		
		<form method="post" action="ProcesaTrabajaEn.php">
			<input id="ID_EC" name="ID_EC" type="hidden" value="<?php echo $fila["ID_EC"]?>"/>
			<input id="ID_EMP" name="ID_EMP" type="hidden" value="<?php echo $fila["ID_EMP"]?>"/>
			<input id="cargo" name="cargo" type="hidden" value="<?php echo $fila["CARGO"]?>"/>
			
			<td><?php echo $fila["ID_EC"]?></td>
			<td><?php echo $fila["ID_EMP"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
			<td><?php echo $fila["CARGO"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionTraEn" name="accionTraEn" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionTraEn" name="accionTraEn" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				
					
				</div>
			</td>	
		</form></div></tr>
<?php } ?>
		</table>
		
	</div>
<?php
		include_once ("../../Pie.php");
desconectarDB($conexion);
 ?>
</body>
</html>