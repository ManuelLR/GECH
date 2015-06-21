<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarPromotor($nombre, $cif, $conexion) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_PROMOTOR(:NOMBRE_EMPRESA,
			 :CIF)");
		$stmt -> bindParam(':NOMBRE_EMPRESA', $nombre);
		$stmt -> bindParam(':CIF', $cif);

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

function seleccionarPromotores($conexion) {
	$SQL = "SELECT * FROM PROMOTOR";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}

function modificarPromotor($conexion, $OidPromotor, $nombre, $cif) {
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_PROMOTOR(:OidPromotor,:nombre, :cif)');
		$stmt->bindParam(':OidPromotor', $OidPromotor);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':cif',$cif);
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