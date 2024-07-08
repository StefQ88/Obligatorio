<?php

class Sala extends DAO
{
  /*  public $id;
    public $nombre;
    public $capacidad;
    public $ubicacion;
    public $equipamientoDisponible;
    public $estado;
    public $foto;*/
   /* //CONSTRUCTOR --------------------------------
    public function __construct($nombre, $capacidad, $ubicacion, $equipamientoDisponible, $estado, $foto)
    {
        
        // $this->id=$id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->ubicacion = $ubicacion;
        $this->equipamientoDisponible = $equipamientoDisponible;
        $this->estado = $estado;
        $this->foto = $foto;
    }
    
    //DESTRUCT --------------------------------
    public function __destruct()
    {
        $this->id = null;
        $this->nombre = null;
        $this->capacidad = null;
        $this->ubicacion = null;
        $this->equipamientoDisponible = null;
        $this->estado = null;
        $this->foto = null;
    }*/
    //METODOS ---------------------------------
    //MÉTODO PARA MOSTRAR LA SALA
   /* public function mostrar()
    {
        echo "<tr>";
        echo "<td>" . $this->id . "</td>";
        echo "<td>" . $this->nombre . "</td>";
        echo "<td>" . $this->capacidad . "</td>";
        echo "<td>" . $this->ubicacion . "</td>";
        echo "<td>" . $this->equipamientoDisponible . "</td>";
        echo "<td>" . $this->estado . "</td>";
        echo "<td>" . $this->foto . "</td>";
        echo "</tr>";
    }*/

    //MÉTODO PARA INSERTAR LA SALA EN LA BASE DE DATOS
    public function insertarSala($nombre, $capacidad, $ubicacion, $equipamientoDisponible, $estado, $fotoActual)
    {
       // try {
            $sql = 'INSERT INTO saladeconferencias (nombre, capacidad, ubicacion, equipamientoDisponible, estado, foto)
                    VALUES (:nombre, :capacidad, :ubicacion, :equipamientoDisponible, :estado, :foto)';

            /*$parametros = array(
                ':nombre' => $sala->nombre,
                ':capacidad' => $sala->capacidad,
                ':ubicacion' => $sala->ubicacion,
                ':equipamientoDisponible' => $sala->equipamientoDisponible,
                ':estado' => $sala->estado,
                ':foto' => $sala->foto
            );

            $this->execute($sql, $parametros);

            $resultado = $this->getResultado();
            if ($resultado['error']) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $ex) {
            return false; 
        }*/


        $consulta = $this->con-> prepare($sql);
        $consulta -> bindValue(':nombre', $nombre);
        $consulta -> bindValue(':capacidad', $capacidad);
        $consulta -> bindValue(':ubicacion', $ubicacion);
        $consulta -> bindValue(':equipamientoDisponible', $equipamientoDisponible);
        $consulta -> bindValue(':estado', $estado);
        $consulta -> bindValue(':foto', $fotoActual);

        $consulta ->execute();


    }

    //MÉTODO PARA VALIDAR DATOS
    public static function validarDatos($nombre, $capacidad, $ubicacion, $foto)
    {
        if (empty($nombre) || empty($capacidad) || empty($ubicacion) || empty($foto)) {
            return false;
        }
        return true;
    }

    public function mostrarSala ($idSala) {
        $sql = "SELECT * FROM saladeconferencias as sc, datos as d WHERE d.IdSala = '$idSala' AND d.IdSala = sc.id";
        $consulta = $this->con->query( $sql);
            
            echo "<table width='60%' align='center' border='1'>";//crearTabla();
            echo "<th bgcolor='gray'>", "Imagen de la Sala", "</th>";
            echo "<th bgcolor='gray'>", "Nombre de la Sala", "</th>";
            echo "<th bgcolor='gray'>", "Capacidad", "</th>";
            echo "<th bgcolor='gray'>", "Equipamiento de la sala", "</th>";
            echo "<th bgcolor='gray'>", "hora de inicio", "</th>";
            echo "<th bgcolor='gray'>", "hora de fin", "</th>";
            echo "<th bgcolor='gray'>", "Motivo de la reserva", "</th>";
             while ($row = $consulta->fetch(PDO::FETCH_OBJ)){ //fecth(PDO::FETCH_OBJ /*$consulta->fetchAll(PDO::FETCH_ASSOC)*/)){
                echo "<tr>";
                    $horaInicio = $row->horaInicio;
                    $horaFin = $row->horaFin;
                    $img = $row->foto;
                    $nombre = $row->nombre;
                    $capacidad = $row->capacidad;
                    $equipamientoDisponible = $row->equipamientoDisponible;
                    $motivo = $row->motivo;
                    
                    echo "<td><img src='$img' width='100' height='100'></td>";
                    echo "<td>".$nombre."</td>";
                    echo "<td>".$capacidad."</td>";
                    echo "<td>".$equipamientoDisponible."</td>";
                    echo "<td>".$horaInicio."</td>";
                    echo "<td>".$horaFin."</td>";
                    echo "<td>".$motivo."</td>";
                                        
                echo "</tr>";
            }
            echo "</table>";
    }
}
