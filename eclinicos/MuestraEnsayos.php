<?php 

session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionEnsayos.php';
unset($_SESSION["ensayo"]);
#$_SESSION["ensayo"]=" ";
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
		include_once ("../CabeceraGenerica.php");
	?>
<div id="contenidoPag">
	<h3>Muestra Ensayo</h3>
		<?php 
		if(isset($_SESSION['exitoModEnsayos'])){
		 	$exitoEnsayos = $_SESSION['exitoModEnsayos'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoEnsayos");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModEnsayos"]);
		}
		if(isset($_SESSION['errorModEnsayos'])){
		 	$errorEnsayos = $_SESSION['errorModEnsayos'];
			echo "<div id='muestraErrores'>";
			foreach($errorEnsayos as $status){
				print("<div class='error'>");
				print("$status");
				#print ("$errorEnsayos");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModEnsayos"]);
		}
	?>
<body>
	<form method="post" action="
		<?php 
		if (isset($_REQUEST["new"])){
			#$citaPac["accionCitaPac"]="insert";
			#$_SESSION["citaPac"]=$citaPac;
			#$_SESSION["paciente"]=$paciente;
			unset($_SESSION["ensayo"]);
			header("Location:FormEnsayos.php");
		}?>">
		<button id="new" name="new" type="submit" class="Limpiar formulario">
		Inserta ensayo</button>
	</form>
	</br>	
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Situación actual</th><th>Fármaco</th><th>Controles</th></tr>
		<?php 
			$stmp = seleccionarEnsayos($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="ensayo">		
		<form method="post" action="ProcesaEnsayo.php">
			<input id="ID_EC" name="ID_EC" type="hidden" value="<?php echo $fila["ID_EC"]?>"/>
			<input id="situacion_actual" name="situacion_actual" type="hidden" value="<?php echo $fila["SITUACION_ACTUAL"]?>"/>
			<input id="criterio_inc" name="criterio_inc" type="hidden" value="<?php echo $fila["CRITERIO_INC"]?>"/>
			<input id="criterio_exc" name="criterio_exc" type="hidden" value="<?php echo $fila["CRITERIO_EXC"]?>"/>
			<input id="inicio_rec" name="inicio_rec" type="hidden" value="<?php echo $fila["INICIO_REC"]?>"/>
			<input id="fin_rec" name="fin_rec" type="hidden" value="<?php echo $fila["FIN_REC"]?>"/>
			<input id="farmaco" name="farmaco" type="hidden" value="<?php echo $fila["FARMACO"]?>"/>
			<td><?php echo $fila["ID_EC"]?></td>
			<td><?php echo $fila["SITUACION_ACTUAL"]?></td>
			<td><?php echo $fila["FARMACO"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionEc" name="accionEc" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionEc" name="accionEc" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionEc" name="accionEc" type="submit" value="more" class="editar_fila">
					<img src="/images/masFila.bmp" class="editar_fila" width="25px"></button>

					
				</div>
			</td>	
		</form></div></tr>
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