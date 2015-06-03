<?php
	session_start();
	require_once("../GestionarDB.php"); 
	include_once ('../eclinicos/GestionEnsayos.php');
	require_once ("../FuncionesEsp.php");
	$conexion = conectarBD(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Pacientes</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">  
		<script src="validacionPaciente.js"></script>
		<!--<script src="../FuncionesEsp.php"></script>-->
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Pacientes</h3>
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
<form method="post" action="
	<?php if (isset($_REQUEST["unset"])){
		unset($_SESSION["paciente"]);
		header("Location:FormPacientes.php");}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
	</br>	
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["paciente"])){
		$paciente["ID_PAC"]="";
		$paciente["nombre"]="";
		$paciente["apellidos"]="";
		$paciente["nuhsa"]="";
		$paciente["nhc"]="";
		$paciente["diagnostico"]="";
		$paciente["medicacion"]="";
		$paciente["fechaInclusion"]="";
		$paciente["idEnsayoClinico"]="";
		$paciente["accionPac"]="insert";
		$_SESSION["paciente"]=$paciente;
	}else{
		$paciente=$_SESSION["paciente"];		
		$_SESSION["paciente"]=$paciente;
	}
	?>

	<div id="errores"></div>

	<form action="ProcesaPaciente.php" onsubmit="return validaForm()">
		<input id="ID_PAC" name="ID_PAC" type="hidden" value="<?php echo $paciente["ID_PAC"]; ?>"/>

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
			<input id="nuhsa" name="nuhsa" type="text" value="<?php echo trim($paciente["nuhsa"]); ?>"/>
		</div>
		<div id="div_nhc">
			<label for="nhc" id="label_nhc">NHC del Paciente:</label>
			<input id="nhc" name="nhc" type="text" value="<?php echo trim($paciente["nhc"]); ?>"/>
		</div>
		<div id="div_diagnostico">
			<label for="diagnostico" id="label_diagnostico">Diagnóstico del Paciente:</label>
			<textarea id="diagnostico" name="diagnostico" rows="10" cols="80"><?php echo $paciente["diagnostico"]; ?></textarea>
		</div>
		<div id="div_medicacion">
			<label for="medicacion" id="label_medicacion">Medicación del Paciente:</label>
			<input id="medicacion" name="medicacion" type="text" value="<?php echo $paciente["medicacion"]; ?>"/>
		</div>
		<div id="div_fechaInclusion">
			<label for="fechaInclusion" id="label_fechaInclusion">Fecha Inclusión del Paciente (yyyy-mm-dd):</label>
			<input id="fechaInclusion" name="fechaInclusion" type="date" max="<?php echo date("Y-m-d");?>" value="<?php if($paciente["fechaInclusion"]==""){echo date("Y-m-d");}else{
				if(strpos($paciente["fechaInclusion"], "/") !== FALSE){
				$fecPreMod=split('/',$paciente["fechaInclusion"]);
	echo '20'.$fecPreMod[2].'-'.$fecPreMod[1].'-'.$fecPreMod[0];
			} else{
				echo $paciente["fechaInclusion"];
			}
			}
			?>"/>
		</div>
		<?php 
		$optd=seleccionarEnsayos($conexion);
		?>
		<div id="div_idEnsayoClinico">
			<label for="idEnsayoClinico" id="label_idEnsayoClinico">ID Ensayo Clínico del Paciente:</label>
			<select id="idEnsayoClinico" name="idEnsayoClinico">
		<?php
		muestraOpciones($optd, "ID_EC", "ID_EC",$paciente["idEnsayoClinico"]);?>
			</select>		
		</div>
		<?php if($paciente["accionPac"]!="pre-update"){
			$paciente["accionPac"]="insert";

			?>
		<input id="accionPac" name="accionPac" type="hidden" value="insert"/>

		<div id="div_submit">
			<button type="submit" value="Insertar">Insertar</button>
		</div>
		<?php }elseif($paciente["accionPac"]=="pre-update"){ 
				$paciente["accionPac"]="update";?>
		<input id="accionPac" name="accionPac" type="hidden" value="update"/>
		
		<div id="div_submit">
			<button type="submit" value="Actualizar">Actualizar</button>
		</div>			
		<?php }?>
		<input id="accionPac" name="accionPac" type="hidden" value="<?php echo $paciente["accionPac"]; ?>"/>

	</form>
	</div>
</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>