<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de nuevas salas de conferencias</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <div class="container">
        <div class="title">Ingreso de nueva sala</div>
        <div class="content">
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>"; //verifico si hay mensaje de error en la URL
            }
            ?>
            <form action="procesar_ingreso_sala.php" method="post" enctype="multipart/form-data">
                <div class="detalles-usuario">
                    <div class="input-box">
                        <span class="detalles">Nombre de la Sala</span>
                        <input type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Capacidad</span>
                        <input type="number" name="capacidad" placeholder="Capacidad" required>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Ubicacion</span>
                        <input type="text" name="ubicacion" placeholder="Ubicacion" required>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Equipamiento Disponible</span>
                        <textarea name="equipamientoDisponible" rows="3" placeholder="proyector, pizarra, etc."></textarea>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Estado</span>
                        <select name="estado">
                            <option value="disponible">disponible</option>
                            <option value="no_disponible">no disponible</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="detalles">Foto de la Sala</span>
                        <input type="file" name="foto" required>
                    </div>
                    <div class="button">
                        <input type="submit" value="Registrar"><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>