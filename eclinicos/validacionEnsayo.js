/**
 * @author HP
 */
function validaForm() {
	var res = true;
	document.getElementById("errores").innerHTML="";
	
	if(compruebaVacio("criterio_inc") || compruebaVacio("criterio_exc") || 
	compruebaVacio("inicio_rec") || compruebaVacio("fin_rec") || compruebaVacio("farmaco")) {
		document.getElementById("errores").innerHTML+="<div id ='muestraErrores'><\div>";
		res = false;
	}



  	if(compruebaVacio("criterio_inc")) {
  		document.getElementById("label_criterio_inc").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El Criterio de inclusión no puede estar vacío<br/>";

  	} else {
  		document.getElementById("label_criterio_inc").style.color	= "black";
  	}

  	if(compruebaVacio("criterio_exc")) {
  		document.getElementById("label_criterio_exc").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El Criterio de exclusión no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_criterio_exc").style.color	= "black";
  	}
  	if(compruebaVacio("inicio_rec")){
  		document.getElementById("label_inicio_rec").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El inicio de reclutamiento no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_inicio_rec").style.color	= "black";
  	}
  	if(compruebaVacio("fin_rec")){
  		document.getElementById("label_fin_rec").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El fin de reclutamiento no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_fin_rec").style.color	= "black";
  	}
  	if(compruebaVacio("farmaco")){
  		document.getElementById("label_farmaco").style.color = "red";
  		document.getElementById("muestraErrores").innerHTML+="El Fármaco no puede estar vacío<br/>";
  	} else {
  		document.getElementById("label_farmaco").style.color	= "black";
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