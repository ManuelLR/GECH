<?php 
session_start(); 
unset($_SESSION["promotor"]);
unset($_SESSION["monitor"]);
unset($_SESSION["fecMon"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GECH</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
	</head>
	<body>
		<?php
		include_once ("../CabeceraGenerica.php");
		?>
		<div id="indiceInterno">
			<?php
			include_once ("promotores.html");
			?>
		</div>
		<?php
			include_once ("../Pie.php");
		?>
	</body>
</html>