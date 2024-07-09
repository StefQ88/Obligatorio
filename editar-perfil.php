<?php
include_once "comun.php";

if (isset($_SESSION['usuario'])) {

   if (isset($_POST['actualizar'])) {

      $primerNombre = $_POST['primerNombre'];
      $segundoNombre = $_POST['segundoNombre'];
      $primerApellido = $_POST['primerApellido'];
      $segundoApellido = $_POST['segundoApellido'];
      $fechaNacimiento = $_POST['fechaNacimiento'];
      $email = $_POST['email'];
      //$fotoVieja = $_FILES['fotoPerfil']['name'];

      if (empty($primerNombre)) {
         header("Location: perfil.php?error=el primer nombre es requerido");
         exit;
      } else if (empty($primerApellido)) {
         header("Location: perfil.php?error=el primer apellido es requerido");
         exit;
      } else if (empty($segundoApellido)) {
         header("Location: perfil.php?error=El segundo apellido es requerido");
         exit;
      }else if (empty($fechaNacimiento)) {
         header("Location: perfil.php?error=La fecha de nacimiento es requerida");
         exit;
      }else if (empty($email)) {
         header("Location: perfil.php?error=El email es requerido");
         exit;
      }else {

         if (isset($_FILES['fotoPerfil']['name']) || empty($_FILES['fotoPerfil']['name'])) {


            $img_name = $_FILES['fotoPerfil']['name'];
            $tmp_name = $_FILES['fotoPerfil']['tmp_name'];
            $error = $_FILES['fotoPerfil']['error'];

            if ($error === 0 or empty($img_name)) {
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
               $img_ex_to_lc = strtolower($img_ex);

               $allowed_exs = array('jpg', 'jpeg', 'png');
               if (in_array($img_ex_to_lc, $allowed_exs)) {
                  $newImgName = uniqid($_SESSION['usuario']['ci'], true) . '.' . $img_ex_to_lc;
                  $img_upload_path = 'uploads/'.$newImgName;
                  move_uploaded_file($tmp_name, $img_upload_path);
                  $usuario->actualizarUsuario($_SESSION['usuario']['ci'], $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $newImgName);
                  header("Location: perfil.php?success=Your account has been updated successfully");
                  exit;
               } else if (empty($img_name)) {
                  $usuario->actualizarUsuario($_SESSION['usuario']['ci'], $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, '');
                  header("Location: perfil.php?success=Your account has been updated successfully");
               } else {
                  header("Location: perfil.php?error=no se puede actulizar los datos");
                  exit();
               }
            } else {
               header("Location: perfil.php?error=error desconocido");
               exit;
            }
         } else {
            header("Location: perfil.php?success=Your account has not been updated successfully");
            exit;
         }
      }
   } else {
      header("Location: perfil.php?error=error");
      exit;
   }
} else {
   header("Location: login.php");
   exit;
}
