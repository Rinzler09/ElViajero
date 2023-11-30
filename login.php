<?php

  session_start();

   /* if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }  */

  $message = '';

if($_POST)
{
  require("conexion.php");
  $con = new conexion();


  $usuario = filter_var($_POST["usuario"], FILTER_SANITIZE_STRING);
  $pass = filter_var($_POST["contrasena"], FILTER_SANITIZE_STRING);

  /* $sql = "SELECT nombreUsuario, password, nombre FROM usuarios us INNER JOIN empleados em ON us.idempleado = em.idempleado 
  WHERE nombreUsuario ='". $usuario ."' AND  password = '". $pass . "' AND estado <> 0";
 */

 $sql = "SELECT username, pass, nombre FROM usuarios us INNER JOIN empleados em
        ON us.idempleado = em.idempleado
        WHERE username = '". $usuario . "' AND pass = '". $pass . "' AND estado <> 0";

  $resultado = $con->consulta($sql);

  if(count($resultado)> 0)
  {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['passw'] = $passw;
    $_SESSION['nombre'] = $resultado[0]['nombre'];
    $_SESSION['estado'] = '1';
    header("Location:index.php");
  }
  else
  {
    $message = 'Lo siento, sus credenciales son incorrectas';
  }

}
 

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="estilos.css">
    <title>El Viajero, Login</title>
</head>

<body>

<div class="error-message-container <?php echo !empty($message) ? 'show' : ''; ?>">
        <p><?= $message ?></p>
    </div>


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

        function hideErrorMessage() {
        document.querySelector('.error-message-container').classList.remove('show');
    }

    </script>





    <!-- Scripts de Bootstrap (asegúrate de incluir jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>