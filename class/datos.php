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
    
            $sql = "SELECT * FROM saladeconferencias sc, datos d WHERE d.IdSala = sc.id AND d.CiEmpleado = '$ciEmpleado';";
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
                            echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/$img' style='width: 70px'></a></div></td>";
                        }
                        echo "<td>".$name."</td>";
                        echo "<td>".$capacidad."</td>";
                        echo "<td>".$horaInicio."</td>";
                        echo "<td>".$horaFin."</td>";
                        
                        
                    echo "</tr>";
                }
                echo "</table>";
            } else
            echo "<p align = center>El empleado no tiene datos. </p>";
        }


        public function buscarDatos2 () {
            
            $sql = "SELECT * FROM saladeconferencias as sc, datos as d, usuarios as u WHERE d.IdSala = sc.id AND d.horaFIn >= date(now()) and u.tipoUsuario = 'empleado'";
            $consulta = $this->con->query( $sql);
            $cantidadFilas = $consulta->rowCount();
            if ($cantidadFilas > 0){
                echo "<p align = center>El usuario tiene $cantidadFilas datos: </p>";
                /*echo "<table width='60%' align='center' border='1'>";
                echo "<th bgcolor='gray'>", "Imagen de la Sala", "</th>";
                echo "<th bgcolor='gray'>", "Nombre de la Sala", "</th>";
                echo "<th bgcolor='gray'>", "hora de inicio", "</th>";
                echo "<th bgcolor='gray'>", "hora de fin", "</th>";
                echo "<th bgcolor='gray'>", "Nombre del Empleado", "</th>";
                echo "<th bgcolor='gray'>", "Apellido del Empleado", "</th>";
                echo "<th bgcolor='gray'>", "ci empleado", "</th>";*/
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
                                    echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/$img' style='width: 70px'></a></div></td>";
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
                echo "<p align = center>No existen salas las cuales su hora de finalizacion sea mayor a la hora actual. </p>";
        }

        

        public function obtenerhistorialReservas($ciEmpleado){

            $sql = "SELECT sc.foto, sc.nombre, d.IdSala, d.fechaReserva, d.horaInicio, d.horaFin
            FROM saladeconferencias AS sc
            JOIN datos AS d ON d.IdSala  = sc.id
            JOIN usuarios As u ON d.CiEmpleado = u.ci
            WHERE d.CiEmpleado = :ciEmpleado
            ORDER BY d.fechaReserva DESC, d.horaFin DESC";
    
            $consulta = $this->con->prepare($sql); //preparamos la consulta
            $consulta ->execute(['ciEmpleado' => $ciEmpleado]); //se ejecuta

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
          }

       /* public function obtenerFotoSala($idSala){
            $sql = "SELECT foto FROM saladeconferencias WHERE id = :idSala";
            $consulta = $this->con->prepare($sql);
            $consulta->execute(['idSala' => $idSala]);
            $foto = $consulta->fetchColumn();
            
            return $foto;
        }*/

        public function mostrarHistorialReservas($ciEmpleado){
            $reservas = $this->obtenerhistorialReservas($ciEmpleado);

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
                            echo "<th>" . "Imagen de la Sala" . "</th>";
                            echo "<th>" . "Nombre de la Sala" . "</th>";
                            echo "<th>" . "Fecha y Hora de Inicio" . "</th>";
                            echo "<th>" . "Fecha y Hora de Fin" . "</th>";
                            echo "<th>" . "Estado" . "</th>";
                            echo "<th>" . "Link a Detalle" . "</th>";
                        echo "</tr>";
                    echo "</thead>";
                echo "</tbody>";

                foreach ($reservas as $reserva){

                    $idSala = $reserva['IdSala'];
                    $fotoSala = $reserva['foto'];
                    $nombreSala = $reserva['nombre'];
                    $fechaInicio = date('d-m-Y H:i', strtotime($reserva['fechaReserva'] . ' ' . $reserva['horaInicio']));
                    $fechaFin = date('d-m-Y H:i', strtotime($reserva['fechaReserva'] . ' ' . $reserva['horaFin']));
                    //$estado = (strtotime($reserva['horaFin']) > time()) ? 'Activa' : 'Finalizada';
                   // $estadoColor = ($estado === 'Activa') ? 'green' : 'red';

                   if (strtotime($reserva['fechaReserva'] . ' ' . $reserva['horaFin']) > time()) {
                    $estado = 'Activa';
                    $estadoColor = 'green';
                    } else {
                    $estado = 'Finalizada';
                    $estadoColor = 'red';
                    }

                    echo "<tr>";
                    if (empty($fotoSala)) {
                        echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='uploads/default-pp.png'  style='width: 70px'></a></div></td>";
                    } else {
                        echo "<td> <div class='cell'><a href='detalleReserva.php?id=$idSala'><img src='$fotoSala' style='width: 70px'></a></div></td>";
                    }
                    echo "<td>{$nombreSala}</td>";
                    echo "<td>{$fechaInicio}</td>";
                    echo "<td>{$fechaFin}</td>";
                    echo "<td style='color: {$estadoColor}'>{$estado}</td>";
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
    }
?>