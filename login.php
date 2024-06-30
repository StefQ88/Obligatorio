<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <form method="post" action="login_session.php">
            <h1>Login</h1>
            <?php
                /*if (isset($_COOKIE['errorLogin']))
                    echo "<p>" . $_COOKIE['errorLogin'] . "</p>";*/
                if (isset($_GET['error'])){ ?>
                    <p class="error"><?php echo $_GET['error']; }?></p>
                <?php if (isset($_GET['exito'])){ ?>
                    <p class="exito"><?php echo $_GET['exito']?></p> 
            <?php }?>

            <div class="input-box">
                <input type="text" placeholder="Username" name="email" >
                <!--ICONO DE USUARIO -->
                <!--<i class='bx bxs-user'></i>-->
                <i class='bx bxs-user-circle' ></i>
            </div>
            
            <div class="input-box-pass">
                <input type="password" placeholder="Password" name="password" >
                <!--ICONO DE PASSWORD -->
                <box-icon name='lock-alt' ></box-icon>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <!--<div class="remember-forgot">
                <label>
                    <input type="checkbox"> Remember me
                </label>
                <a href="#">Forgot password?</a>
            </div>-->
            <!--<input type="submit" name="Login" value= "Login">-->
            <button type="submit" name="Login" class="btn">Login</button>

            <div class="registro-link">
                <p>¿No tengo cuenta? <a href="registro.html">Registrarse</a></p>
            </div>
        </form>
    </div>
</body>
</html>