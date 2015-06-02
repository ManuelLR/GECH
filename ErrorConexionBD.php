<?php 

session_start();
unset($_SESSION["paciente"]);
#$_SESSION["paciente"]=" ";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Error de conexión</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head>
	<?php
		include_once ("/CabeceraGenerica.php");
	?>
	<body>
<div id="contenidoPag">
	<h3>Errores base de datos</h3>
		<?php 
		if(isset($_SESSION['exitoConDB'])){
		 	$exitoPacientes = $_SESSION['exitoConDB'];
			echo "<div id='muestraExitos'>";
				print("<div class='error'>");
				print ("$exitoPacientes");
				print("</div>");
			echo "</div>";
		unset($_SESSION["exitoConDB"]);
		}
		if(isset($_SESSION['errorConDB'])){
		 	$errorPacientes = $_SESSION['errorConDB'];
			echo "<div id='muestraErrores'>";
			foreach($errorPacientes as $status){
				print("<div class='error'>");
				print("$status");
				#print ("$errorPacientes");
				print("</div>");
			}
			echo "</div>";
		unset($_SESSION["errorConDB"]);
		}
	?>

</div>

<?php
		include_once ("/Pie.php");
 ?>
</body>
</html>