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
		<title>Crear nueva entrada</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
		<link type="text/css" rel="stylesheet" href="/css/Formularios.css">  
		<script src="validacionTrabajaEn.js"></script>
	</head><body>
	<?php include_once("../CabeceraGenerica.php");?>
	<h3>Formulario Trabaja En</h3>
	<?php 
		if(isset($_SESSION['erroresCreaTrabajaEn'])){
		 	$erroresCreaTrabajaEn = $_SESSION['erroresCreaTrabajaEn'];
			echo "<div id='muestraErrores'>";
			foreach($erroresCreaTrabajaEn as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";
		unset($_SESSION["erroresCreaTrabajaEn"]);
		}
	?>
<form method="post" action="
	<?php if (isset($_REQUEST["unset"])){
		unset($_SESSION["trabajaEn"]);
		header("Location:FormTrabajaEn.php");}?>">
<button id="unset" name="unset" type="submit" class="Limpiar formulario">
Limpia contenido</button>
</form>
	</br>	
	<div name ="formulario" id="formulario">
	<?php	 
	if(!isset($_SESSION["trabajaEn"])){
		$trabajaEn["ID_EC"]="";
		$trabajaEn["ID_EMP"]="";
		$trabajaEn["cargo"]="";
		$trabajaEn["accionTraEn"]="insert";
		$_SESSION["trabajaEn"]=$trabajaEn;
	}else{
		$trabajaEn=$_SESSION["trabajaEn"];		
		$_SESSION["trabajaEn"]=$trabajaEn;
	}
	?>

	<div id="errores"></div>

	<form action="ProcesaTrabajaEn.php" onsubmit="return validaForm()">
		<div id="div_ID_EC">
			<label for="ID_EC" id="label_ID_EC">Numero del Ensayo Clínico:</label>
			<input id="ID_EC" name="ID_EC" type="text" value="<?php echo $trabajaEn["ID_EC"]; ?>"/>
		</div>
		

		<div id="div_ID_EMP">
			<label for="ID_EMP" id="label_ID_EMP">Identificado del empleado:</label>
			<input id="ID_EMP" name="ID_EMP" type="text" value="<?php echo $trabajaEn["ID_EMP"]; ?>"/>
		</div>
		<div id="div_cargo">
			<label for="cargo" id="label_cargo">Cargo del empleado en el Ensayo:</label>
			<select id="cargo" name="cargo">
				<option>Investigador_Principal</option>
                <option>Sub_Investigador</option>
                <option>Data_Manager</option>
                <option>Responsable_Farmacia</option>
                <option>Enfermeria</option>
			</select>
		</div>
		<?php if($trabajaEn["accionTraEn"]!="pre-update"){
			$trabajaEn["accionTraEn"]="insert";

			?>
		<input id="accionTraEn" name="accionTraEn" type="hidden" value="insert"/>

		<div id="div_submit">
			<input type="submit" value="Insertar"></input>
		</div>
		<?php }elseif($trabajaEn["accionTraEn"]=="pre-update"){ 
				$trabajaEn["accionTraEn"]="update";?>
		<input id="accionTraEn" name="accionTraEn" type="hidden" value="update"/>
		
		<div id="div_submit">
			<input type="submit" value="Actualizar"></input>
		</div>			
		<?php }?>
		<input id="accionTraEn" name="accionTraEn" type="hidden" value="<?php echo $trabajaEn["accionTraEn"]; ?>"/>

	</form>
	</div>
<?php 	include_once("../Pie.php"); ?>
</body>
</html>