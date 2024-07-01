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

         //--------------------------------------
         //VALIDO DATOS

        if(SalaDeConferencias :: validarDatos($id,$nombre,$capacidad,$ubicacion,$fotoSala)){

            $fotoNombre = $_FILES['foto']['name'];
            $fotoTmp = $_FILES['foto']['tmp_name'];
            $fotoSize = $_FILES['foto']['size'];
            $fotoError = $_FILES['foto']['error'];

            //OBTENGO EXTENSION FOTO
            $fotoExt = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION)); 

            $formatosPermitidos = array('jpg','jpeg','png','gif');
            if (in_array($fotoExt, $formatosPermitidos) && $fotoError ===0){
                $fotoActual = 'uploads/' . uniqid('', true). '.'. $fotoExt;   //creo ruta para guardar archivo
                move_uploaded_file($fotoTmp, $fotoActual);
            } else {
                header ('Location: ingresar_salas.php?error=El formato de la foto no es válidoo hubo un error al subirla.');
                exit();
            } 

            $sala = new sala($id,$nombre,$capacidad,$ubicacion,$equipamientoDisponible,$estado,$foto);




            



       

















        }

    }    
?>
    
