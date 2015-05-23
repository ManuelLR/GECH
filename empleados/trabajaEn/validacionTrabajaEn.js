/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("ID_EC") || compruebaVacio("ID_EMP")) {
		document.getElementById("errores").innerHTML+="<div id ='muestraErrores'><\div>";
		res = false;
	}


	if(compruebaVacio("ID_EC")) {
  		document.getElementById("label_ID_EC").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El identificador del Ensayo Clínico no puede estar vacío<br/>";

  	} else {
  		document.getElementById("label_ID_EC").style.color	= "black";
  	}

  	if(compruebaVacio("ID_EMP")) {
  		document.getElementById("label_ID_EMP").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El identificador del empleado no puede estar vacío<br/>";

  	} else {
  		document.getElementById("label_ID_EMP").style.color	= "black";
  	}

  	
  	return res;
}





function compruebaVacio(element) {
	var res = false;
	if(document.getElementById(element).value == 0) {
		res = true;
	}
	return res;
}