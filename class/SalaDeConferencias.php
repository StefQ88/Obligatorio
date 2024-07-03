<?php

class Sala extends DAO
{
    private $id;
    private $nombre;
    private $capacidad;
    private $ubicacion;
    private $equipamientoDisponible;
    private $estado;
    private $foto;
    //CONSTRUCTOR --------------------------------
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
    }
    //METODOS ---------------------------------
    //MÉTODO PARA MOSTRAR LA SALA
    public function mostrar()
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
    }

    //MÉTODO PARA INSERTAR LA SALA EN LA BASE DE DATOS
    public function insertarSala(Sala $sala)
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
        $consulta -> bindValue(':nombre', $sala -> nombre);
        $consulta -> bindValue(':capacidad', $sala -> capacidad);
        $consulta -> bindValue(':ubicacion', $sala -> ubicacion);
        $consulta -> bindValue(':equipamientoDisponible', $sala -> equipamientoDisponible);
        $consulta -> bindValue(':estado', $sala -> estado);
        $consulta -> bindValue(':foto', $sala -> foto);

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
}
