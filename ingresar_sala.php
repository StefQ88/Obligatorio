<?php
include_once "comun.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de nuevas salas de conferencias</title>
    <link rel="stylesheet" type="text/css" href="css/style-home.css">
</head>

<body>
<nav>
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000">
                            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></a></li>
                <div class="user-info">
                    <?php if ($_SESSION['usuario']['tipoUsuario'] == 'empleado') { ?>
                        <li><a><?php echo $_SESSION['usuario']['primerNombre'] ?></a></li>
                        <li><a><?php echo $_SESSION['usuario']['primerApellido'] ?></a></li>
                        <?php if (empty($_SESSION['usuario']['fotoPerfil'])) { ?>
                            <li> <a><img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;"></a> </li>
                        <?php } else { ?>
                            <li> <img src="uploads/<?= $_SESSION['usuario']['fotoPerfil'] ?>" class="img-fluid rounded-circle"> </li>
                        <?php } ?>
                    <?php } else if ($_SESSION['usuario']['tipoUsuario'] == 'administrador') { ?>
                        <li><a href="test.php">OfficeSpaces</a></li>
                        <li> <img src="uploads/oficina.png" class="img-fluid rounded-circle"> </li>
                </div>
            <?php } ?>
            <li><a href="index.php">Inicio</a></li>
            <?php if ($_SESSION['usuario']['tipoUsuario'] == 'administrador') { ?>
                <li><a href="asignar_reservas.php">Asignacion de reservas</a></li>
                <li><a href="ingresar_sala.php">Ingreso de salas</a></li>
            <?php } ?>
            <li><a href="historial_reservas.php">Historial de reservas</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="logout.php">Salir</a></li>
            </ul>
            <ul>
                <li><a href="index.php">OfficeSpaces</a></li>
                <?php if (empty($_SESSION['usuario']['fotoPerfil'])) { ?>
                    <li> <a><img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;"></a> </li>
                <?php } else { ?>
                    <li> <img src="uploads/<?= $_SESSION['usuario']['fotoPerfil'] ?>" class="img-fluid rounded-circle"> </li>
                <?php } ?>
                <li onclick=showSidebar()><a href="#"> <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg> </a>
            </ul>
        </nav>
    <div class="container">
        <div class="title">Ingreso de nueva sala</div>
        <div class="content">
            <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php } ?>
            <form action="procesar_ingreso_sala.php" method="post" enctype="multipart/form-data">
                <div class="detalles-usuario">
                    <div class="input-box">
                        <span class="detalles">Nombre de la Sala *</span>
                        <input type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="input-box">
                        <span class="detalles">Capacidad *</span>
                        <input type="number" name="capacidad" placeholder="Capacidad">
                    </div>
                    <div class="input-box">
                        <span class="detalles">Ubicacion *</span>
                        <input type="text" name="ubicacion" placeholder="Ubicacion">
                    </div>
                    <div class="input-box">
                        <span class="detalles">Equipamiento Disponible</span>
                        <textarea name="equipamientoDisponible" rows="3" placeholder="proyector, pizarra, etc."></textarea>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Estado * </span>
                        <select name="estado">
                            <option value="disponible">disponible</option>
                            <option value="no_disponible">no disponible</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Foto de la Sala *</span>
                        <input type="file" name="foto">
                    </div>
                    <div class="button">
                        <input type="submit" value="Registrar"><br>
                    </div>
                    
                </div>
            </form>
                <div>
                    <p>Los campos con * son requeridos</p><br>
                </div>
        </div>
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