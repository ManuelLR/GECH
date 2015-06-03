<?php
	session_start();
	require_once("../../GestionarDB.php"); 
	include_once ('../monitores/GestionMonitores.php');
	require_once ("../../FuncionesEsp.php");
	$conexion = conectarBD(); 
	if(!isset($_SESSION["monitor"])and !isset($_SESSION["fecMon"])){
		$errores[]="Debes seleccionar un monitor antes de añadirle una cita";
		$_SESSION["errorModMonitor"]=$errores;		
		header("Location: ../monitores/MuestraMonitor.php");
	}else{
		if(isset($_SESSION["monitor"])){
		$monitor=$_SESSION["monitor"];}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Fecha Monitores</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="ValidacionFechaMonitor.js"></script>
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Fecha Monitores</h3>
	<?php 
		if(isset($_SESSION['erroresCreaFecMon'])){
		 	$erroresCreaFecMon = $_SESSION['erroresCreaFecMon'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaFecMon as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaFecMon"]);
		}
	?>
	<form method="post" action="
	<?php 
		if (isset($_REQUEST["unset"])){
			unset($_SESSION["fecMon"]);
			header("Location:FormFecMon.php");
		}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
<?php	if(isset($_SESSION["monitor"])){?>
	<h4>Cita con el monitor: <?php echo $monitor["nombre"];?></h4>
<?php }?>

	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["fecMon"])){
		$fecMon["fecha"]="";
		$fecMon["idMon"]=$monitor["ID_MON"];
		$fecMon["accionFecMon"]="insert";

		$_SESSION["fecMon"]=$fecMon;
	}else{
		$fecMon=$_SESSION["fecMon"];		
	}
	?>
	<div id="errores"></div>

<form action="ProcesaFecMon.php" onsubmit="return validaForm()">
		<div id="div_fecha">
			<label for="fecha" id="label_fecha">Fecha Cita (yyyy-mm-dd):</label>
			<input id="fecha" name="fecha" type="date" value="<?php if($fecMon["fecha"]==""){echo date("Y-m-d");}else{
				if(strpos($fecMon["fecha"], "/") !== FALSE){					
				$fecPreMod=split('/',$fecMon["fecha"]);
	echo '20'.$fecPreMod[2].'-'.$fecPreMod[1].'-'.$fecPreMod[0];
			} else{
				echo $fecMon["fecha"];
			}
			} ?>"/>
		</div>
		<div id="div_idMon">
			<label for="idMon" id="label_idMon">Monitor:</label>
			<select id="idMon" name="idMon">
	<?php
		muestraOpciones(seleccionarMonitores($conexion), "NOMBRE", "ID_MON",$fecMon["idMon"]);?>
			</select>			
		</div>
		<?php if($fecMon["accionFecMon"]!="pre-update"){
			$fecMon["accionFecMon"]="insert";
			$_SESSION["fecMon"]=$fecMon;	?>
		<input id="accionFecMon" name="accionFecMon" type="hidden" value="insert"/>

		<div id="div_submit">
			<button type="submit" value="Insertar">Insertar</button>
		</div>
		<?php }elseif($fecMon["accionFecMon"]=="pre-update"){ 
				$fecMon["accionFecMon"]="update";
				$_SESSION["fecMon"]=$fecMon;?>
		<input id="accionFecMon" name="accionFecMon" type="hidden" value="update"/>
		<div id="div_submit">
			<button type="submit" value="Actualizar">Actualizar</button>
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

