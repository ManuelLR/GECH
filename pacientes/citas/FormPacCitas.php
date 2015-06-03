<?php
	session_start();
	if(!isset($_SESSION["paciente"]) and !isset($_SESSION["citaPac"])){
		$errores[]="Debes seleccionar un paciente antes de añadirle una cita";
		$_SESSION["errorModPacientes"]=$errores;		
		header("Location: ../MuestraPacientes.php");
	}else{
		if(isset($_SESSION["paciente"])){
			$paciente=$_SESSION["paciente"];}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Citas</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="ValidacionPacCita.js"></script>
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Citas</h3>
	<?php 
		if(isset($_SESSION['erroresCreaPacCitas'])){
		 	$erroresCreaPacCitas = $_SESSION['erroresCreaPacCitas'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaPacCitas as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaPacCitas"]);
		}
	?>
	<form method="post" action="
	<?php 
		if (isset($_REQUEST["unset"])){
			unset($_SESSION["citaPac"]);
			header("Location:FormPacCitas.php");
		}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
</br>
<?php	if(isset($_SESSION["paciente"])){?>

	<h4>Cita para <?php echo $paciente["nombre"]." ".$paciente["apellidos"]. " (id:". $paciente["ID_PAC"].")";?></h4>
	<?php }?>
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["citaPac"])){
		$citaPac["ID_FECHA"]="";
		$citaPac["fecha"]="";
		$citaPac["tipo"]="";
		$citaPac["idPac"]=$paciente["ID_PAC"];
		$citaPac["accionCitaPac"]="insert";

		$_SESSION["citaPac"]=$citaPac;
	}else{
		$citaPac=$_SESSION["citaPac"];		
	}
	?>
	<div id="errores"></div>

<form action="ProcesaPacCita.php" onsubmit="return validaForm()">
		<input id="ID_FECHA" name="ID_FECHA" type="hidden" value="<?php echo $citaPac["ID_FECHA"]; ?>"/>
		<div id="div_fecha">
			<label for="fecha" id="label_fechaInclusion">Fecha Cita (yyyy-mm-dd):</label>
			<input id="fecha" name="fecha" type="date" value="<?php if($citaPac["fecha"]==""){echo date("Y-m-d");}else{
				if(strpos($citaPac["fecha"], "/") !== FALSE){
				$fecPreMod=split('/',$citaPac["fecha"]);
	echo '20'.$fecPreMod[2].'-'.$fecPreMod[1].'-'.$fecPreMod[0];
			} else{
				echo $citaPac["fecha"];
			}
			} ?>"/>
		</div>
		<div id="div_tipo">
			<label for="tipo" id="label_tipo">Tipo de cita:</label>
			<select id="tipo" name="tipo">
				<option>Revision</option>
                <option>Estudios_Complementarios</option>
			</select>		</div>
		<?php if($citaPac["accionCitaPac"]=="pre-update"){ 
				$citaPac["accionCitaPac"]="update";
				$_SESSION["citaPac"]=$citaPac;?>
		<input id="accionCitaPac" name="accionCitaPac" type="hidden" value="update"/>
		<div id="div_idpac">
			<label for="idPac" id="label_idPac">Identificador del paciente:</label>
			<input id="idPac" name="idPac" type="text" value="<?php echo trim($citaPac["idPac"]); ?>"/>
		</div>
		<div id="div_submit">
			<button type="submit" value="Actualizar">Actualizar</button>
		</div>			
		<?php }else{
			$citaPac["accionCitaPac"]="insert";
			$_SESSION["citaPac"]=$citaPac;	?>
		<input id="idPac" name="idPac" type="hidden" value="<?php echo trim($citaPac["idPac"]); ?>"/>
		<input id="accionCitaPac" name="accionCitaPac" type="hidden" value="insert"/>
		<div id="div_submit">
			<button type="submit" value="Insertar">Insertar</button>
		</div>
		<?php }?>
	</form>
	</div>

</div>
<?php
} include_once("../../Pie.php"); 
?>
</body>
</html>

