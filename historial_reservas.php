<?php
include_once "comun.php";
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
    $datos = new datos();
    $ciEmpleado = $user['ci']; // Asumiendo que el CI del empleado está en la sesión
    $esAdministrador = ($_SESSION['usuario']['tipoUsuario'] == 'administrador')
?>
    <!DOCTYPE html>
    <html>

    <head>
        <script src="../assets/js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="600; url=login.php?error=La session expiro">
        <title>Historial de Reservas</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

        <link rel="stylesheet" type="text/css" href="css/style-home.css">


    </head>

    <body>
        <nav>
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000">
                            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></a></li>
                <?php if ($_SESSION['usuario']['tipoUsuario'] == 'empleado') { ?>
                    <li><?php echo $_SESSION['usuario']['primerNombre'] ?></li>
                    <li><?php echo $_SESSION['usuario']['primerApellido'] ?></li>
                    <?php if (empty($_SESSION['usuario']['fotoPerfil'])) { ?>
                        <li> <img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;"> </li>
                    <?php } else { ?>
                        <li> <img src="uploads/<?= $_SESSION['usuario']['fotoPerfil'] ?>" class="img-fluid rounded-circle"> </li>
                    <?php } ?>
                    </li>
                <?php } else if ($_SESSION['usuario']['tipoUsuario'] == 'administrador') { ?>
                    <li><a href="index.php">OfficeSpaces</a></li>
                    <li> <img src="uploads/oficina.png" class="img-fluid rounded-circle"> </li>

                <?php } ?>
                <li><a href="index.php">Inicio</a></li>
                <?php if ($_SESSION['usuario']['tipoUsuario'] == 'administrador') { ?>
                    <li><a href="#">Asignacion de reservas</a></li>
                    <li><a href="ingresar_sala.php">Ingreso de salas</a></li>
                <?php } ?>
                <li><a href="#">Historial de reservas</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="logout.php">Salir</a></li>
            </ul>
            <ul>

                <li><a href="index.php">OfficeSpaces</a></li>
                <li onclick=showSidebar()><a href="#"> <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg> </a>
            </ul>
        </nav>
        <?php
        $datos->mostrarHistorialReservas($ciEmpleado, $esAdministrador);
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
} else {
    header("Location: login.php");
    exit();
}
?>