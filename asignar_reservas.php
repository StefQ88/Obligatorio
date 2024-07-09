<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asignar Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-home.css">
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asignar Reservas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style-home.css">
    </head>

<body>

    <?php
    include_once "comun.php";

    if ($_SESSION['usuario']['tipoUsuario'] != 'administrador') {
        header('Location: index.php');
        exit();
    }
    ?>

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
                    <li><a href="index.php">OfficeSpaces</a></li>
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
  
    <?php
                if (isset($_GET['error'])){ ?>
                    <p class="error"><?php echo $_GET['error']; }?></p>
                <?php if (isset($_GET['exito'])){ ?>
                    <p class="exito"><?php echo $_GET['exito']?></p> 
            <?php }?>
    <div class="container">
        <h2>Asignar Reserva</h2>
        <form action="procesar_reserva.php" method="post">
            <div class="mb-3">
                <label for="sala" class="form-label">Sala</label>
                <select name="sala" class="form-select">
                    <?php $sala->listarSalas(); ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fechaReserva" class="form-label">Fecha de la reserva</label>
                <input type="date" name="fechaReserva" class="form-control">
            </div>
            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora de Inicio</label>
                <input type="time" name="horaInicio" class="form-control">
            </div>
            <div class="mb-3">
                <label for="horaFin" class="form-label">Hora de Fin</label>
                <input type="time" name="horaFin" class="form-control">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <select name="usuario" class="form-select">
                    <?php $usuario->listarUsuarios(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Reserva</button>
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