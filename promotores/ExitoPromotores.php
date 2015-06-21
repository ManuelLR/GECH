<?php 
session_start();
include_once ("../GestionarDB.php");
include_once ('GestionPromotores.php');
if (isset($_SESSION["promotor"])) {
	$promotor = $_SESSION["promotor"];
	unset($_SESSION["promotor"]);
	unset($_SESSION["erroresCreaPromotores"]);
} else {
	$_SESSION["erroresCreaPromotores"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormPromotores.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Promotor</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
		<h3>Estado Registro del Promotor</h3>
<?php
$conexion=conectarBD();
if($promotor["accionPro"]=="insert"){
	
	if (insertarPromotor($promotor["nombre"], $promotor["cif"], $conexion)){
			$_SESSION["exitoModPromotores"]="El Promotor ". $promotor["nombre"] ." ha sido insertado correctamente.";
			header("Location: MuestraPromotores.php"); 
	}else{ 
		echo $_SESSION["errorDB"];
		?>
		<div id="div_errorRegistro">
			Lo sentimos, el Promotor <?php echo $promotor["nombre"]; ?>
			<b>NO</b> ha sido insertado.
		</div>
		</br> Para volver al formulario pincha <a href="FormPromotores.php">AQUÍ</a>
		</br> Para volver a la tabla pincha <a href="MuestraPromotores.php">AQUÍ</a><?php
		$_SESSION["promotor"] = $promotor;
	}
}elseif($promotor["accionPro"]=="update"){
		if(modificarPromotor($conexion, $promotor["ID_PRO"], $promotor["nombre"], $promotor["cif"])){

			$_SESSION["exitoModPromotores"]="El Promotor ". $promotor["nombre"] ." ha sido actualizado correctamente.";
			header("Location: MuestraPromotores.php");
		 }else{
		 echo $_SESSION["errorDB"];
		
		 	$promotor["accionPro"]="pre-update";
		 	$_SESSION["promotor"] = $promotor;
			?> <div id="div_errorRegistro">
				Lo sentimos, el Promotor <?php echo $promotor["nombre"]; ?>
				<b>NO</b> ha sido actualizado.
			</div><?php 		 	
			#$errores[]="El Promotor ". $promotor["nombre"] ." <b>NO</b> ha sido actualizado correctamente.";
			#$_SESSION["errorModPromotores"]=$errores;
			
			?></br> Para volver al formulario pincha <a href="FormPromotores.php">AQUÍ</a>
			</br> Para volver a la tabla pincha <a href="MuestraPromotores.php">AQUÍ</a><?php			
			#header("Location: MuestraPromotores.php");
		}
}
 elseif($promotor["accionPro"]=="remove"){
		 $_SESSION["promotor"] = $promotor;
		?> <div id="div_errorRegistro">
			Lo sentimos, el Promotor <?php echo $promotor["nombre"]; ?>
			<b>NO</b> ha sido eliminado debido a políticas del sistema.
		</div><?php  	
 		#$errores[]="El Promotor ". $promotor["nombre"] ." no se puede borrar debido a políticas del sistema";
		#$_SESSION["errorModPromotores"]=$errores;
		
		?></br> Para volver a la tabla pincha <a href="MuestraPromotores.php">AQUÍ</a><?php		
		#header("Location: MuestraPromotores.php");	
 }
		 
	desconectarDB($conexion);
		?>
</div>
		<?php 	include_once("../Pie.php");
		?>
	</body>
</html>

