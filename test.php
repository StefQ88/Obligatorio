<?php

include_once "comun.php";

//$usuario->actualizarUsuario('12345679','Agustin', 'Santiago', 'Sastre', 'Sibilia', '1955-05-05', 'mail@mail.com', 'imagenNueva');

include_once "class/datos.php";

$datos = new datos();
/*$ciEmpleado = '13246578';

$reservas = $datos->obtenerhistorialReservas($ciEmpleado);

if ($reservas) {
    foreach ($reservas as $reserva) {
        echo "Foto: " . $reserva['foto'] . "<br>";
        echo "Nombre: " . $reserva['nombre'] . "<br>";
        echo "Fecha de Reserva: " . $reserva['fechaReserva'] . "<br>"; 
        echo "Hora de Inicio: " . date('H:i', strtotime($reserva['horaInicio'])) . "<br>"; 
        echo "Hora de Fin: " . date('H:i', strtotime($reserva['horaFin'])) . "<br>"; 
        echo "<br>";
    }
} else {
    echo "No se encontraron reservas para el empleado con CI: " . $ciEmpleado;
}

$datos->mostrarHistorialReservas($ciEmpleado);

*/
/*
$reservas = [
    [
        'fechaInicio' => '2024-07-10',
        'horaInicio' => '14:00:00',
        'horaFin' => '15:00:00'
    ],
    [
        'fechaInicio' => '2024-07-11',
        'horaInicio' => '09:30:00',
        'horaFin' => '11:00:00'
    ]
];

foreach ($reservas as $reserva) {
   
    $fechaHoraInicio = $reserva['fechaInicio'] . ' ' . $reserva['horaInicio'];

    $timestampInicio = strtotime($fechaHoraInicio);
    $fechaInicioFormateada = date('d-m-Y H:i', $timestampInicio);

    echo "Fecha de inicio formateada: " . $fechaInicioFormateada . "\n";
}*/


/*
$idSala = 2;
$fotoSala = $datos->obtenerFotoSala($idSala);

if($fotoSala){
    echo "La foto de la sala con idSala {$idSala} es: <br>";
    echo "<img src='uploads/{$fotoSala}' style='width: 200px;'><br>";
}else {
    echo "No se encontró ninguna foto para la sala con idSala {$idSala}";
}
    */

    $ciEmpleado = '23456789'; 
    $esAdministrador = false;
    echo "<h2>Historial de reservas como empleado</h2>";
    $datos->mostrarHistorialReservas($ciEmpleado,$esAdministrador);


    $esAdministrador = true;
    echo "<h2>Historial de reservas como empleado</h2>";
    $datos->mostrarHistorialReservas($ciEmpleado,$esAdministrador);













?>




