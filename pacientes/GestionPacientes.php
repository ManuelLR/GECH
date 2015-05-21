<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarPaciente($nombre, $apellidos, $nuhsa, $nhc, $diagnostico, $medicacion, $fechaInclusion, $idEnsayoClinico, $conexion) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_PACIENTE(:NOMBRE,
			 :APELLIDOS, :NUHSA, :NHC, :DIAGNOSTICO, :MEDICACION_AUX,
			 to_date(:FECHA_INCLUSION,'yyyy-mm-dd'), :ID_EC)");
		$stmt -> bindParam(':NOMBRE', $nombre);
		$stmt -> bindParam(':APELLIDOS', $apellidos);
		$stmt -> bindParam(':NUHSA', $nuhsa);
		$stmt -> bindParam(':NHC', $nhc);
		$stmt -> bindParam(':DIAGNOSTICO', $diagnostico);
		$stmt -> bindParam(':MEDICACION_AUX', $medicacion);
		$stmt -> bindParam(':FECHA_INCLUSION', $fechaInclusion);
		$stmt -> bindParam(':ID_EC', $idEnsayoClinico);

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