/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("fecha") || compruebaVacio("idMon")) {
		document.getElementById("errores").innerHTML+="<div id ='muestraErrores'><\div>";
		res = false;
	}


  	

  	if(compruebaVacio("fecha")) {
  		document.getElementById("label_fecha").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="La fecha de la cita no pueden estar vacía<br/>";
  	} else {
  		document.getElementById("label_fecha").style.color	= "black";
  	}
  	if(compruebaVacio("idMon")){
  		document.getElementById("label_idMon").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El identificador del Monitor no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_idMon").style.color	= "black";
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

