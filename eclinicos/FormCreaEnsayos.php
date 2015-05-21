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
		<title>Crear nuevo Ensayo Clínico</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">  
		<!--<script src="validacionEnsayo.js"></script>-->
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
	<h3>Ensayo Clínico</h3>
	<?php 
		if(isset($_SESSION['erroresCreaEnsayos'])){
		 	$erroresCreaEnsayos = $_SESSION['erroresCreaEnsayos'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaEnsayos as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaEnsayos"]);
		}
	?>
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["crearEnsayo"])){
		$crearEnsayo["situacion_actual"]="";
		$crearEnsayo["criterio_inc"]="";
		$crearEnsayo["criterio_exc"]="";
		$crearEnsayo["inicio_rec"]="";
		$crearEnsayo["fin_rec"]="";
		$crearEnsayo["farmaco"]="";
		$_SESSION["crearEnsayo"]=$crearEnsayo;
	}
	else{
		$crearEnsayo=$_SESSION["crearEnsayo"];
	}
	?>

	<div id="errores"></div>
	

	<form action="TratamientoFormCrearEnsayos.php" onsubmit="return validaForm()">
		<div id="div_situacion_actual">
			<label for="situacion_actual" id="label_situacion_actual">Situación actual del Ensayo:</label>
			<select id="situacion_actual" name="situacion_actual">
				<option>Pre_Evaluacion</option>
                <option>Abierto</option>
                <option>Cerrado</option>
			</select>
		</div>
		<div id="div_criterio_inc">
			<label for="criterio_inc" id="label_criterio_inc">Criterio de inclusión al Ensayo:</label>
			<textarea id="criterio_inc" name="criterio_inc" rows="10" cols="80"><?php echo $crearEnsayo["criterio_inc"]; ?></textarea>
		</div>
		<div id="div_criterio_exc">
			<label for="criterio_exc" id="label_criterio_exc">Criterio de exclusión al Ensayo:</label>
			<textarea id="criterio_exc" name="criterio_exc" rows="10" cols="80"><?php echo $crearEnsayo["criterio_exc"]; ?></textarea>
		</div>
		<div id="div_inicio_rec">
			<label for="inicio_rec" id="label_inicio_rec">Fecha inicio del Ensayo (yyyy-mm-dd):</label>
			<input id="inicio_rec" name="inicio_rec" type="date" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"/>
		</div>
		<div id="div_fin_rec">
			<label for="fin_rec" id="label_fin_rec">Fecha fin del Ensayo (yyyy-mm-dd):</label>
			<input id="fin_rec" name="fin_rec" type="date" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"/>
		</div>
		<div id="div_farmaco">
			<label for="farmaco" id="label_farmaco">Farmaco del Ensayo Clínico:</label>
			<input id="farmaco" name="farmaco" type="text" value="<?php echo $crearEnsayo["farmaco"]; ?>"/>
		</div>
		<div id="div_submit">
			<input type="submit" value="Crear"></input>
		</div>
	</form>
	</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>
