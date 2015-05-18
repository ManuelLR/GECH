<?php
	#Esto ni está bien implementado ni funciona xD
	function creaTablaHtml($cabecera, $datos){
		$stmp = seleccionarPacientes($conexion);
		echo "<div id='tablamuestra'>";
		echo "<table>";
		echo "<tr>";
		echo "<th class='nombre'>Nombre</th>";
		echo "<th class='apellidos'>Apellidos</th>";
		echo "<th class='diagnostico'>Diagnostico</th>";
		echo "<th class='medicacion'>Medicación auxiliar</th>";
		echo "</tr>";
		foreach ($cabecera as $ccab) {
			echo "<tr>";
			echo "<td class='nombre'>".$fila["NOMBRE"]."</td>";
			echo "<td class='apellidos'>".$fila["APELLIDOS"]."</td>";
			echo "<td class='diagnostico'>".$fila["DIAGNOSTICO"]."</td>";
			echo "<td class='medicacion'>".$fila["MEDICACION_AUX"]."</td>";
			echo "</tr>";
		}
		echo "</table></div>";

	}
	
	
?>