<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GECH</title>
		<link type="text/css" rel="stylesheet" href="/css/BaseDiseno.css">
	</head>
	<body>
		<?php
		include_once ("CabeceraGenerica.php");
		?>
<div id="contenidoPag">
		<h1>Todo Código SQL</h1>
		<div id="indiceInterno">
<textarea name="code" class="sql:nogutter"rows="50" cols="100">
<!--
	
DROP TABLE FECHA_PACIENTE;
/
DROP TABLE PACIENTE;
/
DROP TABLE TRABAJA_EN;
/
DROP TABLE EMPLEADO;
/
DROP TABLE FECHA_MONITOR;
/
DROP TABLE MONITOR_ENSAYO;
/
DROP TABLE PROMOTOR;
/
DROP TABLE ENSAYO_CLINICO;
/


CREATE TABLE ENSAYO_CLINICO
( "ID_EC" CHAR(5 BYTE) PRIMARY KEY,
  "SITUACION_ACTUAL" VARCHAR2(50 BYTE) NOT NULL,
  "CRITERIO_INC" VARCHAR2(100 BYTE),
  "CRITERIO_EXC" VARCHAR2(100 BYTE),
  "INICIO_REC" DATE,
  "FIN_REC" DATE,
  "FARMACO" VARCHAR2(50 BYTE),
  CONSTRAINT CHECK_FECHA_REC CHECK(INICIO_REC < FIN_REC),
  CONSTRAINT CHECK1 CHECK(SITUACION_ACTUAL IN('Pre_Evaluacion', 'Abierto', 'Cerrado')));
  /
  
  DROP SEQUENCE SEC_ID_EC;
  /
  CREATE SEQUENCE  SEC_ID_EC  MINVALUE 0 INCREMENT BY 1 START WITH 1;
  /
  
  CREATE OR REPLACE PROCEDURE CREA_ENSAYO
(w_SITUACION_ACTUAL IN ENSAYO_CLINICO.SITUACION_ACTUAL%TYPE,
 w_CRITERIO_INC IN ENSAYO_CLINICO.CRITERIO_INC%TYPE, 
 w_CRITERIO_EXC IN ENSAYO_CLINICO.CRITERIO_EXC%TYPE, 
 w_INICIO_REC IN ENSAYO_CLINICO.INICIO_REC%TYPE, 
 w_FIN_REC IN ENSAYO_CLINICO.FIN_REC%TYPE, 
 w_FARMACO IN ENSAYO_CLINICO.FARMACO%TYPE
 )IS
 BEGIN
	INSERT INTO ENSAYO_CLINICO(ID_EC, SITUACION_ACTUAL,CRITERIO_INC,CRITERIO_EXC, INICIO_REC, FIN_REC, FARMACO) 
	VALUES (SEC_ID_EC.NEXTVAL,w_SITUACION_ACTUAL,w_CRITERIO_INC,w_CRITERIO_EXC,
	w_INICIO_REC, w_FIN_REC, w_FARMACO);
	COMMIT WORK;
END CREA_ENSAYO;
/

 INSERT INTO ENSAYO_CLINICO VALUES ('1','Pre_Evaluacion','Enfermedad','Edad',to_date('01/01/2015','DD/MM/YYYY'),to_date('01/01/2016','DD/MM/YYYY'),'Pastillas');
  INSERT INTO ENSAYO_CLINICO VALUES ('2','Cerrado','Enfermedad','Edad',to_date('01/01/2000','DD/MM/YYYY'),to_date('01/01/2005','DD/MM/YYYY'),'Pastillas');
  INSERT INTO ENSAYO_CLINICO VALUES ('3','Abierto','Enfermedad','Edad',to_date('01/01/2000','DD/MM/YYYY'),to_date('01/01/2009','DD/MM/YYYY'),'Pastillas');

/

CREATE OR REPLACE PROCEDURE MODIFICAR_ENSAYO
(ID_EC_A_MOD IN ENSAYO_CLINICO.ID_EC%TYPE,
 SITUACION_ACTUAL_A_MOD IN ENSAYO_CLINICO.SITUACION_ACTUAL%TYPE,
 CRITERIO_INC_A_MOD IN ENSAYO_CLINICO.CRITERIO_INC%TYPE,
 CRITERIO_EXC_A_MOD IN ENSAYO_CLINICO.CRITERIO_EXC%TYPE,
 INICIO_REC_A_MOD IN ENSAYO_CLINICO.INICIO_REC%TYPE,
 FIN_REC_A_MOD IN ENSAYO_CLINICO.FIN_REC%TYPE,
 FARMACO_A_MOD IN ENSAYO_CLINICO.FARMACO%TYPE)  IS
