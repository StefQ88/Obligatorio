<?php
    include_once "comun.php";
    include_once "class/SalaDeConferencias.php"

    if($_SERVER['REQUEST_METHOD']==='POST'){

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $capacidad = $_POST['capacidad'];
        $ubicacion = $_POST['ubicacion'];
        $equipamientoDisponible = isset($_POST['equipamientoDisponible']) ? $_POST['equipamientoDisponible'] : null; //si esta definido con valor asigno valor, de lo contrario null
        $estado = isset($_POST['estado']) ? $_POST['estado'] : null;
        $fotoSala = $_FILES['fotoSala'];

         //--------------------------------------
         //VALIDO DATOS

        if(SalaDeConferencias :: validarDatos($id,$nombre,$capacidad,$ubicacion,$fotoSala)){

            $nuevaSala = new SalaDeConferencias($id,$nombre,$capacidad,$equipamientoDisponible,$estado,$fotoSala);

            $fotoNombre = $_FILES['fotoSala']['name'];
            $fotoTmp = $_FILES['fotoSala']['tmp_name'];
            $fotoSize = $_FILES['fotoSala']['size'];
            $fotoError = $_FILES['fotoSala']['error'];

            //OBTENGO EXTENSION FOTO
            $fotoExt = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION)); 

            $formatosPermitidos = array('jpg','jpeg','png','gif');
            if (in_array($fotoExt, $formatosPermitidos) && $fotoError ===0){
                $fotoActual = 'uploads/' . uniqid('', true). '.'. $fotoExt;   //creo ruta para guardar archivo
            }




        } else {

        }

















    } 
?>
    
