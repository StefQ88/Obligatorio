<?php
//require_once "./tablas.php";
require_once "DAO.php";

    class datos extends DAO{
        /*private $idSala;
        private $ciEmpleado;
        private $fechaReserva;
        private $horaInicio;
        private $horaFin;
        private $motivo;

        function __construct($idSala, $ciEmpleado, $fechaReserva=null, $horaInicio=null, $horaFin=null, $motivo=null){
            $this->idSala = $idSala; 
            $this->ciEmpleado = $ciEmpleado;
        }*/

        public function getDatos($ciEmpleado){
            $consulta = "SELECT * FROM datos AS d WHERE d.ciEmpleado = :ciEmpleado";
            $this->getResultado($consulta, ['ciEmpleado'=>$ciEmpleado]);
            if (!$this->resultado['error']){                 
                return $this->resultado['data'][0]['ci'];;
            }else return false;
        }

        public function buscarDatos ($ciEmpleado) {
    
            $sql = "SELECT * FROM saladeconferencias sc, datos d WHERE d.IdSala = sc.id AND d.CiEmpleado = '$ciEmpleado' AND d.horaFIn >= date(now())";
            $consulta = $this->con->query( $sql);
            $cantidadFilas = $consulta->rowCount();
            if ($cantidadFilas > 0){
                echo "<p align = center>El usuario tiene $cantidadFilas datos: </p>";
                echo "<table width='60%' align='center' border='1'>";
                echo "<th bgcolor='gray'>", "Imagen de la Sala", "</th>";
                echo "<th bgcolor='gray'>", "Nombre de la Sala", "</th>";
                echo "<th bgcolor='gray'>","Capacidad de la Sala", "</th>";
                echo "<th bgcolor='gray'>", "hora de inicio", "</th>";
                echo "<th bgcolor='gray'>", "hora de fin", "</th>";
                
                while ($row = $consulta->fetch(PDO::FETCH_OBJ)){ 
                    echo "<tr>";
                        $horaInicio = $row->horaInicio;
                        $horaFin = $row->horaFin;
                        $img = $row->foto;
                        $name = $row->nombre;
                        $capacidad = $row->capacidad;
                        $idSala = $row->IdSala;
                        //echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/$img' width='100' height='100'></a></div></td>";
                        if (empty($img)){
                            echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/default-pp.png' style='width: 70px'></a></div></td>";
                        }else{
                            echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='$img' style='width: 70px'></a></div></td>";
                        }
                        echo "<td>".$name."</td>";
                        echo "<td>".$capacidad."</td>";
                        echo "<td>".$horaInicio."</td>";
                        echo "<td>".$horaFin."</td>";
                        
                        
                    echo "</tr>";
                }
                echo "</table>";
            } else
            echo "<p align = center color= #fff>El empleado no tiene datos. </p>";
        }


        public function buscarDatos2 () {
            
            $sql = "SELECT * FROM saladeconferencias as sc, datos as d, usuarios as u WHERE d.IdSala = sc.id AND d.horaFIn >= date(now()) and u.tipoUsuario = 'empleado'";
            $consulta = $this->con->query( $sql);
            $cantidadFilas = $consulta->rowCount();
            if ($cantidadFilas > 0){
                echo "<p align = center>El usuario tiene $cantidadFilas datos: </p>";

                echo"<main class='table' id='customers_table'>";
                echo"<section class='table__header'>";
                    echo"<h1>Tabla de Salas</h1>";
                echo"</section>";
                echo "<section class='table__body'>";
                echo "<table>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>" . "Imagen de la Sala" . "</th>";
                            echo "<th>", "Nombre de la Sala", "</th>";
                            echo "<th>", "hora de inicio", "</th>";
                            echo "<th>", "hora de fin", "</th>";
                            echo "<th>", "Nombre del Empleado", "</th>";
                            echo "<th>", "Apellido del Empleado", "</th>";
                            echo "<th>", "ci empleado", "</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        while ($row = $consulta->fetch(PDO::FETCH_OBJ)){
                            echo "<tr>";
                                $idSala = $row->IdSala;
                                $ciEmpleado = $row->CiEmpleado;
                                $horaInicio = $row->horaInicio;
                                $horaFin = $row->horaFin;
                                $img = $row->foto;
                                $name = $row->primerNombre;
                                $apellido = $row->primerApellido;
                                $nombre = $row->nombre;
                                //echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='img/$img' width='100' height='100'></a></div></td>";
                                if (empty($img)){
                                    echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/default-pp.png'  style='width: 70px'></a></div></td>";
                                }else{
                                    echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='$img' style='width: 70px'></a></div></td>";
                                }
                                echo "<td>".$nombre."</td>";
                                echo "<td>".$horaInicio."</td>";
                                echo "<td>".$horaFin."</td>";
                                echo "<td>".$name."</td>";
                                echo "<td>".$apellido."</td>";
                                echo "<td>".$ciEmpleado."</td>";
                                                    
                            echo "</tr>";
                        }
                    echo "</tbody>";
                    echo "</table>";
                echo "</section>";
                echo "</main>";
               
            } else
                echo "<p align = center color=#fff>No existen salas las cuales su hora de finalizacion sea mayor a la hora actual. </p>";
        }

        public function obtenerhistorialReservas($ciEmpleado, $esAdministrador){

            if($esAdministrador){
                $sql = "SELECT *
                        FROM saladeconferencias AS sc
                        JOIN datos AS d ON d.IdSala  = sc.id
                        JOIN usuarios As u ON d.CiEmpleado = u.ci
                        ORDER BY d.fechaReserva DESC, d.horaFin DESC";
                $consulta = $this->con->prepare($sql);
                $consulta->execute();
            } else {

                $sql = "SELECT *
                FROM saladeconferencias AS sc
                JOIN datos AS d ON d.IdSala  = sc.id
                JOIN usuarios As u ON d.CiEmpleado = u.ci
                WHERE d.CiEmpleado = :ciEmpleado 
                ORDER BY d.fechaReserva DESC, d.horaFin DESC";
    
                $consulta = $this->con->prepare($sql); 
                $consulta ->execute(['ciEmpleado' => $ciEmpleado]); 
            }

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        public function mostrarHistorialReservas($ciEmpleado,$esAdministrador){
            $reservas = $this->obtenerhistorialReservas($ciEmpleado,$esAdministrador);

            if($reservas){
                echo "<p align = center>El usuario tiene " . count($reservas). " reservas: </p>";

                echo "<main class = 'table' id='customers_table'>";
                echo "<section class='table_header'>";
                    echo "<h1>Historial de Reservas</h1>";
                echo "</section>";
                echo "<section = 'table_body'>";
                echo "<table>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Imagen de la Sala</th>";
                            echo "<th>Nombre de la Sala</th>";
                            echo "<th>Fecha y Hora de Inicio</th>";
                            echo "<th>Fecha y Hora de Fin</th>";
                            echo "<th>Estado</th>";
                            echo "<th>Nombre y Apellido del Empleado</th>";
                            echo "<th>Link a Detalle</th>";
                        echo "</tr>";
                    echo "</thead>";
                echo "</tbody>";

                foreach ($reservas as $reserva){

                    $idSala = $reserva['IdSala'];
                    $fotoSala = $reserva['foto'];
                    $nombreSala = $reserva['nombre'];
                    $nombreEmpleado = $reserva['primerNombre'] . ' ' . $reserva['primerApellido'];
                    $fechaHoraInicio = date('d-m-Y H:i', strtotime($reserva['fechaReserva'] . ' ' . $reserva['horaInicio']));
                    $fechaHoraFin = date('d-m-Y H:i', strtotime($reserva['fechaReserva'] . ' ' . $reserva['horaFin']));
                    //$estado = (strtotime($reserva['horaFin']) > time()) ? 'Activa' : 'Finalizada';
                   // $estadoColor = ($estado === 'Activa') ? 'green' : 'red';

                   //$timestampInicio = strtotime($fechaHoraInicio);
                   //$timestampFin = strtotime($fechaHoraFin);

                   //date_default_timezone_set('Etc/GMT+3');
                   // $fecha_y_hora = date("Y-m-d H:i");

                   if ($fechaHoraFin < time()) {
                    $estado = 'Activa';
                    $estadoColor = 'green';
                    } else {
                    $estado = 'Finalizada';
                    $estadoColor = 'red';
                    }

                   //echo time();


                    echo "<tr>";
                    if (empty($fotoSala)) {
                        echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/default-pp.png'  style='width: 70px'></a></div></td>";
                    } else {
                        echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='$fotoSala' style='width: 70px'></a></div></td>";
                    }
                    echo "<td>{$nombreSala}</td>";
                    echo "<td>{$fechaHoraInicio}</td>";
                    echo "<td>{$fechaHoraFin}</td>";
                    echo "<td style='color: {$estadoColor}'>{$estado}</td>";
                    echo "<td>{$nombreEmpleado}</td>";
                    echo "<td><a href='detalleReserva.php?id={$idSala}'>Ver Detalle</a></td>";
                    echo "</tr>";
                 }

                echo "</tbody>";
                echo "</table>";
                echo "</section>";
                echo "</main>";
                } else {
                    echo "<p align='center'>No se encontraron reservas para el empleado con CI: {$ciEmpleado}</p>";
                }
        }

        
    public function validarFechas($fechaInicio, $fechaFin) {
        return strtotime($fechaInicio) < strtotime($fechaFin);
    }

    public function verificarDisponibilidad($salaId, $fechaInicio, $fechaFin) {
        $query = "SELECT * FROM saladeconferencias as sc JOIN datos as d WHERE d.IdSala = sc.id AND ((d.horaInicio < ? AND horaFin > ?) OR (horaInicio < ? AND horaFin > ?))";
        $stmt = $this->con->prepare($query);
        $result = $stmt->rowCount();

        return $result === 0;
    }

    public function crearReserva($salaId, $usuarioId, $fechaReserva,$fechaInicio, $fechaFin) {
        $query = "INSERT INTO datos (IdSala, CiEmpleado, fechaReserva, horaInicio, horaFin) 
        VALUES (:IdSala, :CiEmpleado, :fechaReserva, :horaInicio, :horaFin)";
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':IdSala', $salaId);
        $stmt->bindValue(':CiEmpleado', $usuarioId);
        $stmt->bindValue(':fechaReserva', $fechaReserva);
        $stmt->bindValue(':horaInicio', $fechaInicio);
        $stmt->bindValue(':horaFin', $fechaFin);
        $sql = "UPDATE `saladeconferencias` SET `estado` = 'no_disponible' WHERE `id` = :idSala";
        $conexion = $this->con->prepare($sql);
        $conexion->bindValue(':idSala', $salaId);
        $conexion->execute();
        return $stmt->execute();
    }
    }
?>