BEGIN
  UPDATE ENSAYO_CLINICO
  SET SITUACION_ACTUAL=SITUACION_ACTUAL_A_MOD, CRITERIO_INC=CRITERIO_INC_A_MOD, 
	CRITERIO_EXC=CRITERIO_EXC_A_MOD, INICIO_REC=INICIO_REC_A_MOD, FIN_REC=FIN_REC_A_MOD,
	FARMACO=FARMACO_A_MOD
  WHERE ID_EC = ID_EC_A_MOD;
END MODIFICAR_ENSAYO;
/
CALL MODIFICAR_ENSAYO('1','Abierto','Enfermedad','Edad',to_date('01/01/2015','DD/MM/YYYY'),to_date('01/01/2016','DD/MM/YYYY'),'Pastillas');
/
CALL MODIFICAR_ENSAYO('1','Pre_Evaluacion','Enfermedad','Edad',to_date('01/01/2015','DD/MM/YYYY'),to_date('01/01/2016','DD/MM/YYYY'),'Pastillas');
/
COMMIT WORK;
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
  "ID_EC" CHAR(5 BYTE) NOT NULL,
  FOREIGN KEY(ID_EC) REFERENCES ENSAYO_CLINICO);
  
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
CREATE SEQUENCE  SEC_ID_PAC  MINVALUE 0 INCREMENT BY 1 START WITH 1;
/
CREATE OR REPLACE FUNCTION VALIDANIF ( 
ENTRADA IN VARCHAR2)
RETURN BOOLEAN AS
	letrasValidas CHAR(23) := 'TRWAGMYFPDXBNJZSQVHLCKE';
	letraCorrecta CHAR;
	valor INTEGER;
	longitud INTEGER;
	resto INTEGER;
	letraInput CHAR;
BEGIN
	SELECT LENGTH(ENTRADA) INTO longitud FROM DUAL;
	SELECT SUBSTR(ENTRADA,0, longitud - 1) INTO valor FROM DUAL;
	SELECT SUBSTR(ENTRADA, longitud) INTO letraInput FROM DUAL;
	resto := valor MOD 23;
	SELECT SUBSTR(letrasValidas, resto+1, 1)INTO letraCorrecta FROM DUAL;
	IF (not((letraCorrecta = UPPER(letraInput)) AND (longitud=9)))
		THEN return(FALSE);
	ELSE
		return(TRUE);
	END IF;
END VALIDANIF;
/
CREATE OR REPLACE FUNCTION VALIDANHC ( 
ENTRADA IN VARCHAR2)
RETURN BOOLEAN AS
	valor INTEGER;
	longitud INTEGER;
BEGIN
	SELECT LENGTH(ENTRADA) INTO longitud FROM DUAL;
	SELECT TO_NUMBER(ENTRADA) INTO valor FROM DUAL;
	IF (not(((valor>=0) AND (valor<=9999999)) AND (longitud=7)))
		THEN return(FALSE);
	ELSE
		return(TRUE);
	END IF;
END VALIDANHC; 
/
CREATE OR REPLACE FUNCTION VALIDANUHSA ( 
ENTRADA IN VARCHAR2)
RETURN BOOLEAN AS
	valor INTEGER;
	longitud INTEGER;
	letraInput VARCHAR2(2 BYTE);
BEGIN
	SELECT LENGTH(ENTRADA) INTO longitud FROM DUAL;
	SELECT SUBSTR(ENTRADA,1, 2) INTO letraInput FROM DUAL;
	SELECT (SELECT TO_NUMBER(SUBSTR(ENTRADA, 3)) FROM DUAL) INTO valor FROM DUAL;
	IF NOT(((valor>=0)AND (valor<=9999999999)) AND(longitud=12))
		THEN return(FALSE);
	ELSE
		return(TRUE);
	END IF;
END VALIDANUHSA; 
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
  COMMIT WORK;
END MODIFICAR_PACIENTE;
/


