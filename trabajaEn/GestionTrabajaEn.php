<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarTrabajaEn($ID_EC, $ID_EMP, $cargo, $conexion) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_TRABAJA_EN(:ID_EC,
			 :ID_EMP, :CARGO)");
		$stmt -> bindParam(':ID_EC', $ID_EC);
		$stmt -> bindParam(':ID_EMP', $ID_EMP);
		$stmt -> bindParam(':CARGO', $cargo);

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

function seleccionarTrabajaEn($conexion) {
	$SQL = "SELECT * FROM TRABAJA_EN";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}

function modificarTrabajaEn($conexion, $ID_EC, $ID_EMP, $cargo) {
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_TRABAJA_EN(:ID_EC, :ID_EMP, :CARGO)');
		$stmt->bindParam(':ID_EC', $ID_EC);
		$stmt->bindParam(':ID_EMP',$ID_EMP);
		$stmt->bindParam(':CARGO',$cargo);
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