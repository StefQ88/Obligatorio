<?php
//require_once "./tablas.php";
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
           /* $i = 0;
            $res = array();*/
            // "SELECT * FROM datos WHERE ciEmpleado = '$ciEmpleado'"
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
                        echo "<td><img src='img/$img' width='100' height='100'></td>";
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
            /*Imagen de la sala de conferencias
 Nombre de la sala
 Capacidad de la sala
 Fecha y hora de inicio (Formato: DD-MM-YYYY HH)
 Fecha y hora de fin (Formato: DD-MM-YYYY HH)
 Nombre y Apellido del Empleado
 CI del Empleado*/
            $sql = "SELECT * FROM saladeconferencias as sc, datos as d, usuarios as u WHERE d.IdSala = sc.id AND d.horaFIn >= date(now()) and u.tipoUsuario = 'empleado'";
            $consulta = $this->con->query( $sql);
            $cantidadFilas = $consulta->rowCount();
            if ($cantidadFilas > 0){
                echo "<p align = center>El usuario tiene $cantidadFilas datos: </p>";
                echo "<table width='60%' align='center' border='1'>";//crearTabla();
                 //crearCabezal("id sala", "ci empleado", "hora de inicio", "hora de fin", "Imagen de la Sala", "Nombre de la Sala", "Capacidad de la Sala");
                echo "<th bgcolor='gray'>", "Imagen de la Sala", "</th>";
                echo "<th bgcolor='gray'>", "Nombre de la Sala", "</th>";
                echo "<th bgcolor='gray'>", "hora de inicio", "</th>";
                echo "<th bgcolor='gray'>", "hora de fin", "</th>";
                echo "<th bgcolor='gray'>", "Nombre del Empleado", "</th>";
                echo "<th bgcolor='gray'>", "Apellido del Empleado", "</th>";
                echo "<th bgcolor='gray'>", "ci empleado", "</th>";
                 while ($row = $consulta->fetch(PDO::FETCH_OBJ)){ //fecth(PDO::FETCH_OBJ /*$consulta->fetchAll(PDO::FETCH_ASSOC)*/)){
                    echo "<tr>";
                        //$idSala = $row->IdSala;
                        $ciEmpleado = $row->CiEmpleado;
                        $horaInicio = $row->horaInicio;
                        $horaFin = $row->horaFin;
                        $img = $row->foto;
                        $name = $row->primerNombre;
                        $apellido = $row->primerApellido;
                        $nombre = $row->nombre;
                        //echo "<td>".$idSala."</td>";
                        echo "<td><img src='img/$img' width='100' height='100'></td>";
                        echo "<td>".$name."</td>";
                        echo "<td>".$horaInicio."</td>";
                        echo "<td>".$horaFin."</td>";
                        echo "<td>".$nombre."</td>";
                        echo "<td>".$apellido."</td>";
                        echo "<td>".$ciEmpleado."</td>";
                                            
                    echo "</tr>";
                }
                echo "</table>";
            } else
                echo "<p align = center>El empleado no tiene datos. </p>";
        }
    }
?>