CREATE TABLE FECHA_PACIENTE
( "ID_FECHA" CHAR(5 BYTE) PRIMARY KEY,
  "FECHA" DATE NOT NULL,
  "TIPO" VARCHAR2(30 BYTE) NOT NULL,
  "ID_PAC" CHAR(5 BYTE) NOT NULL,
  FOREIGN KEY (ID_PAC) REFERENCES PACIENTE,
  CONSTRAINT CHECK_FECHA CHECK(TIPO IN('Revision', 'Estudios_Complementarios')));

/

DROP SEQUENCE SEC_ID_FECHA;
/
CREATE SEQUENCE  SEC_ID_FECHA  MINVALUE 0 INCREMENT BY 1 START WITH 1;
/


CREATE OR REPLACE PROCEDURE CREA_FECHA_PACIENTE
(w_FECHA IN FECHA_PACIENTE.FECHA%TYPE,
 w_TIPO IN FECHA_PACIENTE.TIPO%TYPE, 	
 w_ID_PAC IN FECHA_PACIENTE.ID_PAC%TYPE
)IS
 BEGIN
	INSERT INTO FECHA_PACIENTE(ID_FECHA, FECHA, TIPO, ID_PAC) 
	VALUES (SEC_ID_FECHA.NEXTVAL , w_FECHA, w_TIPO, w_ID_PAC);
	COMMIT WORK;
END CREA_FECHA_PACIENTE;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_FECHA_PACIENTE
(ID_FECHA_A_MOD IN FECHA_PACIENTE.ID_FECHA%TYPE,
 FECHA_A_MOD IN FECHA_PACIENTE.FECHA%TYPE,
 TIPO_A_MOD IN FECHA_PACIENTE.TIPO%TYPE,
 ID_PAC_A_MOD IN FECHA_PACIENTE.ID_PAC%TYPE)  IS
BEGIN
  UPDATE FECHA_PACIENTE
  SET FECHA=FECHA_A_MOD, TIPO=TIPO_A_MOD, 
	ID_PAC=ID_PAC_A_MOD
  WHERE ID_FECHA = ID_FECHA_A_MOD;
  COMMIT WORK;
END MODIFICAR_FECHA_PACIENTE;
/
CREATE TABLE PROMOTOR
  ( "ID_PRO" CHAR(5 BYTE) PRIMARY KEY,
    "NOMBRE_EMPRESA" VARCHAR2(30 BYTE) NOT NULL,
    "CIF" CHAR(9 BYTE) NOT NULL UNIQUE);
    /
    
    
    DROP SEQUENCE SEC_ID_PRO;
    
    /
    
    CREATE SEQUENCE  SEC_ID_PRO  MINVALUE 0 INCREMENT BY 1 START WITH 1;
    
    /
    
    
    
    CREATE OR REPLACE PROCEDURE CREA_PROMOTOR
(w_NOMBRE_EMPRESA IN PROMOTOR.NOMBRE_EMPRESA%TYPE, 
 w_CIF IN PROMOTOR.CIF%TYPE
 )IS
 BEGIN
	INSERT INTO PROMOTOR(ID_PRO, NOMBRE_EMPRESA, CIF) 
	VALUES (SEC_ID_PRO.NEXTVAL,w_NOMBRE_EMPRESA , w_CIF);
	COMMIT WORK;
END CREA_PROMOTOR;
/

CALL CREA_PROMOTOR('AENA','A12345678');
    
    /
    
    
    
    
    
  CREATE OR REPLACE PROCEDURE MODIFICAR_PROMOTOR
(ID_PRO_A_MOD IN PROMOTOR.ID_PRO%TYPE,
 NOMBRE_A_MOD IN PROMOTOR.NOMBRE_EMPRESA%TYPE,
 CIF_A_MOD IN PROMOTOR.CIF%TYPE)  IS
BEGIN
  UPDATE PROMOTOR
  SET NOMBRE_EMPRESA=NOMBRE_A_MOD, CIF=CIF_A_MOD, 
	ID_PRO=ID_PRO_A_MOD
  WHERE ID_PRO = ID_PRO_A_MOD;
  COMMIT WORK;
END MODIFICAR_PROMOTOR;
/


