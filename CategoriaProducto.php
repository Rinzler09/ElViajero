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
        
        $categoria = $_POST['categoria'];  


        $query = "INSERT INTO categoria_producto (categoria) 
        VALUES ('$categoria')";
        
        $con->probar($query);
        
        echo "<script>toastr.success('¡Categoria creada correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Categoria de producto creada correctamente!</p></center>";
        // echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }


    if(isset($_POST['edit']))
    {       
        $id = $_POST['idcategoria']; 
        $categoria = $_POST['categoriaAct'];  

        $query = "UPDATE categoria_producto 
        SET categoria='$categoria' 
        WHERE idcategoria=$id";
        
        $con->probar($query);

        echo "<script>toastr.success('¡Categoria actualizada correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>Categoria de producto actualizada correctamente!</p></center>";
        
        //    echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }


    if(isset($_POST['del']))
    {        
        $id = $_POST['idCategoriaDel'];
        
        $query = "DELETE FROM categoria_producto
        WHERE idcategoria = $id";
        
        $con->probar($query);
          
        echo "<script>toastr.success('¡Categoria eliminada correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Categoria de producto eliminada correctamente!</p></center>";
        
        //    echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de Categorias de Productos</title>    
    
    <script src="busquedaCategoriaProducto.js"></script>
    

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
                        <h2 class="pull-left">Administrar Categorias de Productos</h2>                      
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Categoria</a>
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