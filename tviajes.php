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
       
        $query = "INSERT INTO tipoviaje (nombre, descripcion) 
        VALUES ('$nombre','$descripcion')";
        
        $con->probar($query);
        
        echo "<script>toastr.success('Tipo de Viaje creado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Empleado creado correctamente!</p></center>";

       // move_uploaded_file($_FILES['archivo']['tmp_name'], 'imagenes/empleados/'.$_FILES['archivo']['name']);

    }


    if(isset($_POST['edit']))
    {       
        $id = $_POST['idTipoViajeAct']; 
        $nombre = $_POST['nombreAct'];  
        $descripcion = $_POST['descripcionAct'];
      
        
        
       
        $query = "UPDATE tipoviaje 
        SET nombre='$nombre', descripcion='$descripcion'
        WHERE tipoViajeId=$id";
            
        $con->probar($query);
        
        echo "<script>toastr.success('Tipo de Viaje actualizado correctamente!','Aviso!');</script>";
        
        
        
        
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Empleado actualizado correctamente!</p></center>";
        
      //  move_uploaded_file($_FILES['archivoAct']['tmp_name'], 'imagenes/empleados/'.$_FILES['archivoAct']['name']);
    }


    if(isset($_POST['del']))
    {        
        $id = $_POST['idTipoViajeaDel'];
        
        $query = "DELETE FROM tipoviaje
        WHERE tipoViajeId = $id";
        
        $con->probar($query);

        echo "<script>toastr.success('Aerolinea eliminado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Empleado eliminado correctamente!</p></center>";     
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="busquedaTipoViajes.js"></script>
    

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
                        <h2 class="pull-left">Administrar Tipo de Viajes</h2>                      
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Tipo de Viajes</a>
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