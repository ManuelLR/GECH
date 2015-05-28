<?php 
session_start();
require_once ("../GestionarDB.php");
$conexion = conectarBD();
include_once 'GestionConEsp.php';
#unset($_SESSION["promotor"]);
#$_SESSION["paciente"]=" ";
if(isset($_SESSION["pacEnsEst"])){
	if($_SESSION["pacEnsEst"]!=""){
		$pacEnsEst=$_SESSION["pacEnsEst"];
	}else{
		$pacEnsEst="Abierto";
	}
}else{
	$pacEnsEst="Abierto";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Muestra ConEsp</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Tablas.css">  
	</head>
	<?php
		include_once ("../CabeceraGenerica.php");
	?>
<div id="contenidoPag">
	<h3>Mostrar los pacientes en función del estado de su ensayo</h3>

<body>
	<form method="post" action="
		<?php 
		if (isset($_REQUEST["new"])){
			$pacEnsEst=$_REQUEST["situacion"];
			$_SESSION["pacEnsEst"]=$pacEnsEst;
			header("Location:PacienteEnsayoEstado.php");
		}?>">
		<label for="situacion" id="label_situacion_actual">Situación del ensayo a mostrar:</label>
			<select id="situacion" name="situacion">
				<option><?php echo $pacEnsEst; ?></option>
				<option> </option>
                <option>Abierto</option>
                <option>Pre_Evaluacion</option>
                <option>Cerrado</option>
			</select>
		<button id="new" name="new" type="submit" class="Limpiar formulario">
		Actualizar</button>
	</form>
	</br>		
	<div id='tablamuestra'>
		<table>
			<tr><th>ID Ensayo</th><th>Nombre del Paciente</th><th>Apellidos del Paciente</th></tr>
		<?php 
			$stmp = pacienteEnsayoEstado($conexion, $pacEnsEst);
			foreach($stmp as $fila) {
		?>
		<tr>
		<div class="pacEnsEst">		
			<td><?php echo $fila["ID_EC"]?></td>
			<td><?php echo $fila["NOMBRE"]?></td>
			<td><?php echo $fila["APELLIDOS"]?></td>
		</div></tr>
<?php } ?>
		</table>
		
	</div>
</div>
<?php
		include_once ("../Pie.php");
desconectarDB($conexion);
 ?>
</body>
</html>