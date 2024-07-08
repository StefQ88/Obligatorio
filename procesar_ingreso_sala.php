<?php

include_once "comun.php";
include_once "class/SalaDeConferencias.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];
    $equipamientoDisponible = isset($_POST['equipamientoDisponible']) ? $_POST['equipamientoDisponible'] : null; //si esta definido con valor asigno valor, de lo contrario null
    $estado = isset($_POST['estado']) ? $_POST['estado'] : null;

    if (Sala::validarDatos($nombre, $capacidad, $ubicacion, $_FILES['foto']['name'])) {
        $fotoNombre = basename($_FILES['foto']['name']);
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $fotoSize = $_FILES['foto']['size'];
        $fotoError = $_FILES['foto']['error'];

        if ($fotoError === 0) {
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }

            $fotoExt = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION));
            $formatosPermitidos = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fotoExt, $formatosPermitidos)) {
                $fotoActual = 'uploads/' . uniqid('', true) . '_' . $fotoNombre;
                if (move_uploaded_file($fotoTmp, $fotoActual)) {

                    //---------------------------------------
                    //INSERTO EN LA BASE DE DATOS 
                    $sala->insertarSala($nombre, $capacidad, $ubicacion, $equipamientoDisponible, $estado, $fotoActual);
                    header('Location: index.php?exito=La sala fue registrada con éxito');
                    exit();
                } else {
                    header('Location: index.php?error=Error al mover el archivo de imagen.');
                    exit();
                }
            } else {
                header('Location: index.php?error=El formato de la foto no es válido.');
                exit();
            }
        } else {
            header('Location: index.php?error=Error en la subida de la imagen.');
            exit();
        }
    } else {
        header('Location: index.php?error=Faltan datos obligatorios.');
        exit();
    }
}
