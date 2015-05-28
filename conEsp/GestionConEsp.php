<?php

function functionOne($conexion, $estadoEnsayo){
	$SQL = "SELECT P.ID_EC, NOMBRE FROM PACIENTE P, ENSAYO_CLINICO EC WHERE P.ID_EC = EC.ID_EC AND EC.SITUACION_ACTUAL ='".$estadoEnsayo."'";
	$stmt = $conexion ->query($SQL);	
	return $stmt;
}















?>
