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
	$SQL = "SELECT * FROM PACIENTE P,FECHA_PACIENTE FP WHERE FP.ID_PAC=P.ID_PAC";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}function seleccionarPacCitasUno($conexion, $paciente) {
	$SQL ="SELECT * FROM PACIENTE P,FECHA_PACIENTE FP WHERE FP.ID_PAC=P.ID_PAC AND P.ID_PAC=".$paciente["ID_PAC"];
	$stmt = $conexion -> query($SQL);
	return $stmt;
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
	$result=false;
	$sql="DELETE FROM FECHA_PACIENTE WHERE ID_PAC=".$oidfecha."";
	try{
		$conexion -> query($sql);
		$conexion -> query("COMMIT WORK");
		#$stmt -> execute();
		# DELETE FROM FECHA_MONITOR WHERE FECHA=to_date(".$fecha.",yyyy-mm-dd') AND ID_MON=".$idMon
		$result=true;	
	}catch (PDOException $e){
		$insertar=false;
		echo "<div id='muestraErrores'>";
		echo "<div class='error'>";
		echo "<b>ERROR: </b>" . $e -> GetMessage();
		echo "</div>";
		echo "</div>";		
	}
	return $result;
}
?>