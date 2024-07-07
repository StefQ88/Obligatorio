<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UFT-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> REGISTRO </title>
        <link rel="stylesheet" type="text/css" href="css/style-home.css">
    </head>
    <body>
        <div class="container">
            <div class="title">Registro</div>
            <?php
                /*if (isset($_COOKIE['errorLogin']))
                    echo "<p>" . $_COOKIE['errorLogin'] . "</p>";*/
                if (isset($_GET['error'])){ ?>
                    <p class="error"><?php echo $_GET['error']; }?></p>
                <?php if (isset($_GET['exito'])){ ?>
                    <p class="exito"><?php echo $_GET['exito']?></p> 
            <?php }?>
            <div class="content">
                <form action="registro.php" method="post" enctype="multipart/form-data">
                    <div class="detalles-usuario">
                        <div class="input-box" >
                            <span class="detalles">Cedula de Identidad</span>
                            <input type="text" name="CI" placeholder="Cedula de Identidad">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Primer Nombre</span>
                            <input type="text" name="primerNombre" placeholder="Primer Nombre">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Segundo Nombre</span>
                            <input type="text" name="segundoNombre" placeholder="Segundo Nombre">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Primer Apellido</span>
                            <input type="text" name="primerApellido" placeholder="Primer Apellido">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Segundo Apellido</span>
                            <input type="text" name="segundoApellido" placeholder="Segundo Apellido">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Fecha de Nacimiento </span>
                            <input type="date" name="fechaNacimiento" placeholder="fechaNacimiento">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Email</span>
                            <input type="text" name="email" placeholder="Email">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Foto de Perfil </span>
                            <input type="file" name="fotoPerfil" placeholder="fotoPerfil">
                        </div>
                        <div class="input-box" >
                            <span class="detalles">Password</span>
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <!--<div class="input-box" >
                            <span class="detalles">Repetir Contraseña </span>
                            <input type="password" name="#" placeholder="Por favor repita la Contraseña" required>
                        </div>-->
                        <div class = "tipoUsuario-detalles">
                            <span class="tipo-titulo">Tipo de Usuario</span><br>
                            <input type="radio" id="administrador" name="tipoUsuario" value="administrador">
                            <label for="administrador">Administrador</label><br>

                            <input type="radio" id="empleado" name="tipoUsuario" value="empleado">
                            <label for="empleado">Empleado</label>
                        </div>
                        
                        <div class="button">
                            <input type="submit" name="login" value="Registrar"><br>
                            <a href="login.php">Volver</a>
                        </div>

                    </div>
                </form>
                
            </div>
        </div> 
    </body>