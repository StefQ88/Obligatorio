<?php 
    include_once "comun.php";

    if (isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style-home.css">
    <meta http-equiv="refresh" content="600; url=login.php?error=La session expiro">
</head>
<body>

<nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <?php if ($_SESSION['usuario']['tipoUsuario']== 'empleado'){ ?>
                <li><?php echo $_SESSION['usuario']['primerNombre'] ?></li>
                <li><?php echo $_SESSION['usuario']['primerApellido'] ?></li>
                <?php if (empty($_SESSION['usuario']['fotoPerfil'])){?>
                    <li>    <img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;"> </li>
                <?php }else{?>
                    <li> <img src="uploads/<?=$_SESSION['usuario']['fotoPerfil']?>" class="img-fluid rounded-circle"> </li>
                <?php }?>
            </li>
            <?php }else if ($_SESSION['usuario']['tipoUsuario']== 'administrador'){ ?>
                <li><a href="test.php">OfficeSpaces</a></li>

            <?php } ?>
            <li><a href="index.php">Inicio</a></li>
            <?php if($_SESSION['usuario']['tipoUsuario'] == 'administrador'){?>
            <li><a href="#">Asignacion de reservas</a></li>
            <li><a href="ingresar_sala.php">Ingreso de salas</a></li>
            <?php } ?>
            <li><a href="#">Historial de reservas</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="logout.php">Salir</a></li>
        </ul>
        <ul>
                <li><a href="index.php">OfficeSpaces</a></li>
            <li onclick=showSidebar()><a href="#"> <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </a>
        </ul>
    </nav>

<div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" action="editar-perfil.php" method="post" enctype="multipart/form-data">
            <h4 class="display-4  fs-1">Edit Profile</h4><br>
            <!-- error -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- success -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
            <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
            
            <div class="mb-3">
                <label for="primerNombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="primerNombre" 
                value="<?php echo $_SESSION['usuario']['primerNombre']?>">
            </div>

            <div class="mb-3">
                <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="segundoNombre" 
                value="<?php echo $_SESSION['usuario']['segundoNombre']?>">
            </div>

            <div class="mb-3">
                <label for="primerApellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="primerApellido"  
                value="<?php echo $_SESSION['usuario']['primerApellido']?>">
            </div>

            <div class="mb-3">
                <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="segundoApellido" 
                value="<?php echo $_SESSION['usuario']['segundoApellido']?>">
            </div>

            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento" 
                value="<?php echo $_SESSION['usuario']['fechaNacimiento']?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                value="<?php echo $_SESSION['usuario']['email']?>">
            </div>
                
            <div class="mb-3">
            <label class="form-label">Foto Perfil</label>
            <input type="file" class="form-control" name="fotoPerfil">
            <?php if (empty($_SESSION['fotoPerfil'])){?>
                <img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 70px">
            <?php ;}else{?>
                <img src="uploads/<?=$_SESSION['fotoPerfil']?>" class="img-fluid rounded-circle" style="width: 70px">
            <?php ;}?>
            <input type="text" hidden="hidden" name="fotoVieja" value="<?=$_SESSION['usuario']['fotoPerfil']?>" >
            </div>
            <!--<div class="mb-3">
                <label for="fotoPerfil" class="form-label">Foto Perfil</label>
                <input type="file" class="form-control" name="fotoPerfil">
                <small id="fotoPerfilHelp" class="form-text text-muted">Seleccione una imagen para su foto de perfil.</small>
            </div>-->
            <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
            <a href="index.php" class="link-secondary">Inicio</a>
        </form>
    </div>
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

<?php }else{ 
    header("Location: login.php");
    }?>