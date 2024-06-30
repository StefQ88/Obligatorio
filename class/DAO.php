<?php 
    abstract class DAO{

        protected $con = null;
        protected $query;
        protected $resultado;

        public function __construct(){
            $user = 'root';
            $pass = '';
            //$host = '127.0.0.1';
            $db = 'empresa';
            if ($this->con == null){

                $this->con = new PDO("mysql:host=localhost;dbname={$db};charset=utf8", $user, $pass);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }

        protected function execute(string $sql, array $parametros = []){
            $res = [false, 'Transaction completed'];
            $this->query = $this->con->prepare($sql);

            try{
                $this->query->execute($parametros);
            } catch (PDOException $ex) {
                $res = [true, $ex->getMessage()];
            }finally{
                $this->resultado = ['error'=>$res[0], 'data' => $res[1]];
            }
        }
        protected function executeGet(string $sql, array $parametros = []){
            $res = [true, "No dato found"];
            $this->query = $this->con->prepare($sql);

            try{
                $this->query->execute($parametros);
                $data = $this->query->fetchAll(PDO::FETCH_ASSOC);
                if (count($data) > 0){
                    $res = [false, $data];
                }
            }catch(PDOException $ex){
                $res = [true, $ex->getMessage()];
            }finally{
                $this->resultado = ['error' => $res[0], 'data' => $res[1]];
            }
        }
        protected function message(string $mensaje){
            if (!$this->resultado['error'])
                $this->resultado['data'] = $mensaje;
        }
        
        public function getResultado(string $sql, array $parametros){
            $res = [];
            $this->query = $this->con->prepare($sql);
            try {
                $this->query->execute($parametros);
                /*while($data = $this->query->fetchAll(PDO::FETCH_ASSOC)){
                    $res = [false,$data];
                }*/
                $res = $this->query->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                $res = [true, $ex->getMessage()];
            }finally{
                $cant_filas = $this->query->rowCount();
                while($data = $this->query->fetchAll(PDO::FETCH_ASSOC))
                //$this->resultado = ['error' => $res[0], 'data' => $res[i]];
                    $res = ['false']['data'];
                //$this->resultado['data'] = $res;
            }
        }

        public function close(){
            $this->con = null;
        }
    }