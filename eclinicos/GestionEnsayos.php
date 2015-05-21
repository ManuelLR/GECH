<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarEnsayo($situacion_actual, $criterio_inc, $criterio_exc, $inicio_rec, $fin_rec, $farmaco, $conexion) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_ENSAYO(:situacion_actual,
			 :criterio_inc, :criterio_exc, to_date(:inicio_rec, 'yyyy-mm-dd'), to_date(:fin_rec, 'yyyy-mm-dd'), :farmaco)");
		$stmt -> bindParam(':situacion_actual', $situacion_actual);
		$stmt -> bindParam(':criterio_inc', $criterio_inc);
		$stmt -> bindParam(':criterio_exc', $criterio_exc);
		$stmt -> bindParam(':inicio_rec', $inicio_rec);
		$stmt -> bindParam(':fin_rec', $fin_rec);
		$stmt -> bindParam(':farmaco', $farmaco);

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

function seleccionarEnsayos($conexion) {
	$SQL = "SELECT * FROM ENSAYO_CLINICO";
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