<?php
	session_start();
	if(!isset($_SESSION["monitor"])){
		$errores[]="Debes seleccionar un monitor antes de añadirle una cita";
		$_SESSION["errorModMonitores"]=$errores;		
		header("Location: ../monitores/MuestraMonitor.php");
	}else{
		$monitor=$_SESSION["monitor"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Fecha Monitores</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="validacionmonitor.js"></script>
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
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
	<h4>Cita con el monitor: <?php echo $monitor["nombre"];?></h4>
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

<form action="ProcesaFecMon.php"> <!--onsubmit="return validaForm()">-->
		<div id="div_fecha">
			<label for="fecha" id="label_fechaInclusion">Fecha Cita (yyyy-mm-dd):</label>
			<input id="fecha" name="fecha" type="date" value="<?php if($fecMon["fecha"]==""){echo date("Y-m-d");}else{echo $fecMon["fecha"];} ?>"/>
		</div>
		<div id="div_idMon">
			<label for="idMon" id="label_fechaInclusion">ID Monitor:</label>
			<input id="idMon" name="idMon" type="text" value="<?php echo $fecMon["idMon"];?>"/>
		</div>
		<?php if($fecMon["accionFecMon"]!="pre-update"){
			$fecMon["accionFecMon"]="insert";
			$_SESSION["fecMon"]=$fecMon;	?>
		<input id="accionFecMon" name="accionFecMon" type="hidden" value="insert"/>

		<div id="div_submit">
			<input type="submit" value="Insertar"></input>
		</div>
		<?php }elseif($fecMon["accionFecMon"]=="pre-update"){ 
				$fecMon["accionFecMon"]="update";
				$_SESSION["fecMon"]=$fecMon;?>
		<input id="accionFecMon" name="accionFecMon" type="hidden" value="update"/>
		<div id="div_submit">
			<input type="submit" value="Actualizar"></input>
		</div>			
		<?php }?>
	</form>
	</div>


<?php
} include_once("../../Pie.php"); 
?>
</body>
</html>
