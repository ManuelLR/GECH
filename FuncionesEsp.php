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

?>