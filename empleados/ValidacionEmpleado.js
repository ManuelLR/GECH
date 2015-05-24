/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("nombre") || compruebaVacio("apellidos") || 
	compruebaVacio("dni") || compruebaVacio("telefono") || compruebaVacio("email") || !valida_DNI("dni") || !validar_email("email")) {
		document.getElementById("errores").innerHTML+="<div id ='muestraErrores'><\div>";
		res = false;
	}


  	/*if(compruebaVacio("dni") || compruebaVacio("letra")) {
  		document.getElementById("label_dni").style.color = "red";
  		document.getElementById("errores").innerHTML+="<p>Falta dni<\p>";
  	}*/

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
  	} else if (!valida_DNI("dni")) {
  		document.getElementById("label_dni").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El DNI es inválido<br/>";
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
  	} else if (!validar_email("email")) {
  		document.getElementById("label_email").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El email es inválido<br/>";
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


function valida_DNI(dni) {
	var numero, letra, letDNI;
	var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;
 
	dni = dni.toUpperCase();
 
	if(expresion_regular_dni.test(dni) === true){
		numero = dni.substr(0,dni.length-1);
		numero = numero.replace('X', 0);
		numero = numero.replace('Y', 1);
		numero = numero.replace('Z', 2);
		letDNI = dni.substr(dni.length-1, 1);
		numero = numero % 23;
		letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
		letra = letra.substring(numero, numero+1);
		if (letra != letDNI) {
			//alert('Dni erroneo, la letra del NIF no se corresponde');
			return false;
		}else{
			//alert('Dni correcto');
			return true;
		}
	}else{
		//alert('Dni erroneo, formato no válido');
		return false;
	}
}


function validar_email( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ) {
        return false;
     } else {
     	return true;
     }
}