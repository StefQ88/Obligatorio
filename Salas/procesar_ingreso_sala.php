<?php

var_dump($_POST);
var_dump($_FILES);


include_once "../comun.php";
include_once "../class/SalaDeConferencias.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $equipamientoDisponible = isset($_POST['equipamientoDisponible']) ? $_POST['equipamientoDisponible'] : null; //si esta definido con valor asigno valor, de lo contrario null
    $estado = isset($_POST['estado']) ? $_POST['estado'] : null;


    //--------------------------------------
    //VALIDO DATOS

    if (!empty($nombre) && !empty($capacidad) && !empty($ubicacion) && isset($_FILES['foto'])) {
        $fotoNombre = $_FILES['foto']['name'];
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $fotoSize = $_FILES['foto']['size'];
        $fotoError = $_FILES['foto']['error'];

        /// Validar y mover archivo
        if ($fotoError === 0) {
            $fotoActual = 'uploads/' . uniqid('', true) . '_' . $fotoNombre;
            if (move_uploaded_file($fotoTmp, $fotoActual)) {
                // Instanciar y guardar la Sala
                $sala = new sala(null, $nombre, $capacidad, $ubicacion, $equipamientoDisponible, $estado, $fotoActual);

                if ($sala->insertarSala()) {
                    header('Location: administrar_salas.php?exito=La sala fue registrada con éxito');
                    exit();
                } else {
                    header('Location: ingresar_sala.php?error=Error al ingresar la sala.');
                    exit();
                }
            } else {
                header('Location: ingresar_sala.php?error=Error al mover el archivo de imagen.');
                exit();
            }
        } else {
            header('Location: ingresar_sala.php?error=Error en la subida de la imagen.');
            exit();
        }
    } else {
        header('Location: ingresar_sala.php?error=Faltan datos obligatorios.');
        exit();
    }
}
