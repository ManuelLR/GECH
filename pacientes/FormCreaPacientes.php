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
		<script src="validacionPaciente.js"></script>
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
	<h3>Paciente</h3>
	<?php 
		if(isset($_SESSION['erroresCreaPacientes'])){
		 	$erroresCreaPacientes = $_SESSION['erroresCreaPacientes'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaPacientes as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaPacientes"]);
		}
	?>
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["crearPaciente"])){
		$crearPaciente["nombre"]="";
		$crearPaciente["apellidos"]="";
		$crearPaciente["nuhsa"]="";
		$crearPaciente["nhc"]="";
		$crearPaciente["diagnostico"]="";
		$crearPaciente["medicacion"]="";
		$crearPaciente["fechaInclusion"]="";
		$crearPaciente["idEnsayoClinico"]="";
		$_SESSION["crearPaciente"]=$crearPaciente;
	}
	else{
		$crearPaciente=$_SESSION["crearPaciente"];
	}
	?>

	<div id="errores"></div>
	

	<form action="TratamientoFormCrearPaciente.php" onsubmit="return validaForm()">
		<div id="div_nombre">
			<label for="nombre" id="label_nombre">Nombre del Paciente:</label>
			<input id="nombre" name="nombre" type="text" value="<?php echo $crearPaciente["nombre"]; ?>"/>
		</div>
		<div id="div_apellidos">
			<label for="apellidos" id="label_apellidos">Apellidos del Paciente:</label>
			<input id="apellidos" name="apellidos" type="text" value="<?php echo $crearPaciente["apellidos"]; ?>"/>
		</div>
		<div id="div_nuhsa">
			<label for="nuhsa" id="label_nuhsa">NUHSA del Paciente:</label>
			<input id="nuhsa" name="nuhsa" type="text" value="<?php echo $crearPaciente["nuhsa"]; ?>"/>
		</div>
		<div id="div_nhc">
			<label for="nhc" id="label_nhc">NHC del Paciente:</label>
			<input id="nhc" name="nhc" type="text" value="<?php echo $crearPaciente["nhc"]; ?>"/>
		</div>
		<div id="div_diagnostico">
			<label for="diagnostico" id="label_diagnostico">Diagnóstico del Paciente:</label>
			<textarea id="diagnostico" name="diagnostico" rows="10" cols="80"><?php echo $crearPaciente["diagnostico"]; ?></textarea>
		</div>
		<div id="div_medicacion">
			<label for="medicacion" id="label_medicacion">Medicación del Paciente:</label>
			<input id="medicacion" name="medicacion" type="text" value="<?php echo $crearPaciente["medicacion"]; ?>"/>
		</div>
		<div id="div_fechaInclusion">
			<label for="fechaInclusion" id="label_fechaInclusion">Fecha Inclusión del Paciente (yyyy-mm-dd):</label>
			<input id="fechaInclusion" name="fechaInclusion" type="date" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"/>
		</div>
		<div id="div_idEnsayoClinico">
			<label for="idEnsayoClinico" id="label_idEnsayoClinico">ID Ensayo Clínico del Paciente:</label>
			<input id="idEnsayoClinico" name="idEnsayoClinico" type="text" value="<?php echo $crearPaciente["idEnsayoClinico"]; ?>"/>
		</div>
		<div id="div_submit">
			<input type="submit" value="Crear"></input>
		</div>
	</form>
	</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>
