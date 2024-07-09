<?php

class Sala extends DAO
{
    //MÉTODO PARA INSERTAR LA SALA EN LA BASE DE DATOS
    public function insertarSala($nombre, $capacidad, $ubicacion, $equipamientoDisponible, $estado, $fotoActual)
    {
        // try {
        $sql = 'INSERT INTO saladeconferencias (nombre, capacidad, ubicacion, equipamientoDisponible, estado, foto)
                    VALUES (:nombre, :capacidad, :ubicacion, :equipamientoDisponible, :estado, :foto)';

        
        $consulta = $this->con->prepare($sql);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':capacidad', $capacidad);
        $consulta->bindValue(':ubicacion', $ubicacion);
        $consulta->bindValue(':equipamientoDisponible', $equipamientoDisponible);
        $consulta->bindValue(':estado', $estado);
        $consulta->bindValue(':foto', $fotoActual);

        $consulta->execute();
    }

    //MÉTODO PARA VALIDAR DATOS
    public static function validarDatos($nombre, $capacidad, $ubicacion, $foto)
    {
        if (empty($nombre) || empty($capacidad) || empty($ubicacion) || empty($foto)) {
            return false;
        }
        return true;
    }

    public function mostrarSala($idSala)
    {
        $sql = "SELECT * FROM saladeconferencias as sc, datos as d WHERE d.IdSala = '$idSala' AND d.IdSala = sc.id";
        $consulta = $this->con->query($sql);

        echo "<main class = 'table' id='customers_table'>";
        echo "<section class='table_header'>";
        echo "<h1>Salas</h1>";
        echo "</section>";
        echo "<section = 'table_body'>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Imagen de la Sala</th>";
        echo "<th>Nombre de la Sala</th>";
        echo "<th>Capacidad</th>";
        echo "<th>Equipamiento de la sala</th>";
        echo "<th>Fecha y hora de Inicio</th>";
        echo "<th>Fecha y hora de Fin</th>";
        echo "<th>Motivo de la reserva</th>";
        echo "</tr>";
        echo "</thead>";
        echo "</tbody>";
        while ($row = $consulta->fetch(PDO::FETCH_OBJ)) { //fecth(PDO::FETCH_OBJ /*$consulta->fetchAll(PDO::FETCH_ASSOC)*/)){

            $horaInicio = $row->horaInicio;
            $horaFin = $row->horaFin;
            $fecha = $row->fechaReserva;
            $img = $row->foto;
            $nombre = $row->nombre;
            $capacidad = $row->capacidad;
            $equipamientoDisponible = $row->equipamientoDisponible;
            $motivo = $row->motivo;
            $fechaHoraInicio = date('d-m-Y H:i', strtotime($fecha . ' ' . $horaInicio));
            $fechaHoraFin = date('d-m-Y H:i', strtotime($fecha . ' ' . $horaFin));
                
            echo "<tr>";
            echo "<td><img src='$img' ></td>";
            echo "<td>{$nombre}</td>";
            echo "<td>{$capacidad}</td>";
            echo "<td>{$equipamientoDisponible}</td>";
            echo "<td>{$fechaHoraInicio}</td>";
            echo "<td>{$fechaHoraFin}</td>";
            echo "<td>{$motivo}</td>";

            echo "</tr>";
        }
        echo "</table>";
    }

    public function listarSalas()
    {
        $result = $this->con->query("SELECT id, nombre FROM saladeconferencias WHERE estado = 'disponible'");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=\"{$row['id']}\">{$row['nombre']}</option>";
        }
    }

    /*    function getHistorialReservas($db) {
    $sql = "
        SELECT 
            r.IdSala,
            r.fechaReserva,
            r.horaInicio,
            r.horaFin,
            r.motivo,
            r.estado,
            s.nombre AS nombreSala,
            s.foto AS fotoSala,
            s.capacidad,
            u.primerNombre AS nombreEmpleado,
            u.ci AS ciEmpleado
        FROM datos r
        JOIN saladeconferencias s ON r.IdSala = s.id
        JOIN usuarios u ON r.CiEmpleado = u.ci
    ";

    $result = **$db$this->con->query($sql);
    return $result->fetchAll();//->fetch_all(MYSQLI_ASSOC);
}
function algo (){
    $historial = $this->getHistorialReservas(/*$db);

foreach ($historial as $reserva) {
    $estado = (strtotime($reserva['horaFin']) >= time()) ? 'Activa' : 'Finalizada';
    echo "<tr class='{$estado}'>";
    echo "<td><img src='{$reserva['fotoSala']}' alt='Sala' /></td>";
    echo "<td>{$reserva['nombreSala']}</td>";
    echo "<td>" . date("d-m-Y H:i", strtotime($reserva['horaInicio'])) . "</td>";
    echo "<td>" . date("d-m-Y H:i", strtotime($reserva['horaFin'])) . "</td>";
    echo "<td>{$reserva['nombreEmpleado']}</td>";
    echo "<td>{$reserva['ciEmpleado']}</td>";
    echo "<td><a href='detalle_reserva.php?id={$reserva['IdSala']}'>Detalle</a></td>";
    echo "</tr>";
}
}*/
}
