<?php
ob_start();
?>

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
        $producto = $_POST['producto'];  
        $idcategoria = $_POST['categoria'];      
    
        
        $imagen = 'imagenes/productos/'.$_FILES['archivo']['name'];

        $query = "INSERT INTO producto (producto, idcategoria_producto, imagen) 
        VALUES ('$producto',$idcategoria,'$imagen')";

        
        $con->probar($query);
        
        echo "<script>toastr.success('¡Producto creado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Producto creado correctamente!</p></center>";
        
        move_uploaded_file($_FILES['archivo']['tmp_name'], 'imagenes/productos/'.$_FILES['archivo']['name']);
    }


    if(isset($_POST['edit']))
    {   
      
        $id = $_POST['idproducto']; 
        $producto = $_POST['productoAct'];  
        $idcategoria = $_POST['categoriaAct'];
        
        
        if($_FILES['archivoAct']['name'] == "")
        {
            $query = "UPDATE producto 
            SET producto='$producto', idcategoria_producto=$idcategoria
            WHERE idproducto=$id";
        }
        else
        {
            $imagen = 'imagenes/productos/'.$_FILES['archivoAct']['name'];  

            $query = "UPDATE producto 
            SET producto='$producto', idcategoria_producto=$idcategoria, imagen='$imagen'
            WHERE idproducto=$id";
        }

        $con->probar($query);

        echo "<script>toastr.success('¡Producto actualizado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>Producto actualizado correctamente!</p></center>";
        
        move_uploaded_file($_FILES['archivoAct']['tmp_name'], 'imagenes/productos/'.$_FILES['archivoAct']['name']);
        
    }


    if(isset($_POST['del']))
    {        
        $id = $_POST['idProductoDel'];
        
        $query = "DELETE FROM producto
        WHERE idproducto = $id";
        
        $con->probar($query);

        echo "<script>toastr.success('¡Producto eliminado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Producto eliminado correctamente!</p></center>";
    
    }
?>

    <script src="busquedaProductos.js"></script>
    

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
                        <h2 class="pull-left">Administrar Productos</h2>                      
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Producto</a>
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


<?php
ob_end_flush();
?>