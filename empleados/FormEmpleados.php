<?php
	session_start();
	//require_once("../GestionarDB.php"); 
	//include_once('gestionUsuarios.php');
	//$conexion = conectarDB(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Crear nueva entrada</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">  
		<script src="validacionEmpleado.js"></script>
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Empleados</h3>
	<?php 
		if(isset($_SESSION['erroresCreaEmpleados'])){
		 	$erroresCreaEmpleados = $_SESSION['erroresCreaEmpleados'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaEmpleados as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaEmpleados"]);
		}
	?>
<form method="post" action="
	<?php if (isset($_REQUEST["unset"])){
		unset($_SESSION["empleado"]);
		header("Location:FormEmpleados.php");}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
	</br>	
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["empleado"])){
		$empleado["ID_EMP"]="";
		$empleado["nombre"]="";
		$empleado["apellidos"]="";
		$empleado["dni"]="";
		$empleado["telefono"]="";
		$empleado["email"]="";
		$empleado["accionEmp"]="insert";
		$_SESSION["empleado"]=$empleado;
	}else{
		$empleado=$_SESSION["empleado"];		
		$_SESSION["empleado"]=$empleado;
	}
	?>

	<div id="errores"></div>

	<form action="ProcesaEmpleado.php" onsubmit="return validaForm()">
		<input id="ID_EMP" name="ID_EMP" type="hidden" value="<?php echo $empleado["ID_EMP"]; ?>"/>

		<div id="div_nombre">
			<label for="nombre" id="label_nombre">Nombre del Empleado:</label>
			<input id="nombre" name="nombre" type="text" value="<?php echo $empleado["nombre"]; ?>"/>
		</div>
		<div id="div_apellidos">
			<label for="apellidos" id="label_apellidos">Apellidos del Empleado:</label>
			<input id="apellidos" name="apellidos" type="text" value="<?php echo $empleado["apellidos"]; ?>"/>
		</div>
		<div id="div_dni">
			<label for="dni" id="label_dni">DNI del Empleado:</label>
			<input id="dni" name="dni" type="text" value="<?php echo $empleado["dni"]; ?>"/>
		</div>
		<div id="div_telefono">
			<label for="telefono" id="label_telefono">Teléfono del Empleado:</label>
			<input id="telefono" name="telefono" type="text" value="<?php echo $empleado["telefono"]; ?>"/>
		</div>
		<div id="div_email">
			<label for="email" id="label_email">Email del Empleado:</label>
			<input id="email" name="email" type="text" value="<?php echo $empleado["email"]; ?>"/>
		</div>
		
		<?php if($empleado["accionEmp"]!="pre-update"){
			$empleado["accionEmp"]="insert";

			?>
		<input id="accionEmp" name="accionEmp" type="hidden" value="insert"/>

		<div id="div_submit">
			<input type="submit" value="Insertar"></input>
		</div>
		<?php }elseif($empleado["accionEmp"]=="pre-update"){ 
				$empleado["accionEmp"]="update";?>
		<input id="accionEmp" name="accionEmp" type="hidden" value="update"/>
		
		<div id="div_submit">
			<input type="submit" value="Actualizar"></input>
		</div>			
		<?php }?>
		<input id="accionEmp" name="accionEmp" type="hidden" value="<?php echo $empleado["accionEmp"]; ?>"/>

	</form>
	</div>
</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>