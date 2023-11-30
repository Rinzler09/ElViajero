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
?>

<?php
        
    if(isset($_POST['add']))
    {        
        
        $proveedor = $_POST['proveedor'];  
        $telefono = $_POST['telefono'];  
        $direccion = $_POST['direccion'];  


        $query = "INSERT INTO proveedores (proveedor, telefono, direccion) 
        VALUES ('$proveedor',$telefono,'$direccion')";
        
        $con->probar($query);
        
        echo "<script>toastr.success('¡Proveedor creado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Proveedor creado correctamente!</p></center>";
  
    }


    if(isset($_POST['edit']))
    {       
        $id = $_POST['idproveedor']; 
        $proveedor = $_POST['proveedorAct'];  
        $telefono = $_POST['telefonoAct'];  
        $direccion = $_POST['direccionAct'];       

        $query = "UPDATE proveedores 
        SET proveedor='$proveedor', telefono=$telefono, direccion='$direccion'
        WHERE idproveedor=$id";
        
        $con->probar($query);
        
        echo "<script>toastr.success('¡Proveedor actualizado correctamente!','Aviso!');</script>"; 
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Proveedor actualizado correctamente!</p></center>";

    }


    if(isset($_POST['del']))
    {        
        $id = $_POST['idProveedorDel'];
        
        $query = "DELETE FROM proveedores
        WHERE idproveedor = $id";
        
        $con->probar($query);
        
        echo "<script>toastr.success('¡Proveedor eliminado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Proveedor eliminado correctamente!</p></center>";
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de Proveedores</title>    
    
    <script src="busquedaProveedores.js"></script>
    

    <style type="text/css">
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }

        table tr td:last-child a{
            margin-right: 15px;
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
                        <h2 class="pull-left">Administrar Proveedores</h2>                      
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Proveedor</a>
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