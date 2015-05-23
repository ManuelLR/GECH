<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarEnsayo($situacion_actual, $criterio_inc, $criterio_exc, $inicio_rec, $fin_rec, $farmaco, $conexion) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_ENSAYO(:SITUACION_ACTUAL,
			 :CRITERIO_INC, :CRITERIO_EXC, to_date(:INICIO_REC, 'yyyy-mm-dd'), to_date(:FIN_REC, 'yyyy-mm-dd'), :FARMACO)");
		$stmt -> bindParam(':SITUACION_ACTUAL', $situacion_actual);
		$stmt -> bindParam(':CRITERIO_INC', $criterio_inc);
		$stmt -> bindParam(':CRITERIO_EXC', $criterio_exc);
		$stmt -> bindParam(':INICIO_REC', $inicio_rec);
		$stmt -> bindParam(':FIN_REC', $fin_rec);
		$stmt -> bindParam(':FARMACO', $farmaco);


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

/*function modificarEnsayo($conexion, $OidEnsayo, $situacion_actual, $criterio_inc, $criterio_exc, $inicio_rec, $fin_rec, $farmaco, $fechaInclusion, $idEnsayoClinico) {
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_ENSAYO(:OidEnsayo,:SITUACION_ACTUAL, :CRITERIO_INC, :CRITERIO_EXC, :INICIO_REC, :FIN_REC, :FARMACO)');
		$stmt->bindParam(':OidEnsayo', $OidEnsayo);
		$stmt->bindParam(':SITUACION_ACTUAL',$situacion_actual);
		$stmt->bindParam(':CRITERIO_INC',$criterio_inc);
		$stmt->bindParam(':CRITERIO_EXC',$criterio_exc);
		$stmt->bindParam(':INICIO_REC',$inicio_rec);
		$stmt->bindParam(':FIN_REC',$fin_rec);
		$stmt->bindParam(':FARMACO',$farmaco);

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
}*/
?>