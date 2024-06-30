<?php
    require "comun.php";
    //include_once"Usuarios.php";
    //session_start();
    
    if (isset($_POST['Login']) /*&& isset($_POST['user']) && isset ($_POST['password'])*/) {
    
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email)){
            header('location: login.php?error=CI is required');
            exit();
        }else if (empty($password)){
            header('location: login.php?error=password is required');
            exit();
        }else{
            // STATUS OK
            /* if($fila['tipoUsuario'] == 'empleado'){
                        header('location: home.php');*/
                        //la otra manera de hacer esto es en un solo php guardar el tipo de usuario y de ahi depende de lo que muestro si muestro mas o menos   y me queda un solo index
                    //}
            //}
            if (postParamAndSet('email', $email) && postParamAndSet('password', $password)){
                if ($ciUser = $usuario->verficarDatos($email, $password)){
                    $_SESSION['usuario'] = $usuario->get($ciUser);
                    $estado = $usuario->getEstado();
                    if ($estado == 0){
                        echo "<script> alert (\"El usuario ha sido deshabilitado.\"); </script>";
                    } else {
                        header('location: index.php');    
                    }	
                }else{
                    header('location: login.php?error=Cedula o Password incorrecta');
                    exit();                        
                }
            }
        }
    }else{
        header('location: login.php');
        exit();
    }
?>