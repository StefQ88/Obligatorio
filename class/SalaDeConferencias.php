<?php
class sala{
    private $id;
    private $nombre;
    private $capacidad;
    private $ubicacion;
    private $equipamientoDisponible;
    private $estado;
    private $foto;
    //CONSTRUCTOR --------------------------------
    public function __construct($id,$nombre,$capacidad,$ubicacion,$equipamientoDisponible,$estado,$foto){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->capacidad=$capacidad;
        $this->ubicacion=$ubicacion;
        $this->equipamientoDisponible=$equipamientoDisponible;
        $this->estado=$estado;
        $this->foto=$foto;
    }
    //GETTERS --------------------------------
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getCapacidad(){
        return $this->capacidad;
    }
    public function getUbicacion(){
        return $this->ubicacion;
    }
    public function getEquipamientoDisponible(){
        return $this->equipamientoDisponible;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getFoto(){
        return $this->foto;
    }
    //SETTERS --------------------------------
    public function setId($id){
        $this->id=$id;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setCapacidad($capacidad){
        $this->capacidad=$capacidad;
    }
    public function setUbicacion($ubicacion){
        $this->ubicacion=$ubicacion;
    }
    public function setEquipamientoDisponible($equipamientoDisponible){
        $this->equipamientoDisponible=$equipamientoDisponible;
    }
    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function setFoto($foto){
        $this->foto=$foto;
    }
    //TOSTRING --------------------------------
    public function toString(){
        return $this->id."-".$this->nombre."-".$this->capacidad."-".$this->ubicacion."-".$this->equipamientoDisponible."-".$this->estado."-".$this->foto;
    }
    //TOARRAY --------------------------------
    public function toArray(){
        return array($this->id,$this->nombre,$this->capacidad,$this->ubicacion,$this->equipamientoDisponible,$this->estado,$this->foto);
    }
    //DESTRUCT --------------------------------
    public function __destruct(){
        $this->id=null;
        $this->nombre=null;
        $this->capacidad=null;
        $this->ubicacion=null;
        $this->equipamientoDisponible=null;
        $this->estado=null;
        $this->foto=null;
    }
    //METODOS ---------------------------------
    public function mostrar(){
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->nombre."</td>";
        echo "<td>".$this->capacidad."</td>";
        echo "<td>".$this->ubicacion."</td>";
        echo "<td>".$this->equipamientoDisponible."</td>";
        echo "<td>".$this->estado."</td>";
        echo "<td>".$this->foto."</td>";
        echo "</tr>";
    }

    public static function validarDatos($id, $nombre, $capacidad,$ubicacion,$foto){
        if (empty($id) || empty($nombre) || empty($capacidad) || empty($ubicacion) || empty($foto)){
            return false;
        }
     return true;
    }






}
?>