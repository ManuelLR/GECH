/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("nombre") || compruebaVacio("apellidos") || 
	compruebaVacio("nuhsa") || compruebaVacio("nhc") || compruebaVacio("fechaInclusion") || compruebaVacio("idEnsayoClinico")) {
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
  	if(compruebaVacio("nuhsa")){
  		document.getElementById("label_nuhsa").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El NUHSA no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_nuhsa").style.color	= "black";
  	}
  	if(compruebaVacio("nhc")){
  		document.getElementById("label_nhc").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El NHC no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_nhc").style.color	= "black";
  	}
  	if(compruebaVacio("fechaInclusion")){
  		document.getElementById("label_fechaInclusion").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="La fecha de inclusion no puede estar vacía<br/>";
  	} else {
  		document.getElementById("label_fechaInclusion").style.color	= "black";
  	}
  	if(compruebaVacio("idEnsayoClinico")){
  		document.getElementById("label_idEnsayoClinico").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El número del Ensayo Clínico no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_idEnsayoClinico").style.color	= "black";
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