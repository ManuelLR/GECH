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
function seleccionarPacientes($conexion) {
	$SQL = "SELECT * FROM PACIENTE";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}
function modificarPaciente($conexion, $OidPaciente, $nombre, $apellidos, $nuhsa, $nhc, $diagnostico, $medicacion, $fechaInclusion, $idEnsayoClinico) {
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_PACIENTE(:OidPaciente,:nombre, :apellidos, :nuhsa, :nhc, :diagnostco, :medicacion, :fechaInclusion, :idEnsayoClinico)');
		$stmt->bindParam(':OidPaciente', $OidPaciente);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':nuhsa',$nuhsa);
		$stmt->bindParam(':nhc',$nhc);
		$stmt->bindParam(':diagnostco',$diagnostico);
		$stmt->bindParam(':medicacion',$medicacion);
		$stmt->bindParam(':fechaInclusion',$fechaInclusion);
		$stmt->bindParam(':idEnsayoClinico',$idEnsayoClinico);
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
?>