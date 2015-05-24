<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarMonitor($conexion, $nombre, $apellidos, $telefono, $email, $idec, $idpro) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_MONITOR_ENSAYO(:NOMBRE,
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
}function seleccionarMonitorUno($conexion, $promotor) {
	$SQL = "SELECT * FROM MONITOR_ENSAYO ME, PROMOTOR P WHERE ME.ID_PRO=P.ID_PRO AND ME.ID_PRO=".$promotor["ID_PRO"];
	$stmt = $conexion -> query($SQL);
	return $stmt;
	$erroresCreaPacCitas[]="El método seleccionarMonitorUno no está implementado";
 	$_SESSION['errorModMonitor']=$erroresCreaPacCitas;

	return seleccionarMonitores($conexion);
}
function modificarMonitor($conexion, $IDMON, $nombre, $apellidos, $telefono, $email, $idec, $idpro) {
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

function eliminaMonitor($conexion,$oidfecha){
	$erroresCreaPacCitas[]="El método eliminaPacCitas no está implementado";
 	$_SESSION['errorModMonitor']=$erroresCreaPacCitas;
	return true;
}
?>