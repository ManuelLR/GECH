<?php
	session_start();
unset($_SESSION["ensayo"]);
unset($_SESSION["empleado"]);
unset($_SESSION["trabajaEn"]);
unset($_SESSION["paciente"]);
unset($_SESSION["citaPac"]);
unset($_SESSION["promotor"]);
unset($_SESSION["monitor"]);
unset($_SESSION["fecMon"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GECH</title>
		<link type="text/css" rel="stylesheet" href="css/BaseDiseno.css">
		<link rel="shortcut icon" href="/images/favicon.ico" />
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
		<h1>Breve Resumen</h1>
		GECH es una aplicación cuyo fin es el de gestionar los ensayos clínicos de un hospital (de ahí sus siglas) los cuales, hasta la fecha, se hacen de manera muy desordenada.
		Para más información consultar: <a href="/acercade.php"> acerca de</a>.
		<h2>Otra info interesante</h2>
		<a href="/mapa.php">Mapa de la web</a>		
	<br/>
	<br />
	
	</div>
</div>
<?php 	include_once("Pie.php"); ?>
</body>
</html>
