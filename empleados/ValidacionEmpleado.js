/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("nombre") || compruebaVacio("apellidos") || 
	compruebaVacio("dni") || compruebaVacio("telefono") || compruebaVacio("email") || !nif("dni") || !telefono("telefono")) {
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
  	} else if(!nif("dni")) {
  		document.getElementById("label_dni").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El DNI no es válido<br/>";
  	} else {
  		document.getElementById("label_dni").style.color	= "black";
  	}
  	if(compruebaVacio("telefono")){
  		document.getElementById("label_telefono").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El teléfono no puede estar vacío<br/>";
  	} else if (!telefono("telefono")) {
  		document.getElementById("label_telefono").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El teléfono no es válido<br/>";
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




function nif(dniInput) {
  var dni = document.getElementById(dniInput).value.toUpperCase();
  var numero;
  var leta;
  var letra;
  var expresion_regular_dni;
  var res = true;
 
  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
 
  if(expresion_regular_dni.test (dni) == true){
     numero = dni.substr(0,dni.length-1);
     numero = parseInt(numero);
     leta = dni.substr(dni.length-1,1);
     numero = numero % 23;
     letra='TRWAGMYFPDXBNJZSQVHLCKET';
     letra=letra.substring(numero,numero+1);
    if (letra!=leta.toUpperCase()) {
       res = false;
     }
  }else{
     res = false;
   }
   return res;
}




function telefono(telInput) {
	var res = true;
	expresion_regular_telefono = /^\d{9}$/;
	var telefono = document.getElementById(telInput).value;
	if (!expresion_regular_telefono.test (telefono) == true) {
		res = false;
	}
	return res;
}

