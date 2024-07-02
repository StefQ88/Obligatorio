<?php

require_once '../class/DAO.php';

class SalaDAO extends DAO
{
    // Método para insertar 
    public function insertarSala(Sala $sala)
    {
        try {
            $sql = 'INSERT INTO saladeconferencias (nombre, capacidad, ubicacion, equipamientoDisponible, estado, foto)
                    VALUES (:nombre, :capacidad, :ubicacion, :equipamientoDisponible, :estado, :foto)';

            $parametros = array(
                ':nombre' => $sala->getNombre(),
                ':capacidad' => $sala->getCapacidad(),
                ':ubicacion' => $sala->getUbicacion(),
                ':equipamientoDisponible' => $sala->getEquipamientoDisponible(),
                ':estado' => $sala->getEstado(),
                ':foto' => $sala->getFoto()
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
        }
    }

    //metodo para validar datos
    public static function validarDatos($nombre, $capacidad, $ubicacion, $foto)
    {
        if (empty($nombre) || empty($capacidad) || empty($ubicacion) || empty($foto)) {
            return false;
        }
        return true;
    }

}
