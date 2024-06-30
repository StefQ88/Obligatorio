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
    $fotoVieja = $_POST['fotoVieja'];
    //$id = $_SESSION['id'];

    if (empty($primerNombre)) {
    	$em = "el primer nombre es requerido";
    	header("Location: perfil.php?error=$em");
	    exit;
    }else if(empty($primerApellido)){
    	$em = "El primer apellido es requerido";
    	header("Location: perfil.php?error=$em");
	    exit;
    }else {

      if (isset($_FILES['fotoPerfil']['name']) AND !empty($_FILES['fotoPerfil']['name'])) {
         
        
         $img_name = $_FILES['fotoPerfil']['name'];
         $tmp_name = $_FILES['fotoPerfil']['tmp_name'];
         $error = $_FILES['fotoPerfil']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $newImgName = uniqid($_SESSION['usuario']['ci'], true).'.'.$img_ex_to_lc;
               $img_upload_path = 'uploads/'.$newImgName;
               // Delete old profile pic
              /* $old_pp_des = "uploads/$fotoVieja";
               if(unlink($old_pp_des)){
               	  // just deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }else {
                  // error or already deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }*/
               

               // update the Database
              /* $sql = "UPDATE users 
                       SET fname=?, username=?, pp=?
                       WHERE id=?";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$fname, $uname, $new_img_name, $id]);
               $_SESSION['fname'] = $fname;*/
               $usuario->actualizarUsuario($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $newImgName);
               header("Location: perfil.php?success=Your account has been updated successfully");
                exit;
            }else {
               $em = "You can't upload files of this type";
               header("Location: perfil.php?error=$em&$data");
               exit;
            }
         }else { //si la foto es vacia 
            $em = "unknown error occurred!";
            header("Location: perfil.php?error=$em&$data");
            exit;
         }

        
      }else {/*
       	$sql = "UPDATE users 
       	        SET fname=?, username=?
                WHERE id=?";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$fname, $uname, $id]);*/
        $usuario->actualizarUsuario($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $email, $newImgName);

       	header("Location: perfil.php?success=Your account has been updated successfully");
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