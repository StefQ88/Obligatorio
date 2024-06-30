<?php 

    require_once 'DAO.php';
    class Usuario extends DAO{
      
        
        public function get($ciUsuer){
            $consulta = "SELECT * FROM usuarios AS user WHERE user.ci = :ci LIMIT 1";
            $this->executeGet($consulta, ['ci'=>$ciUsuer]);

            if (!$this->resultado['error']){
                return $this->resultado['data'][0];
            }else return false;
        }

        public function verficarDatos($email, $pass){
            $pass = md5($pass);
            $consulta = "SELECT * FROM usuarios AS user WHERE user.email = :email AND user.pass = :pass LIMIT 1";
            $this->executeGet($consulta, ['email'=> $email, 'pass' => $pass]);
            if (!$this->resultado['error']){
                return $this->resultado['data'][0]['ci'];
            }else return false;
        }

        public function getEstado($ciUsuer = NULL) {
            if (isset($ciUsuer)) {
                //buscar en BD datos de usuario
            }
            else {
                //BUSCAMOS EN LA SESSION ACTIVA
                if (isset($_SESSION['usuario'])) {
                    $usuario = $_SESSION['usuario'];
                }else {
                    return false;
                }
            }
            
            return isset($usuario['activo']) ? $usuario['activo'] : false;
        }  

        public function insertUsuario($ci, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $fotoPerfil, $password, $tipoUsuario){
            
            $sql = 'INSERT INTO usuarios (ci, primerNombre, segundoNombre, primerApellido, segundoApellido, fechaNacimiento, email, fotoPerfil, pass, tipoUsuario) 
                    VALUES (:ci, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido, :fechaNacimiento, :email, :fotoPerfil, :pass, :tipoUsuario)';
            
            $consulta = $this->con->prepare($sql);
            
            $consulta->bindValue(':ci', $ci);
            $consulta->bindValue(':primerNombre' , $primerNombre);
            $consulta->bindValue(':segundoNombre' , $segundoNombre);
            $consulta->bindValue(':primerApellido' , $primerApellido);
            $consulta->bindValue(':segundoApellido' , $segundoApellido);
            $consulta->bindValue(':fechaNacimiento' , $fechaNacimiento);
            $consulta->bindValue(':email' , $email);
            $consulta->bindValue(':fotoPerfil' , $fotoPerfil);
            $consulta->bindValue(':pass' , md5($password));
            $consulta->bindValue(':tipoUsuario' , $tipoUsuario);

            $consulta->execute();
        }

        public function actualizarUsuario($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $fotoPerfil){
            
            $sql = 'UPDATE usuarios SET (primerNombre = :primerNombre, segundoNombre = :segundoNombre, primerApellido = :primerApellido, segundoApellido = :segundoApellido, fechaNacimiento = :fechaNacimiento, email = :email, fotoPerfil = :fotoPerfil) WHERE ci = :ci';

            $consulta = $this->con->prepare($sql);
            
            $consulta->bindValue(':ci', $_SESSION['usuario']['ci']);
            $consulta->bindValue(':primerNombre' , $primerNombre);
            $consulta->bindValue(':segundoNombre' , $segundoNombre);
            $consulta->bindValue(':primerApellido' , $primerApellido);
            $consulta->bindValue(':segundoApellido' , $segundoApellido);
            $consulta->bindValue(':fechaNacimiento' , $fechaNacimiento);
            $consulta->bindValue(':email' , $email);
            $consulta->bindValue(':fotoPerfil' , $fotoPerfil);

            $consulta->execute();
        }

    }
?>