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
		<script src="validacionEnsayo.js"></script>
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Ensayos</h3>
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
<form method="post" action="
	<?php if (isset($_REQUEST["unset"])){
		unset($_SESSION["ensayo"]);
		header("Location:FormEnsayos.php");}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
	</br>	
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["ensayo"])){
		$ensayo["ID_EC"]="";
		$ensayo["situacion_actual"]="";
		$ensayo["criterio_inc"]="";
		$ensayo["criterio_exc"]="";
		$ensayo["inicio_rec"]="";
		$ensayo["fin_rec"]="";
		$ensayo["farmaco"]="";
		$ensayo["accionEc"]="insert";
		$_SESSION["ensayo"]=$ensayo;
	}else{
		$ensayo=$_SESSION["ensayo"];		
		$_SESSION["ensayo"]=$ensayo;
	}
	?>

	<div id="errores"></div>

	<form action="ProcesaEnsayo.php" onsubmit="return validaForm()">
		<input id="ID_EC" name="ID_EC" type="hidden" value="<?php echo $ensayo["ID_EC"]; ?>"/>

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
			<textarea id="criterio_inc" name="criterio_inc" rows="10" cols="80"><?php echo $ensayo["criterio_inc"]; ?></textarea>
		</div>
		<div id="div_criterio_exc">
			<label for="criterio_exc" id="label_criterio_exc">Criterio de exclusión al Ensayo:</label>
			<textarea id="criterio_exc" name="criterio_exc" rows="10" cols="80"><?php echo $ensayo["criterio_exc"]; ?></textarea>
		</div>
		<div id="div_inicio_rec">
			<label for="inicio_rec" id="label_inicio_rec">Fecha inicio del Ensayo (yyyy-mm-dd):</label>
			<input id="inicio_rec" name="inicio_rec" type="date" value="<?php if($ensayo["inicio_rec"]==""){echo date("Y-m-d");}else{
				$fecPreMod=split('/',$ensayo["inicio_rec"]);
	echo '20'.$fecPreMod[2].'-'.$fecPreMod[1].'-'.$fecPreMod[0];
			};?>"/>
		</div>
		<div id="div_fin_rec">
			<label for="fin_rec" id="label_fin_rec">Fecha fin del Ensayo (yyyy-mm-dd):</label>
			<input id="fin_rec" name="fin_rec" type="date" value="<?php if($ensayo["fin_rec"]==""){echo date("Y-m-d");}else{
					$fecPreMod=split('/',$ensayo["fin_rec"]);
	echo '20'.$fecPreMod[2].'-'.$fecPreMod[1].'-'.$fecPreMod[0];};?>"/>
		</div>
		<div id="div_farmaco">
			<label for="farmaco" id="label_farmaco">Farmaco del Ensayo Clínico:</label>
			<input id="farmaco" name="farmaco" type="text" value="<?php echo $ensayo["farmaco"]; ?>"/>
		</div>
		<?php if($ensayo["accionEc"]!="pre-update"){
			$ensayo["accionEc"]="insert";

			?>
		<input id="accionEc" name="accionEc" type="hidden" value="insert"/>

		<div id="div_submit">
			<input type="submit" value="Insertar"></input>
		</div>
		<?php }elseif($ensayo["accionEc"]=="pre-update"){ 
				$ensayo["accionEc"]="update";?>
		<input id="accionEc" name="accionEc" type="hidden" value="update"/>
		
		<div id="div_submit">
			<input type="submit" value="Actualizar"></input>
		</div>			
		<?php }?>
		<input id="accionEc" name="accionEc" type="hidden" value="<?php echo $ensayo["accionEc"]; ?>"/>

	</form>
	</div>
</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>