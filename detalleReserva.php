<?php 
    include_once "comun.php";
    if ($_REQUEST['id']){
        $idSala = $_REQUEST['id'];
        echo "El código de su Película seleccionada es: $idSala";
        $sala->mostrarSala($idSala);
    }else{
        echo "Debe de seleccionar un código de Película para poder desplegar su información.";
    }  

?>