CREATE TABLE MONITOR_ENSAYO
( "ID_MON" CHAR(5 BYTE) PRIMARY KEY,
  "NOMBRE" VARCHAR2(20 BYTE) NOT NULL,
  "APELLIDOS" VARCHAR2(20 BYTE) NOT NULL,
  "TELEFONO" NUMBER(9),
  "EMAIL" VARCHAR2(20 BYTE),
  "ID_EC" CHAR(5 BYTE),
  "ID_PRO" CHAR(5 BYTE),
  FOREIGN KEY(ID_EC) REFERENCES ENSAYO_CLINICO,
  FOREIGN KEY(ID_PRO) REFERENCES PROMOTOR);
 /
 DROP SEQUENCE SEC_ID_MON;
/
CREATE SEQUENCE  SEC_ID_MON  MINVALUE 0 INCREMENT BY 1 START WITH 1;
/
CREATE OR REPLACE PROCEDURE CREA_MONITOR_ENSAYO
(w_NOMBRE IN MONITOR_ENSAYO.NOMBRE%TYPE, 
 w_APELLIDOS IN MONITOR_ENSAYO.APELLIDOS%TYPE,
 w_TELEFONO IN MONITOR_ENSAYO.TELEFONO%TYPE,
 w_EMAIL IN MONITOR_ENSAYO.EMAIL%TYPE,
 w_ID_EC IN MONITOR_ENSAYO.ID_EC%TYPE,
 w_ID_PRO IN MONITOR_ENSAYO.ID_PRO%TYPE
 )IS
 BEGIN
	INSERT INTO MONITOR_ENSAYO(ID_MON, NOMBRE, APELLIDOS, TELEFONO, EMAIL, ID_EC, ID_PRO) 
	VALUES (SEC_ID_MON.NEXTVAL, w_NOMBRE, w_APELLIDOS, w_TELEFONO, w_EMAIL, w_ID_EC, w_ID_PRO);
	COMMIT WORK;
END CREA_MONITOR_ENSAYO;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_MONITOR_ENSAYO
(ID_MON_A_MOD IN MONITOR_ENSAYO.ID_MON%TYPE,
NOMBRE_A_MOD IN MONITOR_ENSAYO.NOMBRE%TYPE, 
 APELLIDOS_A_MOD IN MONITOR_ENSAYO.APELLIDOS%TYPE,
 TELEFONO_A_MOD IN MONITOR_ENSAYO.TELEFONO%TYPE,
 EMAIL_A_MOD IN MONITOR_ENSAYO.EMAIL%TYPE,
 ID_EC_A_MOD IN MONITOR_ENSAYO.ID_EC%TYPE,
 ID_PRO_A_MOD IN MONITOR_ENSAYO.ID_PRO%TYPE
 )IS
 BEGIN
	UPDATE MONITOR_ENSAYO
	SET NOMBRE=NOMBRE_A_MOD, APELLIDOS=APELLIDOS_A_MOD,
	 TELEFONO=TELEFONO_A_MOD, EMAIL=EMAIL_A_MOD, ID_EC=ID_EC_A_MOD,
	 ID_PRO=ID_PRO_A_MOD
	WHERE  ID_MON=ID_MON_A_MOD;
	COMMIT WORK;
END MODIFICAR_MONITOR_ENSAYO;
/


CREATE TABLE FECHA_MONITOR
( "FECHA" DATE NOT NULL,
  "ID_MON" CHAR(5 BYTE),
  PRIMARY KEY(FECHA, ID_MON),
  FOREIGN KEY(ID_MON) REFERENCES MONITOR_ENSAYO);
/
CREATE OR REPLACE PROCEDURE CREA_FECHA_MONITOR
(w_FECHA IN FECHA_MONITOR.FECHA%TYPE,
 w_ID_MON IN FECHA_MONITOR.ID_MON%TYPE
)IS
 BEGIN
	INSERT INTO FECHA_MONITOR(FECHA, ID_MON) 
	VALUES (w_FECHA, w_ID_MON);
	COMMIT WORK;
END CREA_FECHA_MONITOR;
/


CREATE TABLE EMPLEADO
( "ID_EMP" CHAR(5 BYTE) PRIMARY KEY,
  "NOMBRE" VARCHAR2(20 BYTE) NOT NULL,
  "APELLIDOS" VARCHAR2(20 BYTE) NOT NULL,
  "DNI" CHAR(9 BYTE) NOT NULL UNIQUE,
  "TELEFONO" NUMBER(9),
  "EMAIL" VARCHAR2(20 BYTE));
