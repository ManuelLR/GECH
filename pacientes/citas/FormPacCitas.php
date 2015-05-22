<?php
	session_start();
	if(!isset($_SESSION["paciente"])){
		$errores[]="Debes seleccionar un paciente antes de añadirle una cita";
		$_SESSION["errorModPacientes"]=$errores;		
		header("Location: ../MuestraPaciente.php");
	}else{
		$paciente=$_SESSION["paciente"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Citas</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="validacionPaciente.js"></script>
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
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
			header("Location:FormPacPacientes.php");
		}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
	<h4>Cita para <?php echo $paciente["nombre"]." ".$paciente["apellidos"]. "(". $paciente["ID_PAC"].")";?></h4>
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

<form action="ProcesaPacCitas.php" onsubmit="return validaForm()">
		<input id="ID_FECHA" name="ID_FECHA" type="hidden" value="<?php echo $citaPac["ID_FECHA"]; ?>"/>
		<div id="div_fecha">
			<label for="fecha" id="label_fechaInclusion">Fecha Cita (yyyy-mm-dd):</label>
			<input id="fecha" name="fecha" type="date" value="<?php if($citaPac["fecha"]==""){echo date("Y-m-d");}else{echo $citaPac["fecha"];} ?>"/>
		</div>
		<div id="div_nombre">
			<label for="nombre" id="label_nombre">Nombre del Paciente:</label>
			<input id="nombre" name="nombre" type="text" value="<?php echo $paciente["nombre"]; ?>"/>
		</div>
		<div id="div_apellidos">
			<label for="apellidos" id="label_apellidos">Apellidos del Paciente:</label>
			<input id="apellidos" name="apellidos" type="text" value="<?php echo $paciente["apellidos"]; ?>"/>
		</div>
		<div id="div_nuhsa">
			<label for="nuhsa" id="label_nuhsa">NUHSA del Paciente:</label>
			<input id="nuhsa" name="nuhsa" type="text" value="<?php echo $paciente["nuhsa"]; ?>"/>
		</div>
		<div id="div_nhc">
			<label for="nhc" id="label_nhc">NHC del Paciente:</label>
			<input id="nhc" name="nhc" type="text" value="<?php echo $paciente["nhc"]; ?>"/>
		</div>
		<div id="div_diagnostico">
			<label for="diagnostico" id="label_diagnostico">Diagnóstico del Paciente:</label>
			<textarea id="diagnostico" name="diagnostico" rows="10" cols="80"><?php echo $paciente["diagnostico"]; ?></textarea>
		</div>
		<div id="div_medicacion">
			<label for="medicacion" id="label_medicacion">Medicación del Paciente:</label>
			<input id="medicacion" name="medicacion" type="text" value="<?php echo $paciente["medicacion"]; ?>"/>
		</div>

		<div id="div_idEnsayoClinico">
			<label for="idEnsayoClinico" id="label_idEnsayoClinico">ID Ensayo Clínico del Paciente:</label>
			<input id="idEnsayoClinico" name="idEnsayoClinico" type="text" value="<?php echo $paciente["idEnsayoClinico"]; ?>"/>
		</div>
		<?php if($paciente["accionPac"]!="pre-update"){
			$paciente["accionPac"]="insert";

			?>
		<input id="accionPac" name="accionPac" type="hidden" value="insert"/>

		<div id="div_submit">
			<input type="submit" value="Insertar"></input>
		</div>
		<?php }elseif($paciente["accionPac"]=="pre-update"){ 
				$paciente["accionPac"]="update";?>
		<input id="accionPac" name="accionPac" type="hidden" value="update"/>
		
		<div id="div_submit">
			<input type="submit" value="Actualizar"></input>
		</div>			
		<?php }?>
		<input id="accionPac" name="accionPac" type="hidden" value="<?php echo $paciente["accionPac"]; ?>"/>

	</form>
	</div>


<?php
} include_once("../../Pie.php"); 
?>
</body>
</html>

