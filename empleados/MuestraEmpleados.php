<?php 

session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionEmpleados.php';
unset($_SESSION["empleado"]);
#$_SESSION["empleado"]=" ";
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
<div id="contenidoPag">
	<h3>Muestra Empleado</h3>
		<?php 
		if(isset($_SESSION['exitoModEmpleados'])){
		 	$exitoEmpleados = $_SESSION['exitoModEmpleados'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoEmpleados");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoModEmpleados"]);
		}
		if(isset($_SESSION['errorModEmpleados'])){
		 	$errorEmpleados = $_SESSION['errorModEmpleados'];
			echo "<div id='muestraErrores'>";
			foreach($errorEmpleados as $status){
				print("<div class='error'>");
				print("$status");
				#print ("$errorEmpleados");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorModEmpleados"]);
		}
	?>
<body>
	<form method="post" action="
		<?php 
		if (isset($_REQUEST["new"])){
			#$citaPac["accionCitaPac"]="insert";
			#$_SESSION["citaPac"]=$citaPac;
			#$_SESSION["paciente"]=$paciente;
			unset($_SESSION["empleado"]);
			header("Location:FormEmpleados.php");
		}?>">
		<button id="new" name="new" type="submit" class="Limpiar formulario">
		Inserta empleado</button>
	</form>
	</br>		
	<div id='tablamuestra'>
		<table>
			<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Controles</th><th>Trabaja en</th></tr>
		<?php 
			$stmp = seleccionarEmpleados($conexion);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="empleado">		
		<form method="post" action="ProcesaEmpleado.php">
			<input id="ID_EMP" name="ID_EMP" type="hidden" value="<?php echo $fila["ID_EMP"]?>"/>
			<input id="nombre" name="nombre" type="hidden" value="<?php echo $fila["NOMBRE"]?>"/>
			<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $fila["APELLIDOS"]?>"/>
			<input id="dni" name="dni" type="hidden" value="<?php echo $fila["DNI"]?>"/>
			<input id="telefono" name="telefono" type="hidden" value="<?php echo $fila["TELEFONO"]?>"/>
			<input id="email" name="email" type="hidden" value="<?php echo $fila["EMAIL"]?>"/>

			<td><?php echo $fila["ID_EMP"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
				
			<td>
				<div id="botones_fila">						
				<button id="accionEmp" name="accionEmp" type="submit" value="pre-update" class="editar_fila">
					<img src="/images/editFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionEmp" name="accionEmp" type="submit" value="remove" class="editar_fila">
					<img src="/images/remFila.bmp" class="editar_fila" width="25px"></button>
				<button id="accionEmp" name="accionEmp" type="submit" value="more" class="editar_fila">
					<img src="/images/masFila.bmp" class="editar_fila" width="25px"></button>
				</div>
			</td>
			<td>
				<div id="botones_fila">						
					<button id="accionEmp" name="accionEmp" type="submit" value="trabajaEn" class="editar_fila">
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