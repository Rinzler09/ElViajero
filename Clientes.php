<?php

session_start();

if ($_SESSION['maestros'] != '1') {
    header("location: " . $_SESSION['pagina']);
}

include("encabezado.php");

$_SESSION['pagina'] = basename(__FILE__);

if (isset($_GET['Message'])) {
    echo $_GET['Message'];
}

?>

<?php
require_once "conexion.php";

$con = new conexion();


?>

<?php

if (isset($_POST['add'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
  
    if ($_POST['telefono'] != "")
        $telefono = $_POST['telefono'];
    else
        $telefono = "NULL";


    // $query = "INSERT INTO clientes (nombre, telefono) 
    //     VALUES ('$nombre',$telefono)";

    $query = "INSERT INTO clientes (nombre,apellido, telefono, DNI) 
        VALUES ('$nombre','$apellido', $telefono, '$dni')";

    $con->probar($query);

    echo "<script>toastr.success('¡Cliente creado correctamente!','Aviso!');</script>";
    //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Cliente creado correctamente!</p></center>";

}


if (isset($_POST['edit'])) {
    $id = $_POST['idcliente'];
    $nombre = $_POST['nombreAct'];
    $apellido = $_POST['apellidoAct'];
    $dni = $_POST['dniAct'];

    if ($_POST['telefonoAct'] != "")
        $telefono = $_POST['telefonoAct'];
    else
        $telefono = "NULL";

    // $query = "UPDATE clientes 
    //     SET nombre='$nombre', telefono=$telefono
    //     WHERE idcliente=$id";

    $query = "UPDATE clientes 
                 SET nombre = '$nombre', apellido = '$apellido', telefono = $telefono, DNI = '$dni'
                 WHERE idcliente = $id";

    $con->probar($query);

    echo "<script>toastr.success('¡Cliente actualizado correctamente!','Aviso!');</script>";
    //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>Cliente actualizado correctamente!</p></center>";
}


if (isset($_POST['del'])) {
    $id = $_POST['idClienteDel'];

    $query = "DELETE FROM clientes
        WHERE idcliente = $id";

    $con->probar($query);

    echo "<script>toastr.success('¡Cliente eliminado correctamente!','Aviso!');</script>";
    //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Cliente eliminado correctamente!</p></center>";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de Clientes</title>

    <script src="busquedaClientes.js"></script>


    <style type="text/css">
        .wrapper {
            width: 800px;
            margin: 0 auto;
        }

        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin-right: 15px;
        }

        .fa-edit {
            color: #31E814;
        }

        .fa-trash {
            color: red;
        }

        #buscar {
            width: 400px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(['[data-toggle="tooltip"]']).tootltip();
        });
    </script>

</head>

<body>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Administrar Clientes</h2>
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Cliente</a>
                    </div>
                    <div class="form-group">
                        <label>Buscar</label>
                        <input type="text" name="buscar" id="buscar" class="form-control"><br>

                        <div id="datos">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>