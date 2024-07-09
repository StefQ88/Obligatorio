<?php
include_once "comun.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $salaId = $_POST['sala'];
     $usuarioId = $_POST['usuario'];
     $fechaReserva = $_POST['fechaReserva'];
     $fechaInicio = $_POST['horaInicio'];
     $fechaFin = $_POST['horaFin'];

    if (empty($salaId)){
        header("Location: asignar_reservas.php?error=la sala es requerido");
         exit;
    }
    else if (empty($usuarioId)){
        header("Location: asignar_reservas.php?error=el usuario es requerido");
         exit;
    
    }
    else if (empty($fechaReserva)){
        header("Location: asignar_reservas.php?error=la fecha de la reserva es requerido");
         exit;

    }else if (empty($fechaInicio)){
        header("Location: asignar_reservas.php?error=la hora de inicio es requerido");
         exit;
    }
    else if (empty($fechaFin)){
        header("Location: asignar_reservas.php?error=la hora de fin es requerido");
         exit;
    }
     else{
        if ($dato->validarFechas($fechaInicio, $fechaFin)) {
     // if ($dato->verificarDisponibilidad($salaId, $fechaReserva,$fechaReserva,$fechaInicio, $fechaFin)) {
     $dato->crearReserva($salaId, $usuarioId, $fechaReserva, $fechaInicio, $fechaFin);
     header('Location: index.php?exito=Reserva realizada con éxito');
     /* } else {
            header('Location: asignar_reservas.php?error=La sala ya está reservada en la fecha seleccionada');
        }*/
     } else {
        header('Location: asignar_reservas.php?error=Las horas o la fecha son inválidas');
    }
     }   
     
}
