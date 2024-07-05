<?php  
include_once "comun.php";

if (isset($_SESSION['usuario'])) {

if(isset($_POST['actualizar'])){

    $primerNombre = $_POST['primerNombre'];
    $segundoNombre = $_POST['segundoNombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $email = $_POST['email'];
    $fotoVieja = $_FILES['fotoPerfil']['name'];
    //$id = $_SESSION['id'];

   /* echo "<p>".$primerNombre . "</p>";
    echo "<p>".$segundoNombre. "</p>";
    echo "<p>".$primerApellido. "</p>";
    echo "<p>".$segundoApellido. "</p>";
    echo "<p>".$fechaNacimiento. "</p>";
    echo "<p>".$email. "</p>";
    echo "<p>". $fotoVieja. "</p>";*/

    if (empty($primerNombre)) {
    	$em = "el primer nombre es requerido";
    	header("Location: perfil.php?error=$em");
	    exit;
    }else if(empty($primerApellido)){
    	$em = "El primer apellido es requerido";
    	header("Location: perfil.php?error=$em");
	    exit;
    }else {

      if (isset($_FILES['fotoPerfil']['name']) || empty($_FILES['fotoPerfil']['name'])) {
         
        
         $img_name = $_FILES['fotoPerfil']['name'];
         $tmp_name = $_FILES['fotoPerfil']['tmp_name'];
         $error = $_FILES['fotoPerfil']['error'];
         
         if($error === 0 or empty($img_name)){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $newImgName = uniqid($_SESSION['usuario']['ci'], true).'.'.$img_ex_to_lc;
               $img_upload_path = 'uploads/'.$newImgName;
               move_uploaded_file($tmp_name, $img_upload_path);
               //harcodear estos valores 
               $usuario->actualizarUsuario('12345679','Agustin', 'Santiago', 'Sastre', 'Sibilia', '1955-05-05', 'mail@mail.com', 'imagenNuevaHOLA');
               //$usuario->actualizarUsuario($_SESSION['usuario']['ci'],$primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $newImgName);
               header("Location: perfil.php?success=Your account has been updated successfully");
                exit;
            }else if(empty($img_name)){
               $usuario->actualizarUsuario($_SESSION['usuario']['ci'],$primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, '');
               //$usuario->actualizarUsuario($_SESSION['usuario']['ci'],'Agustin', 'Santiago', 'Sastre', 'Sibilia', '1955-05-05', 'mail@mail.com', 'imagenNueva');
               header("Location: perfil.php?success=Your account has been updated successfully");
           }else{
               header("Location: perfil.php?error=$em&$data");
               exit();
           }{
               $em = "You can't upload files of this type";
               header("Location: perfil.php?error=$em&$data");
               exit;
            }
         }else { //si la foto es vacia 
            $em = "unknown error occurred!";
            header("Location: perfil.php?error=$em&$data");
            exit;
         }

        
      }else {
       	header("Location: perfil.php?success=Your account has not been updated successfully");
   	    exit;
      }
    }


}else {
	header("Location: perfil.php?error=error");
	exit;
}


}else {
	header("Location: login.php");
	exit;
} 