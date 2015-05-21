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
	include_once("GestionarDB.php"); 
	include_once('/pacientes/GestionPacientes.php');
	$conexion=conectarBD();
modificarPaciente($conexion, 2, "pepe", "apel", "nuhsa", "nhc", "diagnostico", "medicacion", "10-05-2015", "idec");



?>
</body>
</html>