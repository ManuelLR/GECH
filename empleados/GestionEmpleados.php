<?php
//basarse en la práctica 6 -> GestionarEntradas.php
function insertarEmpleado($nombre, $apellidos, $dni, $telefono, $email, $conexion) {
	$result = true;
	try {
		$stmt = $conexion -> prepare("CALL CREA_EMPLEADO(:NOMBRE,
			 :APELLIDOS, :DNI, :TELEFONO, :EMAIL)");
		$stmt -> bindParam(':NOMBRE', $nombre);
		$stmt -> bindParam(':APELLIDOS', $apellidos);
		$stmt -> bindParam(':DNI', $dni);
		$stmt -> bindParam(':TELEFONO', $telefono);
		$stmt -> bindParam(':EMAIL', $email);

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

function seleccionarEmpleados($conexion) {
	$SQL = "SELECT * FROM EMPLEADO";
	$stmt = $conexion -> query($SQL);
	return $stmt;
}

function modificarEmpleado($conexion, $OidEmpleado, $nombre, $apellidos, $dni, $telefono, $email) {
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_EMPLEADO(:OidEmpleado,:nombre, :apellidos, :dni, :telefono, :email)');
		$stmt->bindParam(':OidEmpleado', $OidEmpleado);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':dni',$dni);
		$stmt->bindParam(':telefono',$telefono);
		$stmt->bindParam(':email',$email);

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