<?php
	session_start();
/*	if(!isset($_SESSION["promotor"])){
		$errores[]="Debes seleccionar un paciente antes de añadirle una cita";
		$_SESSION["errorModPromotor"]=$errores;		
		header("Location: ../MuestraPromotores.php");
	}else{
		$promotor=$_SESSION["promotor"];*/
	require_once("../../GestionarDB.php"); 
	include_once ('../../eclinicos/GestionEnsayos.php');
	include_once ('../GestionPromotores.php');	
	require_once ("../../FuncionesEsp.php");
	$conexion = conectarBD(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Monitores</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="ValidacionMonitor.js"></script>
	</head><body>
	<?php include_once("../../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Monitores</h3>
	<?php 
		if(isset($_SESSION['erroresCreaMonitor'])){
		 	$erroresCreaMonitor = $_SESSION['erroresCreaMonitor'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaMonitor as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaMonitor"]);
		}
	?>
	<form method="post" action="
	<?php 
		if (isset($_REQUEST["unset"])){
			unset($_SESSION["monitor"]);
			header("Location:FormMonitor.php");
		}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
</br>
	<?php
	if(isset($_SESSION["promotor"])){
		$promotor=$_SESSION["promotor"];
?>	<h4> Monitor para el ensayo clínico <?php echo $promotor["nombre"];?></h4>

<?php	}else{
		$promotor["ID_PRO"]="";
	}
	if(isset($_SESSION["ensayo"])){
		$ensayo=$_SESSION["ensayo"];
#		$ensayo=$_SESSION["promotor"];
	}else{
		$ensayo["ID_EC"]="";
	} 
	if(!isset($_SESSION["monitor"])){
		$monitor["ID_MON"]="";
		$monitor["nombre"]="";
		$monitor["apellidos"]="";
		$monitor["telefono"]="";
		$monitor["email"]="";
		$monitor["idEc"]=$ensayo["ID_EC"];
		$monitor["idPro"]=$promotor["ID_PRO"];
		$monitor["accionMonitor"]="insert";

		$_SESSION["monitor"]=$monitor;
	}else{
		$monitor=$_SESSION["monitor"];		
	}

	?>
	<div name ="formulario" id="formulario">

	<div id="errores"></div>

<form action="ProcesaMonitor.php" onsubmit="return validaForm()">
		<input id="ID_MON" name="ID_MON" type="hidden" value="<?php echo $monitor["ID_MON"]; ?>"/>
		<div id="div_nombre">
			<label for="nombre" id="label_nombre">Nombre:</label>
			<input id="nombre" name="nombre" type="text" value="<?php echo $monitor["nombre"]; ?>"/>
		</div>		
		<div id="div_apellidos">
			<label for="apellidos" id="label_apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" value="<?php echo $monitor["apellidos"]; ?>"/>
		</div>

		<div id="div_telefono">
			<label for="telefono" id="label_telefono">Telefono:</label>
			<input id="telefono" name="telefono" type="text" value="<?php echo $monitor["telefono"]; ?>"/>
		</div>
		<div id="div_email">
			<label for="email" id="label_email">Email:</label>
			<input id="email" name="email" type="text" value="<?php echo $monitor["email"]; ?>"/>
		</div>
		<div id="div_idEc">
			<label for="idEc" id="label_idEc">Id Ec:</label>
			<select id="idEc" name="idEc">
	<?php
		muestraOpciones(seleccionarEnsayos($conexion), "ID_EC", "ID_EC",$monitor["idEc"]);?>
			</select>
		</div>
		<div id="div_idPro">
			<label for="idPro" id="label_idPro">IdPro:</label>
			<select id="idPro" name="idPro">
	<?php
		muestraOpciones(seleccionarPromotores($conexion), "NOMBRE_EMPRESA", "ID_PRO",$monitor["idPro"]);?>
			</select>				
		</div>

		<?php if($monitor["accionMonitor"]!="pre-update"){
			$monitor["accionMonitor"]="insert";
			$_SESSION["monitor"]=$monitor;	?>
		<input id="accionMonitor" name="accionMonitor" type="hidden" value="insert"/>

		<div id="div_submit">
			<button type="submit" value="Insertar">Insertar</button>
		</div>
		<?php }elseif($monitor["accionMonitor"]=="pre-update"){ 
				$monitor["accionMonitor"]="update";
				$_SESSION["monitor"]=$monitor;?>
		<input id="accionMonitor" name="accionMonitor" type="hidden" value="update"/>
		<div id="div_submit">
			<button type="submit" value="Actualizar">Actualizar</button>
		</div>			
		<?php }?>
	</form>
	</div>
</div>





</body>
</html>
<?php
/*} */include_once("../../Pie.php"); 
?>