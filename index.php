<?php 
//session_start();
include_once "comun.php";
include_once "tablas.php";
include_once "class/datos.php";
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style-home.css">
</head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="index.php">Inicio</a></li>
            <?php if($_SESSION['usuario']['tipoUsuario'] == 'administrador'){?>
            <li><a href="#">Asignacion de reservas</a></li>
            <li><a href="#">Ingreso de salas</a></li>
            <?php } ?>
            <li><a href="#">Historial de reservas</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="logout.php">Salir</a></li>
        </ul>
        <ul>
            <li><a href="test.php">OfficeSpaces</a></li>
            <li> Hello, <?php echo $_SESSION['usuario']['primerNombre']; ?></li>
                
            <li>    
                <?php if (empty($_SESSION['usuario']['fotoPerfil'])){?>
                    <img src="uploads/default-pp.png" class="img-fluid rounded-circle" style="width: 6%;">
                <?php ;}else{?>
                    <img src="uploads/<?=$_SESSION['usuario']['fotoPerfil']?>" class="img-fluid rounded-circle">
                <?php ;}?>
            </li>
            <li onclick=showSidebar()><a href="#"> <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> </a>
        </ul>
    </nav>
    <a href="logout.php">Logout</a>
    <h2>Tabla de Salas</h2>
    <table>
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
                <td><?php echo $_SESSION['usuario']['ci'] ?> A</td>
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
    </table>


    <?php 
        $ciEmpleado = $_SESSION['usuario']['ci'];
        
        $dato->buscarDatos($ciEmpleado);
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

    
</body>
</html>

<?php 
}else{
    header("Location: login.php");
    exit();
}
?>