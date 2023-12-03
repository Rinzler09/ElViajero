<?php

session_start();

if ($_SESSION['transacciones'] != '1') {
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
    // Lógica para agregar una venta
    // ...
    echo "<script>toastr.success('¡Venta creada correctamente!','Aviso!');</script>";
}

if (isset($_POST['edit'])) {
    // Lógica para editar una venta
    // ...
    echo "<script>toastr.success('¡Venta actualizada correctamente!','Aviso!');</script>";
}

if (isset($_POST['del'])) {
    // Lógica para eliminar una venta
    // ...
    echo "<script>toastr.success('¡Venta eliminada correctamente!','Aviso!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>

    <script src="busquedaVenta.js"></script>

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
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>

<body>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Administrar Ventas</h2>
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Venta</a>
                    </div>
                    <div class="form-group">
                        <label>Buscar</label>
                        <input type="text" name="buscar" id="buscar" class="form-control"><br>

                        <div id="datos">
                            <!-- Aquí puedes mostrar los resultados de la búsqueda o la lista de ventas -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>