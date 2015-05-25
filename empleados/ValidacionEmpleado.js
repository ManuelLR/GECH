/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("nombre") || compruebaVacio("apellidos") || 
	compruebaVacio("dni") || compruebaVacio("telefono") || compruebaVacio("email")) {
		document.getElementById("errores").innerHTML+="<div id ='muestraErrores'><\div>";
		res = false;
	}




  	if(compruebaVacio("nombre")) {
  		document.getElementById("label_nombre").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El nombre no puede estar vacío<br/>";

  	} else {
  		document.getElementById("label_nombre").style.color	= "black";
  	}

  	if(compruebaVacio("apellidos")) {
  		document.getElementById("label_apellidos").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="Los apellidos no pueden estar vacíos<br/>";
  	} else {
  		document.getElementById("label_apellidos").style.color	= "black";
  	}
  	if(compruebaVacio("dni")){
  		document.getElementById("label_dni").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El DNI no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_dni").style.color	= "black";
  	}
  	if(compruebaVacio("telefono")){
  		document.getElementById("label_telefono").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El teléfono no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_telefono").style.color	= "black";
  	}
  	if(compruebaVacio("email")){
  		document.getElementById("label_email").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El email no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_email").style.color	= "black";
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



