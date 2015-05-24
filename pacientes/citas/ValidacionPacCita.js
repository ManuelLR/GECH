/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("fecha")) {
		document.getElementById("errores").innerHTML+="<div id ='muestraErrores'><\div>";
		res = false;
	}


  	

  	if(compruebaVacio("fecha")) {
  		document.getElementById("label_fechaInclusion").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="La fecha de la cita no pueden estar vacía<br/>";
  	} else {
  		document.getElementById("label_fechaInclusion").style.color	= "black";
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

