<?php
        include_once "../tablas.php";

    class datos extends DAO{
    

        public function getDatos($ciEmpleado){
            $consulta = "SELECT * FROM datos AS d WHERE d.ciEmpleado = :ciEmpleado";
            $this->getResultado($consulta, ['ciEmpleado'=>$ciEmpleado]);
            if (!$this->resultado['error']){                 
                return $this->resultado['data'][0]['ci'];;
            }else return false;
        }

        public function buscarDatos ($ciEmpleado) {
            $consulta = $this->con->query("SELECT * FROM datos WHERE ciEmpleado = '$ciEmpleado'" );
            $cantidadFilas = $consulta->rowCount();
            if ($cantidadFilas > 0){
                echo "<p align = center>El usuario tiene $cantidadFilas datos: </p>";
                crearTabla();
                crearCabezal("id sala", "ci empleado", "hora de inicio", "hora de fin");
                while ($row = $consulta->fetch(PDO::FETCH_OBJ)){ //fecth(PDO::FETCH_OBJ /*$consulta->fetchAll(PDO::FETCH_ASSOC)*/)){
                    $idSala = $row->idSala;
                    $ciEmpleado = $row->ciEmpleado;
                    $horaInicio = $row->horaInicio;
                    $horaFin = $row->horaFin;

                    $dato = new datos($idSala, $ciEmpleado, $horaInicio, $horaFin);
                    ingresarDatosConFila($idSala, $ciEmpleado, $horaInicio, $horaFin);
                }
                cerrarTabla();

                //return $datos;
            } else //return false;
            echo "<p align = center>El empleado no tiene datos. </p>";
        }

    }
?>