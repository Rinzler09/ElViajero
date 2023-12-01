<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="estiloslogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">

    <title>El Viajero, Login</title>
</head>

<body>

    <!-- Contenedor del login -->
    <div class="login-container">
        <img src="img/user.png" alt="user"><br><br><br>
        <h2 class="text-center">Inicio de Sesión</h2>
        <!-- Formulario de inicio de sesión utilizando clases de Bootstrap -->
        <form method="POST" action="">
            <div class="form-group input-group">
                <div class="input-group-text">
                    <i class="bi bi-person-fill bi-6x"></i>
                    <!-- <label for="usuario">Usuario:</label> -->
                </div>
                <input type="text" class="form-control form-control-lg" id="usuario" name="usuario" placeholder="Ingrese su usuario" required onclick="hideErrorMessage()">
            </div>
            <div class="form-group input-group">
                <div class="input-group-text">
                    <i class="bi bi-lock-fill icon-bigger"></i>

                    <!-- <label for="contrasena">Contraseña:</label> -->
                </div>
                <input type="password" class="form-control form-control-lg" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>

        </form>
    </div>

    <!-- Contenedor de Bienvenida -->
    <div class="welcome-container" id="welcomeContainer">
        <h2>Bienvenidos a El Viajero !</h2><br>
        <p>Descubre el mundo con El Viajero, tu socio confiable para experiencias aéreas y terrestres inolvidables. Ofrecemos servicios de reserva de vuelos, emocionantes recorridos terrestres. Nuestro equipo dedicado garantiza atención personalizada para hacer de tu viaje una experiencia única. ¡Viaja con nosotros y haz realidad tus sueños!</p>
        <img src="img/viajes-bus.png" alt="El Viajero" class="active">
        <img src="img/vuelos-aereos.png" alt="El Viajero">
    </div>

    <script>
        // Función para alternar entre las imágenes automáticamente
        document.addEventListener("DOMContentLoaded", function() {
            let images = document.querySelectorAll('.welcome-container img');
            let activeIndex = 0;

            setInterval(function() {
                images[activeIndex].classList.remove('active');
                activeIndex = (activeIndex + 1) % images.length;
                images[activeIndex].classList.add('active');
            }, 3000); // Cambiar cada 3000 milisegundos (3 segundos)
        });

    </script>


    <script>
        //importamos configuraciones de toastr para los mensajes emergentes
        toastr.options = {
            "positionClass": "toast-top-center",
        }
    </script>


    <!-- verificar que el usuario que esta ingresando exista en la base de datos -->
    <?php
    session_start();
    
    if($_POST)
    {
        require("conexion.php");
        $con = new conexion();   

        //$usuario = $_POST['usuario'];
        //$pass = $_POST['contrasena'];


       $usuario = filter_var( $_POST['usuario'], FILTER_SANITIZE_STRING);
       $pass = filter_var($_POST['contrasena'], FILTER_SANITIZE_STRING);
        
    
        $sql = "SELECT username, pass, nombre FROM usuarios us INNER JOIN empleados em
        ON us.idempleado = em.idempleado
        WHERE username = '". $usuario . "' AND pass = '". $pass . "' AND estado <> 0";
        
        $resultado = $con->consulta($sql);

        if(count($resultado) > 0)
        {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['passw'] = $pass;
            $_SESSION['nombre'] = $resultado[0]['nombre'];
            $_SESSION['estado'] = '1';
            header("location:index.php");
        }
        else
        {
            echo "<script>toastr.error('Usuario/password incorrecto','Aviso!');</script>";
            //echo "<script>alert('Usuario o contrasena incorrecto');</script>";
        }
    }

    if(isset($_GET["stat"]))
    {        
        session_destroy();
    }
?>

</body>

</html>