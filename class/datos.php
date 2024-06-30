<?php 
    class datos extends DAO{
       /* private $IdSala;
        private $CiEmpleado;
        private $fechaReserva;
        private $horaInicio;
        private $horaFin;
        private $motivo;
        //fecha y hora de la creacion Ees automatica 
        private $estado; //donde el estado de la reserva puede ser activa o finalizada 
        //CONSTRUCTOR ----------------------------------------------------------------
        public function __construct($IdSala,$CiEmpleado,$fechaReserva,$horaInicio,$horaFin,$motivo,$estado){
            $this->IdSala=$IdSala;
            $this->CiEmpleado=$CiEmpleado;
            $this->fechaReserva=$fechaReserva;
            $this->horaInicio=$horaInicio;
            $this->horaFin=$horaFin;
            $this->motivo=$motivo;
            $this->estado=$estado;
        }
        //GETTERS ----------------------------------------------------------------
        public function getIdSala(){
            return $this->IdSala;
        }
        public function getCiEmpleado(){
            return $this->CiEmpleado;
        }
        public function getFechaReserva(){
            return $this->fechaReserva;
        }
        public function getHoraInicio(){
            return $this->horaInicio;
        }
        public function getHoraFin(){
            return $this->horaFin;
        }
        public function getMotivo(){
            return $this->motivo;
        }
        public function getEstado(){
            return $this->estado;
        }
        //SETTERS ----------------------------------------------------------------
        public function setIdSala($IdSala){
            $this->IdSala=$IdSala;
        }
        public function setCiEmpleado($CiEmpleado){
            $this->CiEmpleado=$CiEmpleado;
        }
        public function setFechaReserva($fechaReserva){
            $this->fechaReserva=$fechaReserva;
        }
        public function setHoraInicio($horaInicio){
            $this->horaInicio=$horaInicio;
        }
        public function setHoraFin($horaFin){
            $this->horaFin=$horaFin;
        }
        public function setMotivo($motivo){
            $this->motivo=$motivo;
        }
        public function setEstado($estado){
            $this->estado=$estado;
        }
        //DESTRUCTOR ----------------------------------------------------------------
        public function __destruct(){
            $this->IdSala=null;
            $this->CiEmpleado=null;
            $this->fechaReserva=null;
            $this->horaInicio=null;
            $this->horaFin=null;
            $this->motivo=null;
            $this->estado=null;
        }
        //TOSTRING ----------------------------------------------------------------
        public function __toString(){
            return $this->IdSala." ".$this->CiEmpleado." ".$this->fechaReserva." ".$this->horaInicio." ".$this->horaFin." ".$this->motivo." ".$this->estado;
        }
        //METODOS ----------------------------------------------------------------
        public function mostrarDatos(){
            echo $this->IdSala." ".$this->CiEmpleado." ".$this->fechaReserva." ".$this->horaInicio." ".$this->horaFin." ".$this->motivo." ".$this->estado;
        }*/
        /*public function modificarDatos($IdSala,$CiEmpleado,$fechaReserva,$horaInicio,$horaFin,$motivo,$estado){
            $this->IdSala=$IdSala;
            $this->CiEmpleado=$CiEmpleado;
            $this->fechaReserva=$fechaReserva;
            $this->horaInicio=$horaInicio;
            $this->horaFin=$horaFin;
            $this->motivo=$motivo;
            $this->estado=$estado;
        }*/
        /*public function agregarDatos($IdSala,$CiEmpleado,$fechaReserva,$horaInicio,$horaFin,$motivo,$estado){
            $this->IdSala=$IdSala;
            $this->CiEmpleado=$CiEmpleado;
            $this->fechaReserva=$fechaReserva;
            $this->horaInicio=$horaInicio;
            $this->horaFin=$horaFin;
            $this->motivo=$motivo;
            $this->estado=$estado;
        }*/
        /*public function buscarDatos($IdSala,$CiEmpleado,$fechaReserva,$horaInicio,$horaFin,$motivo,$estado){
            $this->IdSala=$IdSala;
            $this->CiEmpleado=$CiEmpleado;
            $this->fechaReserva=$fechaReserva;
            $this->horaInicio=$horaInicio;
            $this->horaFin=$horaFin;
            $this->motivo=$motivo;
            $this->estado=$estado;
        }*/

        public function getDatos($ciEmpleado){
            $consulta = "SELECT * FROM datos AS d WHERE d.ciEmpleado = :ciEmpleado";
            $this->getResultado($consulta, ['ciEmpleado'=>$ciEmpleado]);
            if (!$this->resultado['error']){                 
                return $this->resultado['data'][0]['ci'];;
            }else return false;
        }


    }
?>