/

DROP SEQUENCE SEC_ID_EMP;
/
CREATE SEQUENCE  SEC_ID_EMP  MINVALUE 0 INCREMENT BY 1 START WITH 1;
/
CREATE OR REPLACE PROCEDURE CREA_EMPLEADO
(w_NOMBRE IN EMPLEADO.NOMBRE%TYPE,
 w_APELLIDOS IN EMPLEADO.APELLIDOS%TYPE, 
 w_DNI IN EMPLEADO.DNI%TYPE,
 w_TELEFONO IN EMPLEADO.TELEFONO%TYPE, 
 w_EMAIL IN EMPLEADO.EMAIL%TYPE
 )IS
 BEGIN
	INSERT INTO EMPLEADO(ID_EMP, NOMBRE, APELLIDOS, DNI, TELEFONO, EMAIL) 
	VALUES (SEC_ID_EMP.NEXTVAL , w_NOMBRE, w_APELLIDOS, w_DNI, w_TELEFONO, w_EMAIL);
	COMMIT WORK;
END CREA_EMPLEADO;
/
  CREATE OR REPLACE PROCEDURE MODIFICAR_EMPLEADO
(ID_EMP_A_MOD IN EMPLEADO.ID_EMP%TYPE,
 NOMBRE_A_MOD IN EMPLEADO.NOMBRE%TYPE,
 APELLIDOS_A_MOD IN EMPLEADO.APELLIDOS%TYPE,
 DNI_A_MOD IN EMPLEADO.DNI%TYPE,
 TELEFONO_A_MOD IN EMPLEADO.TELEFONO%TYPE,
 EMAIL_A_MOD IN EMPLEADO.EMAIL%TYPE)  IS
BEGIN
  UPDATE EMPLEADO
  SET NOMBRE=NOMBRE_A_MOD, APELLIDOS=APELLIDOS_A_MOD, DNI=DNI_A_MOD, TELEFONO=TELEFONO_A_MOD, EMAIL=EMAIL_A_MOD,
	ID_EMP=ID_EMP_A_MOD
  WHERE ID_EMP = ID_EMP_A_MOD;
  COMMIT WORK;
END MODIFICAR_EMPLEADO;

/


CREATE TABLE TRABAJA_EN
( "ID_EC" CHAR(5 BYTE) REFERENCES ENSAYO_CLINICO,
  "ID_EMP" CHAR(5 BYTE) REFERENCES EMPLEADO,
  "CARGO" VARCHAR2(50 BYTE) NOT NULL,
  PRIMARY KEY(ID_EC, ID_EMP),
  CONSTRAINT CHECK_TRABAJA_EN CHECK(CARGO IN('Investigador_Principal', 'Sub_Investigador', 'Data_Manager', 'Responsable_Farmacia', 'Enfermeria')));
/

CREATE OR REPLACE PROCEDURE CREA_TRABAJA_EN
(w_ID_EC IN TRABAJA_EN.ID_EC%TYPE,
 w_ID_EMP IN TRABAJA_EN.ID_EMP%TYPE,
 w_CARGO IN TRABAJA_EN.CARGO%TYPE

)IS
 BEGIN
	INSERT INTO TRABAJA_EN(ID_EC, ID_EMP, CARGO) 
	VALUES (w_ID_EC, w_ID_EMP, w_CARGO);
	COMMIT WORK;
END CREA_TRABAJA_EN;
/

CREATE OR REPLACE PROCEDURE MODIFICAR_TRABAJA_EN
(ID_EC_A_MOD IN TRABAJA_EN.ID_EC%TYPE,
 ID_EMP_A_MOD IN TRABAJA_EN.ID_EMP%TYPE,
 CARGO_A_MOD IN TRABAJA_EN.CARGO%TYPE)  IS
BEGIN
  UPDATE TRABAJA_EN
  SET ID_EC=ID_EC_A_MOD, ID_EMP=ID_EMP_A_MOD, 
	CARGO=CARGO_A_MOD
  WHERE ID_EC = ID_EC_A_MOD AND ID_EMP = ID_EMP_A_MOD;
  COMMIT WORK;
END MODIFICAR_TRABAJA_EN;
/


	
-->
</textarea>
			
		</div>
</div>

		<?php 	include_once("Pie.php");
		?>
	</body>
</html>