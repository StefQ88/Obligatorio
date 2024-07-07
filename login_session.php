<?php
    require "comun.php";
    //include_once"Usuarios.php";
    //session_start();
    
    if (isset($_POST['Login']) /*&& isset($_POST['user']) && isset ($_POST['password'])*/) {
    
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email)){
            header('location: login.php?error=email is required');
            exit();
        }else if (empty($password)){
            header('location: login.php?error=password is required');
            exit();
        }else{
            if (postParamAndSet('email', $email) && postParamAndSet('password', $password)){
                if ($ciUser = $usuario->verficarDatos($email, $password)){
                    //SETEO LA SESSION
                    $_SESSION['usuario'] = $usuario->get($ciUser);
                    //SETEO LA COOKIE
                    setcookie("tiempoSession", "activa", time() + (60 * 10)); //$_COOKIE['tiempoSession'];
                    $estado = $usuario->getEstado();
                    if ($estado == 0){
                        echo "<script> alert (\"El usuario ha sido deshabilitado.\"); </script>";
                    } else {
                        header('location: index.php');    
                    }	
                }else{
                    header('location: login.php?error=Email o Password incorrecta');
                    exit();                        
                }
            }
        }
    }else{
        header('location: login.php');
        exit();
    }
?>