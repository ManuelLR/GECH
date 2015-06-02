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
		<title>Formulario Promotores</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="validacionPromotor.js"></script>
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
<div id="contenidoPag">
	<h3>Formulario Promotores</h3>
	<?php 
		if(isset($_SESSION['erroresCreaPromotores'])){
		 	$erroresCreaPromotores = $_SESSION['erroresCreaPromotores'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaPromotores as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaPromotores"]);
		}
	?>
<form method="post" action="
	<?php if (isset($_REQUEST["unset"])){
		unset($_SESSION["promotor"]);
		header("Location:FormPromotores.php");}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
	</br>	
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["promotor"])){
		$promotor["ID_PRO"]="";
		$promotor["nombre"]="";
		$promotor["cif"]="";
		$promotor["accionPro"]="insert";
		$_SESSION["promotor"]=$promotor;
	}else{
		$promotor=$_SESSION["promotor"];		
		$_SESSION["promotor"]=$promotor;
	}
	?>

	<div id="errores"></div>

	<form action="ProcesaPromotor.php" onsubmit="return validaForm()">
		<input id="ID_PRO" name="ID_PRO" type="hidden" value="<?php echo $promotor["ID_PRO"]; ?>"/>

		<div id="div_nombre">
			<label for="nombre" id="label_nombre">Nombre de la Empresa:</label>
			<input id="nombre" name="nombre" type="text" value="<?php echo $promotor["nombre"]; ?>"/>
		</div>
		<div id="div_cif">
			<label for="cif" id="label_cif">CIF de la Empresa:</label>
			<input id="cif" name="cif" type="text" value="<?php echo $promotor["cif"]; ?>"/>
		</div>
		<?php if($promotor["accionPro"]!="pre-update"){
			$promotor["accionPro"]="insert";

			?>
		<input id="accionPro" name="accionPro" type="hidden" value="insert"/>

		<div id="div_submit">
			<button type="submit" value="Insertar">Insertar</button>
		</div>
		<?php }elseif($promotor["accionPro"]=="pre-update"){ 
				$promotor["accionPro"]="update";?>
		<input id="accionPro" name="accionPro" type="hidden" value="update"/>
		
		<div id="div_submit">
			<button type="submit" value="Actualizar">Actualizar</button>
		</div>			
		<?php }?>
		<input id="accionPro" name="accionPro" type="hidden" value="<?php echo $promotor["accionPro"]; ?>"/>

	</form>
	</div>
	</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>