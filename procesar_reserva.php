<?php
include_once "comun.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $salaId = $_POST['sala'];
     $usuarioId = $_POST['usuario'];
     $fechaReserva = $_POST['fechaReserva'];
     $fechaInicio = $_POST['horaInicio'];
     $fechaFin = $_POST['horaFin'];


<<<<<<< HEAD
     //if ($dato->validarFechas($fechaInicio, $fechaFin)) {
     // if ($dato->verificarDisponibilidad($salaId, $fechaReserva,$fechaReserva,$fechaInicio, $fechaFin)) {
     $dato->crearReserva($salaId, $usuarioId, $fechaReserva, $fechaInicio, $fechaFin);
     header('Location: index.php?exito=Reserva realizada con éxito');
     /* } else {
            header('Location: asignar_reservas.php?error=La sala ya está reservada en la fecha seleccionada');
        }*/
     /* } else {
=======
    if ($dato->validarFechas($fechaInicio, $fechaFin)) {
        //if ($dato->verificarDisponibilidad($salaId/*, $fechaReserva,$fechaReserva,$fechaInicio, $fechaFin*/)) {
            $dato->crearReserva($salaId, $usuarioId, $fechaReserva,$fechaInicio, $fechaFin);
            header('Location: index.php?exito=Reserva realizada con éxito');
       /*} else {
            header('Location: asignar_reservas.php?error=La sala ya está reservada en la fecha seleccionada');
        }*/
   } else {
>>>>>>> cf27ecefb34c8f8e33ebb39907fb48316be6c8df
        header('Location: asignar_reservas.php?error=Las fechas son inválidas');
    }
}
