<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Crear nueva entrada</title>
		<link type="text/css" rel="stylesheet" href="../css/BaseDiseno.css">
	</head>
	<?php include_once("../CabeceraGenerica.php");?>

	<body>
<textarea name="code" class="sql:nogutter"rows="50" cols="100">
DROP TABLE PACIENTE;
/
CREATE TABLE PACIENTE
( "ID_PAC" CHAR(5 BYTE) PRIMARY KEY,
  "NOMBRE" VARCHAR2(35 BYTE) NOT NULL,
  "APELLIDOS" VARCHAR2(50 BYTE) NOT NULL,
  "NUHSA" CHAR(12 BYTE) NOT NULL UNIQUE, /*2 LETRAS Y 10 NUMEROS*/
  "NHC" CHAR(7 BYTE) NOT NULL UNIQUE, /* Nº HISTORIA CLINICA DIGITAL, 7 NUMEROS*/
  "DIAGNOSTICO" VARCHAR2(50 BYTE),
  "MEDICACION_AUX" VARCHAR2(30 BYTE),
  "FECHA_INCLUSION" DATE,
  "ID_EC" CHAR(5 BYTE) NOT NULL);
  
CREATE OR REPLACE TRIGGER PACIENTE_ELIMINA_ID_EC
    BEFORE UPDATE OR DELETE OF ID_EC ON PACIENTE
        FOR EACH ROW
BEGIN
	IF NOT(:NEW.ID_EC = :OLD.ID_EC)
     THEN raise_application_error(-20200,'No se puede modificar la pertenencia de un paciente a un ensayo clínico');
  	END IF;
END PACIENTE_ELIMINA_ID_EC;
/
ALTER TRIGGER PACIENTE_ELIMINA_ID_EC DISABLE;
/
DROP SEQUENCE SEC_ID_PAC;
/
CREATE SEQUENCE  SEC_ID_PAC  MINVALUE 0 INCREMENT BY 1 START WITH 0;
/
CREATE OR REPLACE PROCEDURE CREA_PACIENTE
(w_NOMBRE IN PACIENTE.NOMBRE%TYPE,
 w_APELLIDOS IN PACIENTE.APELLIDOS%TYPE, 
 w_NUHSA IN PACIENTE.NUHSA%TYPE,
 w_NHC IN PACIENTE.NHC%TYPE, 
 w_DIAGNOSTICO IN PACIENTE.DIAGNOSTICO%TYPE,
 w_MEDICACION_AUX IN PACIENTE.MEDICACION_AUX%TYPE, 
 w_FECHA_INCLUSION IN PACIENTE.FECHA_INCLUSION%TYPE,
 w_ID_EC IN PACIENTE.ID_EC%TYPE
 )IS
 BEGIN
	INSERT INTO PACIENTE(ID_PAC, NOMBRE, APELLIDOS, NUHSA, NHC, DIAGNOSTICO, MEDICACION_AUX, FECHA_INCLUSION, ID_EC) 
	VALUES (SEC_ID_PAC.NEXTVAL , w_NOMBRE, w_APELLIDOS, w_NUHSA, w_NHC, w_DIAGNOSTICO, w_MEDICACION_AUX, w_FECHA_INCLUSION, w_ID_EC);
	COMMIT WORK;
END CREA_PACIENTE;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_PACIENTE
(ID_PAC_A_MOD IN PACIENTE.ID_PAC%TYPE,
 NOMBRE_A_MOD IN PACIENTE.NOMBRE%TYPE,
 APELLIDOS_A_MOD IN PACIENTE.APELLIDOS%TYPE,
 NUHSA_A_MOD IN PACIENTE.NUHSA%TYPE,
 NHC_A_MOD IN PACIENTE.NHC%TYPE,
 DIAGNOSTICO_A_MOD IN PACIENTE.DIAGNOSTICO%TYPE,
 MEDICACION_AUX_A_MOD IN PACIENTE.MEDICACION_AUX%TYPE,
 FECHA_INCLUSION_A_MOD IN PACIENTE.FECHA_INCLUSION%TYPE,
 ID_EC_A_MOD IN PACIENTE.ID_EC%TYPE)  IS
BEGIN
  UPDATE PACIENTE
  SET NOMBRE=NOMBRE_A_MOD, APELLIDOS=APELLIDOS_A_MOD, 
	NUHSA=NUHSA_A_MOD, NHC=NHC_A_MOD, DIAGNOSTICO=DIAGNOSTICO_A_MOD,
	MEDICACION_AUX=MEDICACION_AUX_A_MOD, FECHA_INCLUSION=FECHA_INCLUSION_A_MOD,
	ID_EC=ID_EC_A_MOD
  WHERE ID_PAC = ID_PAC_A_MOD;
END MODIFICAR_PACIENTE;
/</textarea>
</body>
</html>