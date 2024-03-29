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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Ventas</title>    
    
    <script src="consultaAjaxVentas.js"></script>
    

    <style type="text/css">
        .wrapper{
            width: 800px;
            margin: 0 auto;
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
        <form action="DescargarReporte_x_fecha_PDF.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Consulta de Viajes</h2>                                                                                                      
                    </div>
                    <div class="form-group">
                        <label>Buscar</label>
                        <input type="text" name="buscar" id="buscar" class="form-control"><br>
                        
                        <div id="datos">                                        

                        </div>                    
                    </div>                    
                </div>
            </div>  
            </form>                
        </div>
    </div>