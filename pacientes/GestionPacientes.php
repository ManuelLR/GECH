<?php
	//basarse en la práctica 6 -> GestionarEntradas.php
	function insertarPaciente($nombre, $apellidos, $nuhsa, $nhc, $diagnostico, $medicacion, $fechaInclusion, $idEnsayoClinico, $conexion){
		$result=true;
		try{
			$stmt = $conexion->prepare("CALL CREA_PACIENTE(:NOMBRE,
			 :APELLIDOS, :NUHSA, :NHC, :DIAGNOSTICO, :MEDICACION_AUX,
			 to_date(:FECHA_INCLUSION,'yyyy-mm-dd'), :ID_EC)");
			$stmt->bindParam(':NOMBRE',$nombre);
			$stmt->bindParam(':APELLIDOS',$apellidos);
			$stmt->bindParam(':NUHSA',$nuhsa);
			$stmt->bindParam(':NHC',$nhc);
			$stmt->bindParam(':DIAGNOSTICO',$diagnostico);
			$stmt->bindParam(':MEDICACION_AUX',$medicacion);
			$stmt->bindParam(':FECHA_INCLUSION',$fechaInclusion);
			$stmt->bindParam(':ID_EC',$idEnsayoClinico);
			
			$stmt->execute();
		}catch(PDOException $e){
			//Tratamiento del error
			$result=false;
			echo "<div id='muestraErrores'>";
			echo "<div class='error'>";
			echo "<b>ERROR: </b>" . $e->GetMessage();
			echo "</div>";
			echo "</div>";
		}
		return $result;
	}
	function seleccionarPacientes($conexion){
  	$SQL = "SELECT * FROM PACIENTE";
	$stmt = $conexion -> query($SQL);
	return $stmt;
  }

?>