<?php

setlocale(LC_TIME, 'es_ES.UTF-8','esp');

    require_once "class/Usuarios.php";
    require_once "class/datos.php";
    require_once "class/SalaDeConferencias.php";


    function getParamAndSet($parameter, &$variable){
        if (isset($_GET[$parameter])){
            $variable = $_GET[$parameter];
            return true;
        } else {return false;}
    }

    function postParamAndSet($parameter, &$variable){
        if (isset($_POST[$parameter])){
            $variable = $_POST[$parameter];
            return true;
        } else {return false;}
    }

    $usuario = new Usuario();
    $dato = new Datos();
    $sala = new Sala();

    session_start();
    if (isset($_SESSION['usuario'])){
        if(isset($_COOKIE['tiempoSession'])){
            $_SESSION['usuario'] = $usuario->get($_SESSION['usuario']['ci']);
        }else{
            unset($_SESSION['usuario']);
            //header("Location: login.php");
            echo "<script>alert('la session expiro');window.location.href='login.php'</script>";
        }
        
    }else{
        unset($_SESSION['usuario']);
    }

    


?>