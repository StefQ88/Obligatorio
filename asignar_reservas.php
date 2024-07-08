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
    <div class="container">
        <h2>Asignar Reserva</h2>
        <form action="procesar_reserva.php" method="post">
            <div class="mb-3">
                <label for="sala" class="form-label">Sala</label>
                <select name="sala" class="form-select" required>
                    <?php $sala->listarSalas(); ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fechaReserva" class="form-label">Fecha de la reserva</label>
                <input type="date" name="fechaReserva" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora de Inicio</label>
                <input type="time" name="horaInicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="horaFin" class="form-label">Hora de Fin</label>
                <input type="time" name="horaFin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <select name="usuario" class="form-select" required>
                    <?php $usuario->listarUsuarios(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Reserva</button>
        </form>
    </div>
</body>
</html>
