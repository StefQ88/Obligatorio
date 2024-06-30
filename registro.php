<?php 
    include_once "comun.php";
    if (isset($_POST['login'])){
        $CI = $_POST ['CI'];
        $primerNombre = $_POST['primerNombre'];
        $segundoNombre = $_POST['segundoNombre'];
        $primerApellido = $_POST['primerApellido'];
        $segundoApellido = $_POST['segundoApellido'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $email = $_POST['email'];
        $fotoPerfil = $_FILES['fotoPerfil']['name'];
        $password = $_POST['password'];
        $tipoUsuario = $_POST['tipoUsuario'];

        if ($usuario->verficarDatos($email, $password) == FALSE){ 
            if (isset($fotoPerfil) or empty($fotoPerfil)){
                $fotoSize = $_FILES['fotoPerfil']['size'];
                $tmpName = $_FILES['fotoPerfil']['tmp_name'];
                $error = $_FILES['fotoPerfil']['error'];
                if ($error === 0 or empty($fotoPerfil)){
                    $imgRuta = pathinfo($fotoPerfil, PATHINFO_EXTENSION);
                    $imgMinusculas = strtolower($imgRuta);
                    
                    //$ext = array('jpg', 'jpeg', 'png', 'gif');
                    if(in_array($imgMinusculas, array('jpg', 'jpeg', 'png', 'gif')) and !empty($fotoPerfil)){
                        $newImgName = uniqid($CI, true).'.'.$imgMinusculas;
                        $imgUploadPath = 'uploads/'.$newImgName;
                        move_uploaded_file($tmpName, $imgUploadPath);

                        //---------------------------------------
                        //INSERTO EN LA BASE DE DATOS 
                        $usuario->insertUsuario($CI, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $newImgName, $password, $tipoUsuario);
                        header('location: login.php?exito=el usuario fue registrado con exito!');

                        //---------------------------------------
                    }else if(empty($fotoPerfil)){
                        $usuario->insertUsuario($CI, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, '', $password, $tipoUsuario);
                        
                        header('location: login.php?exito=el usuario fue registrado con exito!');
                    }else{
                        header("Location: login.php?error=el formato de la foto no es valido");
                        exit();
                    }
                }else{
                        header("Location: login.php?error=error desconocido");
                        exit();
                    }
            }else{
                header('location: login.php?error=el usuario ya esta registrado');
            }
        }



    }
?>