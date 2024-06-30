<?php

function crearTabla(){
	echo "<table width='60%' align='center' border='1'>";
}

function cerrarTabla(){
	echo "</table>";
}

function crearCabezal(){
	
	$num_args = func_num_args();
	$lista_args = func_get_args();
	
	crearFila();
	for($i=0; $i < $num_args; $i++)
		echo "<th bgcolor='gray'>", $lista_args[$i], "</th>";
	cerrarFila();
}

function crearFila(){
	echo "<tr>";
}

function cerrarFila(){
	echo "</tr>";
}

function ingresarDatosFila($datos){
	crearFila();
	$num_args = func_num_args();
	$lista_args = func_get_args();
	for($i=0; $i < $num_args; $i++)
		echo "<td align='center'>", $lista_args[$i] ,"</td>";
	cerrarFila();
}

function ingresarDatosConFila(){
	crearFila();
	$num_args = func_num_args();
	$lista_args = func_get_args();
	for($i=0; $i < $num_args; $i++)
		echo "<td align='center'>", $lista_args[$i] ,"</td>";
	cerrarFila();
}

function ingresarDatos(){
	$num_args = func_num_args();
	$lista_args = func_get_args();
	for($i=0; $i < $num_args; $i++)
		echo "<td align='center'>", $lista_args[$i] ,"</td>";
}

?>