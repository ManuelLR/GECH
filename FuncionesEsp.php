<?php
function muestraOpciones($listaOpciones,$opcionMostrar,$opcionSeleccionar, $idOpcionSeleccionada){
$result="";
	foreach($listaOpciones as $op){
		#echo $op[$opcionMostrar];
		if(trim($idOpcionSeleccionada) != trim($op[$opcionSeleccionar])){
			$result=$result."<option value=\"".trim($op[$opcionSeleccionar])."\">".$op[$opcionMostrar]."</option>";
		}else{
			echo "<option value=\"".trim($op[$opcionSeleccionar])."\">".$op[$opcionMostrar]."</option>";
		}   
	}
echo $result;	
}
function muestraDosOpciones($listaOpciones,$opcionMostrar1, $opcionMostrar2, $separaOpciones, $opcionSeleccionar, $idOpcionSeleccionada){
$result="";
	foreach($listaOpciones as $op){
		#echo $op[$opcionMostrar];
		$actual=$op[$opcionMostrar1].$separaOpciones.$op[$opcionMostrar2];
		if(trim($idOpcionSeleccionada) != trim($op[$opcionSeleccionar])){
			$result=$result."<option value=\"".trim($op[$opcionSeleccionar])."\">".$actual."</option>";
		}else{
			echo "<option value=\"".trim($op[$opcionSeleccionar])."\">".$actual."</option>";
		}   
	}
echo $result;	
}
?>