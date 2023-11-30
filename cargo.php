<?php

    include("encabezado.php");
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
        
        $cargo = $_POST['cargo'];        

        $query = "INSERT INTO cargo (cargo) 
        VALUES ('$cargo')";
        
        $con->probar($query);
        
        echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 70%;'>¡Cargo creado correctamente!</p></center>";
        // echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }


    if(isset($_POST['edit']))
    {       
        $id = $_POST['idCargo']; 
        $cargo = $_POST['cargo'];        

        $query = "UPDATE cargo 
        SET cargo='$cargo'
        WHERE idcargo=$id";
        
        $con->probar($query);
            echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 70%;'>¡Cargo actualizado correctamente!</p></center>";
        
        //    echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }


    if(isset($_POST['del']))
    {        
        $id = $_POST['idCargoDel'];
        
        $query = "DELETE FROM cargo
        WHERE idcargo = $id";
        
        $con->probar($query);
            echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 70%;'>¡Cargo eliminado correctamente!</p></center>";
        
        //    echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Cargos</title>    
    
    <script src="busqueda.js"></script>
    

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
    <!-- <header>
        <div class = "header">
            <h1>Supermercado</h1>
            <div class="barraOpcion">
                <p>TGU, <?php echo time(); ?></p>
                <span>|</span>
                <a href="">Salir</a>
            </div>
        </div>
    </header> -->
    
    <!-- <div class="modal">
        <div class="bodymodal">
            <form action="" method="post" name="add_empleado" id="add_empleado" onsubmit="event.preventDefault(); enviarDatosEmpleado();">
                <h1><i class="fas fa-cubes" style="font-size: 45pt;"></i><br>
                Agregar Empleado</h1> 
                <input type="text" name="nombre" id="cajaNombre" placeholder="Ingrese nombre del empleado" required>
                <input type="text" name="apellido" id="cajaApellido" placeholder="Ingrese apellido del empleado" required>
                <input type="number" name="edad" id="cajaedad" placeholder="Ingrese edad del empleado" required>
                <input type="text" name="telefono" id="cajaTelefono" placeholder="Ingrese telefono del empleado" required>
                <input type="text" name="direccion" id="cajaDireccion" placeholder="Ingrese direccion del empleado" required>
                
                <input type="hidden" name="codigo" id="codigo" required>
                <input type="hidden" name="accion" id="addEmpleado" required>
                <div class="alerta"><p>Alerta de Accion</p></div>
                
                <button type="submit" class="agregar"><i class="fa fas-plus"></i>Agregar</button>
                <a href="#" class="closeModal" onclick="closeModal();"><i class="fas fa-ban"></i>Cerrar</a>
            </form>
            <h2name></h2>
        </div>
    </div>

    <style>
        .modal{
            position: fixed;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,0.81);
            display: block;
        }

        .bodymodal{
            width: 100%;
            height: 100%;
            display: -webkit-inline-flex;
            display: -moz-inline-flex;
            display: -ms-inline-flex;
            display: -o-inline-flex;
            display: inline-flex;
            justify-content: center;
            align-items: center;    
            
        }

        .modal h1{
            color: #0E725D;
            text-transform: uppercase;
        }

        .modal h2{
            text-transform: uppercase;
            margin: 15px:;
        }
        

        #add_empleado{
            width: 420px;
            text-align: center;            
        }
        
    </style> -->



    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Gestion de Cargos</h2>
                        <!-- <a href="crear.php" class="btn btn-default pull-right">Agregar Empleado</a> -->
                        <!-- <a href="crear.php" class="btn btn-default pull-right" data-toggle='modal' data-target='#exampleModal'>Agregar Empleado</a>-->
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Cargo</a>
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