<?php

function pacienteEnsayoEstado($conexion, $estadoEnsayo){
	$SQL = "SELECT P.ID_EC, NOMBRE, APELLIDOS FROM PACIENTE P, ENSAYO_CLINICO EC WHERE P.ID_EC = EC.ID_EC AND EC.SITUACION_ACTUAL ='".$estadoEnsayo."'";
	$stmt = $conexion ->query($SQL);	
	return $stmt;
}
function pacientesProxSemana($conexion){
	$SQL = "SELECT NOMBRE, APELLIDOS, FECHA, TIPO FROM PACIENTE P, FECHA_PACIENTE FP WHERE P.ID_PAC = FP.ID_PAC AND (FP.FECHA BETWEEN SYSDATE AND SYSDATE + 7)";
	$stmt = $conexion ->query($SQL);	
	return $stmt;
}
function farmacoPacienteEnsayo($conexion){
	$SQL = "SELECT NOMBRE, APELLIDOS, FARMACO FROM PACIENTE P, ENSAYO_CLINICO EC WHERE P.ID_EC = EC.ID_EC";
	$stmt = $conexion ->query($SQL);	
	return $stmt;
}
function monitoresProxSemana($conexion){
	$SQL = "SELECT NOMBRE, APELLIDOS, FECHA FROM MONITOR_ENSAYO ME, FECHA_MONITOR FM WHERE ME.ID_MON = FM.ID_MON AND (FM.FECHA BETWEEN SYSDATE AND SYSDATE + 7)";
	$stmt = $conexion ->query($SQL);	
	return $stmt;
}
function cuentaPacEnsayos($conexion){
	$SQL = "SELECT EC.ID_EC, COUNT(*) NUM_PACIENTES FROM PACIENTE P, ENSAYO_CLINICO EC  WHERE (P.ID_EC = EC.ID_EC) GROUP BY EC.ID_EC";
	$stmt = $conexion ->query($SQL);	
	return $stmt;
}














?>
