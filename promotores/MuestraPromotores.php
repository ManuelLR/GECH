<?php 

session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionPromotores.php';
unset($_SESSION["promotor"]);
#$_SESSION["paciente"]=" ";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Muestra Promotor</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
<div id="contenidoPag">
	<h3>Muestra Promotor</h3>
		<?php 
		if(isset($_SESSION['exitoModPromotores'])){
		 	$exitoPromotores = $_SESSION['exitoModPromotores'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoPromotores");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModPromotores"]);
		}
		if(isset($_SESSION['errorModPromotores'])){
		 	$errorPromotores = $_SESSION['errorModPromotores'];
			echo "<div id='muestraErrores'>";
			foreach($errorPromotores as $status){
				print("<div class='error'>");
				print("$status");
				#print ("$errorPacientes");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModPromotores"]);
		}
	?>
<body>
	<form method="post" action="
		<?php 
		if (isset($_REQUEST["new"])){
			#$citaPac["accionCitaPac"]="insert";
			#$_SESSION["citaPac"]=$citaPac;
			#$_SESSION["paciente"]=$paciente;
			unset($_SESSION["promotor"]);
			header("Location:FormPromotores.php");
		}?>">
		<button id="new" name="new" type="submit" class="Limpiar formulario">
		Inserta promotor</button>
	</form>
	</br>		
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Nombre de la Empresa</th><th>CIF</th><th>Controles</th><th>Monitores</th></tr>
		<?php 
			$stmp = seleccionarPromotores($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="Promotor">		
		<form method="post" action="ProcesaPromotor.php">
			<input id="ID_PRO" name="ID_PRO" type="hidden" value="<?php echo $fila["ID_PRO"]?>"/>
			<input id="nombre" name="nombre" type="hidden" value="<?php echo $fila["NOMBRE_EMPRESA"]?>"/>
			<input id="cif" name="cif" type="hidden" value="<?php echo $fila["CIF"]?>"/>
			
			<td><?php echo $fila["ID_PRO"]?></td>
			<td><?php echo $fila["NOMBRE_EMPRESA"]?></td>
			<td><?php echo $fila["CIF"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionPro" name="accionPro" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionPro" name="accionPro" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				</div>
			</td>
			<td>
				<div id="botones_fila">						
				<button id="accionPro" name="accionPro" type="submit" value="monitores" class="editar_fila">
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