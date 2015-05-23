<?php 
session_start();
include_once ("../GestionarDB.php");
include_once ('GestionEnsayos.php');
if (isset($_SESSION["ensayo"])) {
	$ensayo = $_SESSION["ensayo"];
	unset($_SESSION["ensayo"]);
	unset($_SESSION["erroresCreaEnsayos"]);
} else {
	$_SESSION["erroresCreaEnsayos"] = "No se ha recibido ningun dato, por favor vuelve a introducirlos";
	Header("Location: FormEnsayos.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Resultado del Registro del Ensayo</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="../css/Formularios.css">
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
	<body>
		<h3>Estado Registro del Ensayo</h3>
<?php
$conexion=conectarBD();
if($ensayo["accionEc"]=="insert"){
	
	if (insertarEnsayo($ensayo["situacion_actual"], $ensayo["criterio_inc"], $ensayo["criterio_exc"], $ensayo["inicio_rec"],
       $ensayo["fin_rec"], $ensayo["farmaco"], $conexion)){
	?>
		<div id="div_exito">
			El ensayo ha sido insertado correctamente.
		</div>
	<?php 
	}else{ ?>
		<div id="div_errorRegistro">
			Lo sentimos, el ensayo 
			<b>NO</b> ha sido insertado.-
		</div>
		<?php
		$_SESSION["ensayo"] = $ensayo;
	}
		?> <div id="div_volver"> Para volver al formulario pulsa <a href="FormEnsayos.php">aquí</a>.</div>
<?php
}elseif($ensayo["accionEc"]=="update"){
		if(modificarEnsayo($conexion,$ensayo["ID_EC"], $ensayo["situacion_actual"], $ensayo["criterio_inc"], $ensayo["criterio_exc"], $ensayo["inicio_rec"],
			$ensayo["fin_rec"], $ensayo["farmaco"])){

			$_SESSION["exitoModEnsayos"]="El ensayo ha sido actualizado correctamente.";
			header("Location: MuestraEnsayos.php");
		 }else{ 
			$errores[]="El ensayo <b>NO</b> ha sido actualizado correctamente.";
			$_SESSION["errorModEnsayos"]=$errores;
			header("Location: MuestraEnsayos.php");
		}
}
 elseif($ensayo["accionEc"]=="remove"){
 		$errores[]="El ensayo no se puede borrar debido a políticas del sistema";
		$_SESSION["errorModEnsayos"]=$errores;
		header("Location: MuestraEnsayos.php");	
 }
		 
	desconectarDB($conexion);
		?>
		<?php 	include_once("../Pie.php");
		?>
	</body>
</html>

