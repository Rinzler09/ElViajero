

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    

</head>

<body>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                                                
                </div>
                <div class="col-md-4">
                <br><br><br><br><br>
                <div class="card">
                    <div class="card-header">
                        Inicio de Sesion
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            usuario: <input class="form-control" type="text" name="usuario"><br>
                            contrasena: <input type="password" class="form-control" name="contrasena"><br>
                            <center><button class="btn btn-primary" type="submit">Entrar</button></center>
                        </form>                                
                    </div>
                    </div>
                    <div class="card-footer text-muted">
                        
                    </div>
                </div>

                
                <div class="col-md-4">
        
                </div>
            </div>
        </div>
      
        <script>
            //importamos configuraciones de toastr
            toastr.options = {
            "positionClass": "toast-top-center",
            }

           
        </script>
        
        <style>
               .toast {
                    top: 20px;
                }     
        </style>
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