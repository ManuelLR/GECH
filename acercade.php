<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Acerca de</title>
		<link type="text/css" rel="stylesheet" href="css/BaseDiseno.css">
	</head>
	<body>
	<?php include_once("CabeceraGenerica.php");?>
<div id="contenidoPag">
	<?php 
		if(isset($_SESSION['erroresIndex'])){
		 	$erroresIndex = $_SESSION['erroresIndex'];
			echo "<div id='muestraErrores'>";
			foreach($erroresIndex as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";	}
	?>
		<div id="presentacion">
		<h1>Gech.com</h1>
		Es una aplicación web desarrollada por Miguel Rodríguez Caballero y Manuel Francisco López Ruiz para la asignatura IISSI de la Universidad de Sevilla

		<br />
		<br />
		Email de Miguel Rodríguez Caballero: miguel.rc95@gmail.com
		<br />
		Email de Manuel Francisco López Ruiz: manloprui1@alum.us.es
	</div>
</div>
<?php 	include_once("Pie.php"); ?>
</body>
</html>
