<?php

    session_start();
    
    if($_SESSION['maestros'] != '1')
    {
    header("location: " . $_SESSION['pagina']);
    }


    include("encabezado.php");

    $_SESSION['pagina'] = basename(__FILE__);
    
    if(isset($_GET['Message'])){
        echo $_GET['Message'];
    }
  

?>

<?php
    require_once "conexion.php";
    
    $con = new conexion();   

    
    /*$sql = "SELECT * FROM cargo";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT * FROM cargo
        WHERE cargo LIKE '%". $f;
    }

    $con->probar($sql);*/
                        
?>

<?php
    //include("conexion.php");
        
    if(isset($_POST['add']))
    {        
        
        $nombre = $_POST['nombre'];  
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
       
        $query = "INSERT INTO destinos (nombre, descripcion, precio) 
        VALUES ('$nombre','$descripcion','$precio')";
        
        $con->probar($query);
        
        echo "<script>toastr.success('Destino creado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Empleado creado correctamente!</p></center>";

       // move_uploaded_file($_FILES['archivo']['tmp_name'], 'imagenes/empleados/'.$_FILES['archivo']['name']);

    }


    if(isset($_POST['edit']))
    {       
        $id = $_POST['idDestinoAct']; 
        $nombre = $_POST['nombreAct'];  
        $descripcion = $_POST['descripcionAct'];        
        $precio = $_POST['precioAct'];            
       
        $query = "UPDATE destinos 
        SET nombre='$nombre', descripcion='$descripcion', precio=$precio
        WHERE destinoId=$id";
            
        $con->probar($query);
        
        echo "<script>toastr.success('Destino actualizado correctamente!','Aviso!');</script>";
        
        
        
        
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Empleado actualizado correctamente!</p></center>";
        
      //  move_uploaded_file($_FILES['archivoAct']['tmp_name'], 'imagenes/empleados/'.$_FILES['archivoAct']['name']);
    }


    if(isset($_POST['del']))
    {        
        $id = $_POST['idDestinoDel'];
        
        $query = "DELETE FROM destinos
        WHERE destinoId = $id";
        
        $con->probar($query);

        echo "<script>toastr.success('Destino eliminado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Empleado eliminado correctamente!</p></center>";     
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de Destinos</title>    
    
    <script src="busquedaDestinos.js"></script>
    

    <style type="text/css">
        .wrapper{
            width: 900px;
            margin: 0 auto;
            font-size: 14px;
        }
        .page-header h2{
            margin-top: 0;
        }

        table tr td:last-child a{
            margin-right: 0px;
        }

        #imgIcon{
            color: #D8A30B;
        }

        .fa-edit{
            color: #31E814;
        }

        .fa-trash{
            color: red;
        }

        #buscar
        {
            width: 400px;
        }

    </style>

    <script>
        $(document).ready(function(){
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
                        <h2 class="pull-left">Administrar Destinos</h2>                      
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Destinos</a>
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