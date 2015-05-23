<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarMonitores($conexion, $nombre, $apellidos, $telefono, $email, $idec, $idpro) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_MONITOR(:NOMBRE,
			 :APELLIDOS, :TELEFONO, :EMAIL, :ID_EC, :ID_PRO)");
		$stmt -> bindParam(':NOMBRE', $nombre);
		$stmt -> bindParam(':APELLIDOS', $apellidos);
		$stmt -> bindParam(':TELEFONO', $telefono);
		$stmt -> bindParam(':EMAIL', $email);
		$stmt -> bindParam(':ID_EC', $idec);
		$stmt -> bindParam(':ID_PRO', $idpro);
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
function seleccionarMonitores($conexion) {
	$SQL = "SELECT * FROM MONITOR_ENSAYO";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}function seleccionarMonitorUno($conexion, $paciente) {
	$erroresCreaPacCitas[]="El método seleccionarMonitorUno no está implementado";
 	$_SESSION['errorModMonitor']=$erroresCreaPacCitas;

	return seleccionarMonitores($conexion);
}
function modificarMonitores($conexion, $IDMON, $nombre, $apellidos, $telefono, $email, $idec, $idpro) {
	try{
		$stmt=$conexion->prepare("CALL MODIFICAR_MONITOR_ENSAYO(:OID_MON, :NOMBRE,
			 :APELLIDOS, :TELEFONO, :EMAIL, :ID_EC, :ID_PRO)");
		$stmt->bindParam(':OID_MON', $IDMON);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->bindParam(':APELLIDOS',$apellidos);
		$stmt->bindParam(':TELEFONO',$telefono);
		$stmt->bindParam(':EMAIL',$email);
		$stmt->bindParam(':ID_EC',$idec);
		$stmt->bindParam(':ID_PRO',$idpro);
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

function eliminaMonitores($conexion,$oidfecha){
	$erroresCreaPacCitas[]="El método eliminaPacCitas no está implementado";
 	$_SESSION['errorModPacCita']=$erroresCreaPacCitas;
	return true;
}
?>