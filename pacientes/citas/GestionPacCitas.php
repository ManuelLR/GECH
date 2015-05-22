<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarPacCitas($conexion, $fecha, $tipo, $idPac) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_FECHA_PACIENTE(to_date(:FECHA,'yyyy-mm-dd'),
			 :TIPO, :ID_PAC)");
		$stmt -> bindParam(':FECHA', $fecha);
		$stmt -> bindParam(':TIPO', $tipo);
		$stmt -> bindParam(':ID_PAC', $idPac);
		$stmt -> execute();
	} catch(PDOException $e) {
		//Tratamiento del error
		$result = false;
		echo "<div id='muestraErrores'>";
		echo "<div class='error'>";
		echo "<b>ERROR: </b>" . $e -> GetMessage();
		echo "</div>";
		echo "</div>";
	}
	return $result;
}
function seleccionarPacCitas($conexion) {
	$SQL = "SELECT * FROM FECHA_PACIENTE";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}function seleccionarPacCitasUno($conexion, $paciente) {
	$erroresCreaPacCitas[]="El método seleccionarPacCitasUno no está implementado";
 	$_SESSION['errorModPacCita']=$erroresCreaPacCitas;

	return seleccionarPacCitas($conexion);
}
function modificarPacCitas($conexion,$oidfecha, $fecha, $tipo, $idPac) {
	try{
		$stmt=$conexion->prepare("CALL MODIFICAR_FECHA_PACIENTE(:OID_FECHA, to_date(:FECHA,'yyyy-mm-dd'), :TIPO, :IDPAC)");
		$stmt->bindParam(':OID_FECHA', $oidfecha);
		$stmt->bindParam(':FECHA',$fecha);
		$stmt->bindParam(':TIPO',$tipo);
		$stmt->bindParam(':IDPAC',$idPac);
		$stmt->execute();
		return true;
	}catch(PDOException $e){
		echo "<div id='muestraErrores'>";
		echo "<div class='error'>";
		echo "<b>ERROR: </b>" . $e -> GetMessage();
		echo "</div>";
		echo "</div>";
		return false;		
	}
}

function eliminaPacCitas($conexion,$oidfecha){
	$erroresCreaPacCitas[]="El método eliminaPacCitas no está implementado";
 	$_SESSION['errorModPacCita']=$erroresCreaPacCitas;
	return true;
}
?>