<?php 
//session_start();
include_once "comun.php";
include_once "class/datos.php";
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html>
<head><script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($_SESSION['usuario']['tipoUsuario']== 'empleado'){ ?>
    <meta http-equiv="refresh" content="600; url=login.php?error=La session expiro">
    <?php }else if ($_SESSION['usuario']['tipoUsuario']== 'administrador'){ ?>
    <meta http-equiv="refresh" content="3600; url=login.php?error=La session expiro">
    <?php }?>
	<title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link rel="stylesheet" type="text/css" href="css/style-home.css">

    
</head>
<body>
   <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <div class="user-info">
            <?php if ($_SESSION['usuario']['tipoUsuario']== 'empleado'){ ?>
                <li><a><?php echo $_SESSION['usuario']['primerNombre'] ?></a></li>
                <li><a><?php echo $_SESSION['usuario']['primerApellido'] ?></a></li>
                <?php if (empty($_SESSION['usuario']['fotoPerfil'])){?>
                    <li>    <a><img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;"></a> </li>
                <?php }else{?>
                    <li> <img src="uploads/<?=$_SESSION['usuario']['fotoPerfil']?>" class="img-fluid rounded-circle"> </li>
                <?php }?>
            <?php }else if ($_SESSION['usuario']['tipoUsuario']== 'administrador'){ ?>
                <li><img src="uploads/oficina.png" class="img-fluid rounded-circle"> </li>
                <li><a href="test.php">OfficeSpaces</a></li>
            </div>
            <?php } ?>
            <li><a href="index.php">Inicio</a></li>
            <?php if($_SESSION['usuario']['tipoUsuario'] == 'administrador'){?>
            <li><a href="asignar_reservas.php">Asignacion de reservas</a></li>
            <li><a href="ingresar_sala.php">Ingreso de salas</a></li>
            <?php } ?>
            <li><a href="historial_reservas.php">Historial de reservas</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="logout.php">Salir</a></li>
        </ul>
        <ul>
                <li><img src="uploads/oficina.png" class="img-fluid rounded-circle"> </li>
                <li><a href="index.php">OfficeSpaces</a></li>
                <?php if (empty($_SESSION['usuario']['fotoPerfil'])){?>
                    <li>    <a><img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;"></a> </li>
                <?php }else{?>
                    <li> <img src="uploads/<?=$_SESSION['usuario']['fotoPerfil']?>" class="img-fluid rounded-circle"> </li>
                <?php }?>
            <li onclick=showSidebar()><a href="#"> <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </a>
        </ul>
    </nav>
  
    <?php
                if (isset($_GET['error'])){ ?>
                    <p class="error"><?php echo $_GET['error']; }?></p>
                <?php if (isset($_GET['exito'])){ ?>
                    <p class="exito"><?php echo $_GET['exito']?></p> 
            <?php }?>


    <?php 
    
        if ($_SESSION['usuario']['tipoUsuario']== 'empleado'){
            $dato->buscarDatos($_SESSION['usuario']['ci']);
        }else if ($_SESSION['usuario']['tipoUsuario']== 'administrador'){
            $dato->buscarDatos2($_SESSION['usuario']['ci']);
        }
    ?>

    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex'
        }
        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none'
        }
    </script>

    
</body>
</html>

<?php 
}else{
    header("Location: login.php");
    exit();
}
?>