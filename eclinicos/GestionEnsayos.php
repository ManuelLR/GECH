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
		$errorDB = "<div id='muestraErrores'>";	
		$errorDB = $errorDB . "<div class='error'>";
		$errorDB = $errorDB . "<b>ERROR: </b>" . $e -> GetMessage();
		$errorDB = $errorDB . "</div>";
		$errorDB = $errorDB . "</div>";
		$_SESSION["errorDB"] = $errorDB;
	}
	return $result;
}

function seleccionarEnsayos($conexion) {
	$SQL = "SELECT * FROM ENSAYO_CLINICO";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}

function modificarEnsayo($conexion, $OidEnsayo, $situacion_actual, $criterio_inc, $criterio_exc, $inicio_rec, $fin_rec, $farmaco) {
	try{
		$stmt=$conexion->prepare("CALL MODIFICAR_ENSAYO(:ID_EC, :SITUACION_ACTUAL,
			 :CRITERIO_INC, :CRITERIO_EXC, to_date(:INICIO_REC, 'yyyy-mm-dd'), to_date(:FIN_REC, 'yyyy-mm-dd'), :FARMACO)");
		$stmt->bindParam(':ID_EC', $OidEnsayo);
		$stmt -> bindParam(':SITUACION_ACTUAL', $situacion_actual);
		$stmt -> bindParam(':CRITERIO_INC', $criterio_inc);
		$stmt -> bindParam(':CRITERIO_EXC', $criterio_exc);
		$stmt -> bindParam(':INICIO_REC', $inicio_rec);
		$stmt -> bindParam(':FIN_REC', $fin_rec);
		$stmt -> bindParam(':FARMACO', $farmaco);

		$stmt->execute();
		return true;
	}catch(PDOException $e){
		$errorDB = "<div id='muestraErrores'>";	
		$errorDB = $errorDB . "<div class='error'>";
		$errorDB = $errorDB . "<b>ERROR: </b>" . $e -> GetMessage();
		$errorDB = $errorDB . "</div>";
		$errorDB = $errorDB . "</div>";
		$_SESSION["errorDB"] = $errorDB;
		return false;		
	}
}
?>