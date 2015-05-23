<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarFecMon($conexion, $fecha, $idMon) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_FECHA_MONITOR(to_date(:FECHA,'yyyy-mm-dd'),
			 :ID_MON)");
		$stmt -> bindParam(':FECHA', $fecha);
		$stmt -> bindParam(':ID_MON', $idMon);
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
function seleccionarFecMon($conexion) {
	$SQL = "SELECT * FROM FECHA_MONITOR";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}function seleccionarFecMonUno($conexion, $idMon) {
	$erroresCreaFecMon[]="El método seleccionarFecMonUno no está implementado";
 	$_SESSION['errorModFecMon']=$erroresCreaFecMon;

	return seleccionarFecMon($conexion);
}

function eliminaFecMon($conexion,$fecha, $idMon){
	$erroresCreaFecMon[]="El método eliminaFecMon no está implementado";
 	$_SESSION['errorModFecMon']=$erroresCreaFecMon;
	return true;
}
?>