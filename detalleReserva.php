<?php 
    include_once "comun.php";
    if ($_REQUEST['id']){
        $idSala = $_REQUEST['id'];
        echo "la sala es: $idSala";
        $sala->mostrarSala($idSala);
    }else{
        echo "Debe de seleccionar un código de Película para poder desplegar su información.";
    }  

?>