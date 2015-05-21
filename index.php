<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GECH</title>
		<link type="text/css" rel="stylesheet" href="css/BaseDiseno.css">
	</head>
	<body>
	<?php include_once("CabeceraGenerica.php");?>
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
		<h1>Migue puta</h1>
		?¿?¿?¿?¿
		Para más información consultar: <a href="/acercade.php"> acerca de</a>.
		<h2>Otra info interesante</h2>
		<a href="/mapa.php">Mapa de la web</a>		
	<br/>
	<br />
	Las páginas realizadas hasta ahora son:
	<ul>
	<li><a href="pacientes/FormCreaPacientes.php"> Formulario para Crear Pacientes</a>.(Codigo SQL para que funcione MODIFICADO <a href="/pacientes/CodigoSQLPacienteModificado.php"> aquí</a>)</li>
	</ul>
	</div>
<?php 	include_once("Pie.php"); ?>
</body>
</html>
