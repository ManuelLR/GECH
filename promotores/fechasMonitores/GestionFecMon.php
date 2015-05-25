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

function eliminaFecMon($conexion, $antiguo){
	$result=false;
	#$fecTrans=date("Y-m-d", $antiguo["fecha"]);
	$fecPreMod=split('/',$antiguo["fecha"]);
	$fecMod=$fecPreMod[2].'-'.$fecPreMod[1].'-'.$fecPreMod[0];
	$sql="DELETE FROM FECHA_MONITOR WHERE FECHA=to_date('".$fecMod."','yy-mm-dd') AND ID_MON=".$antiguo["idMon"]."";
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


function actualizaFecMon($conexion,$antiguo, $nuevo){
	$result=false;
	if(eliminaFecMon($conexion, $antiguo)){
			if(insertarFecMon($conexion, $nuevo["fecha"],$nuevo["idMon"])){
				$result=true;
			}else{
				if(insertarFecMon($conexion, $antiguo["fecha"],$antiguo["idMon"])){
				
				}else{
				echo "<div id='muestraErrores'>";
				echo "<div class='error'>";
				echo "<b>Por lo que NO se ha realizado el cambio y, además, se ha eliminado la cita que existía anteriormente</b>";
				echo "</div>";
				echo "</div>";					
				}
			}

	}
	return $result;
}
?>