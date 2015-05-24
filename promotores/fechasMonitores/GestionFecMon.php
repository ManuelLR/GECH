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
#	$SQL = "SELECT * FROM FECHA_MONITOR FM, MONITOR_ENSAYO M, PROMOTOR P WHERE FM.ID_MON=M.ID_MON";
	$SQL = "SELECT * FROM FECHA_MONITOR FM, MONITOR_ENSAYO M WHERE FM.ID_MON=M.ID_MON";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}function seleccionarFecMonUno($conexion, $monitor) {
#	$SQL = "SELECT * FROM FECHA_MONITOR FM, MONITOR_ENSAYO M, PROMOTOR P WHERE FM.ID_MON=M.ID_MON AND M.ID_MON=".$monitor["ID_MON"];
	$SQL = "SELECT * FROM FECHA_MONITOR FM, MONITOR_ENSAYO M WHERE FM.ID_MON=M.ID_MON AND M.ID_MON=".$monitor["ID_MON"];
	$stmt = $conexion -> query($SQL);
	return $stmt;
}

function eliminaFecMon($conexion,$fecha, $idMon){
	$result=true;
		$erroresCreaFecMon[]="El método eliminaFecMon no está implementado";
 		$_SESSION['errorModFecMon']=$erroresCreaFecMon;
 		$result=false;

	return $result;
}
?>