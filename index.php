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
    <meta http-equiv="refresh" content="600; url=login.php?error=La session expiro">
	<title>Home</title>
    
    <!--<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link rel="stylesheet" type="text/css" href="css/style-home.css">

    
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
           
                <li><a href="test.php">OfficeSpaces</a></li>
            <li onclick=showSidebar()><a href="#"> <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </a>
        </ul>
    </nav>
    <!--<header class="p-3 text-bg-dark">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Inicio</a></li>
          <?php if($_SESSION['usuario']['tipoUsuario'] == 'administrador'){?>
            <li><a href="#" class="nav-link px-2 text-white">Asignacion de reservas</a></li>
            <li><a href="ingresar_sala.php" class="nav-link px-2 text-white">Ingreso de salas</a></li>
            <?php } ?>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>
        <ul class="nav col-30 col-lg-auto me-lg-auto mb-6 justify-content-center mb-md-0">
            <li> Hola, <?php echo $_SESSION['usuario']['primerNombre']; ?></li>
            <li>  <?php $_SESSION['usuario']['primerApellido']; ?></li>
        </ul>
        <ul class="nav col-30 col-lg-auto me-lg-auto mb-6 justify-content-center mb-md-0">
            <li onclick=showSidebar()>
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                <?php if (empty($_SESSION['usuario']['fotoPerfil'])){?>
                        <img src="uploads/default-pp.png" width="32" height="32"  class="img-fluid rounded-circle">
                    <?php ;}else{?>
                        <img src="uploads/<?=$_SESSION['usuario']['fotoPerfil']?>" width="32" height="32"  class="img-fluid rounded-circle">
                    <?php ;}?>
            </a>
            </li>
        </ul>
        <ul class="sidebar nav col-30 col-lg-auto me-lg-auto mb-6 mb-md-0">
            <li onclick=hideSidebar()>
                <a href="#"> 
                    <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </a>
            </li>
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
      </div>
  </header>-->
  
    <?php
                /*if (isset($_COOKIE['errorLogin']))
                    echo "<p>" . $_COOKIE['errorLogin'] . "</p>";*/
                if (isset($_GET['error'])){ ?>
                    <p class="error"><?php echo $_GET['error']; }?></p>
                <?php if (isset($_GET['exito'])){ ?>
                    <p class="exito"><?php echo $_GET['exito']?></p> 
            <?php }?>
    <a href="logout.php">Logout</a>
    
    <!--<table>
        <thead>
            <tr>
                <th>Imagen de la Sala</th>
                <th>Nombre de la Sala</th>
                <th>Capacidad de la Sala</th>
                <th>Fecha y Hora de Inicio</th>
                <th>Fecha y Hora de Fin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="ruta/a/imagen1.jpg" alt="Imagen Sala 1"></td>
                <td> A</td>
                <td>50</td>
                <td>2024-07-01 09:00</td>
                <td>2024-07-01 11:00</td>
            </tr>
            <tr>
                <td><img src="ruta/a/imagen2.jpg" alt="Imagen Sala 2"></td>
                <td>Sala B</td>
                <td>30</td>
                <td>2024-07-01 12:00</td>
                <td>2024-07-01 14:00</td>
            </tr>
            <tr>
                <td><img src="ruta/a/imagen3.jpg" alt="Imagen Sala 3"></td>
                <td>Sala C</td>
                <td>20</td>
                <td>2024-07-02 10:00</td>
                <td>2024-07-02 12:00</td>
            </tr>
        </tbody>
    </table> -->


    <?php 
    
        if ($_SESSION['usuario']['tipoUsuario']== 'empleado'){
            //$ciEmpleado = $_SESSION['usuario']['ci'];
            $dato->buscarDatos($_SESSION['usuario']['ci']);
        }else if ($_SESSION['usuario']['tipoUsuario']== 'administrador'){
            $dato->buscarDatos2($_SESSION['usuario']['ci']);
        }
                    /*
        crearTabla();
        crearCabezal("id sala", "ci empleado", "hora de inicio", "hora de fin");
        
        
        cerrarTabla();*/
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

<!--<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>-->

    
</body>
</html>

<?php 
}else{
    header("Location: login.php");
    exit();
}
?>