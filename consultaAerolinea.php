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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de Aerolineas</title>    
    
    <script src="consultaAjaxAerolinea.js"></script>
    

    <!-- <style type="text/css">
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

    </style> -->



    <style type="text/css">
    .wrapper {
        width: 60%;
        margin: 0 auto;
        font-size: 14px;
        overflow-x: auto; /* Permite hacer scroll horizontal si es necesario */
       
    }
    .page-header h2 {
        margin-top: 0;
    }
    table {
        width: 60%;
        border-collapse: collapse;
    }
    table tr td:last-child a {
        margin-right: 0px;
    }
    #imgIcon {
        color: #D8A30B;
    }
    .fa-edit {
        color: #31E814;
    }
    .fa-trash {
        color: red;
    }
    #buscar {
        width: 100%; /* Ajusta el ancho del campo de búsqueda */
        max-width: 400px; /* Establece un ancho máximo para evitar problemas en dispositivos pequeños */
    }
    /* Regla para hacer la tabla responsive */
    @media only screen and (max-width: 768px) {
        table {
            overflow-x: auto;
            display: block;
        }
        thead, tbody, th, td, tr {
            display: block;
        }
        tbody {
            max-height: 300px; /* Si deseas limitar la altura de la tabla en dispositivos pequeños */
            overflow-y: auto;
        }
        th {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        tr {
            margin-bottom: 15px;
        }
        td {
            border: none;
            position: relative;
            padding-left: 50%;
        }
        td:before {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }
        td:nth-of-type(1):before { content: "Columna 1"; }
        td:nth-of-type(2):before { content: "Columna 2"; }
        /* Repite lo anterior para cada columna que tengas */
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
                        <h2 class="pull-left">Consulta Aerolineas</h2>                      
                        
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