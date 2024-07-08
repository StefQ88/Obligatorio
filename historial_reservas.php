<?php
// test.php

include_once "comun.php";
require_once "class/datos.php";

if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
    $datos = new datos();
    $ciEmpleado = $user['ci']; // Asumiendo que el CI del empleado está en la sesión
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Reservas</title>
    <link rel="stylesheet" type="text/css" href="css/style-home.css">
</head>
<body>

    <!-- Barra de navegación y otros elementos HTML/PHP -->

    <section class="historial-reservas">
        <?php
        // Llamar a la función para mostrar el historial de reservas aquí
        $datos->mostrarHistorialReservas($ciEmpleado);
        ?>
    </section>

    <!-- Otros elementos HTML/PHP -->

    <script>
        // Código JavaScript si es necesario
    </script>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit();
}
?>
