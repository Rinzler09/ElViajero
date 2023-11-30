<?php

    
    session_start();
    
    
    if($_SESSION['seguridad'] != '1')
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
     
   //  $idcategoria; 

    if(isset($_POST['add']))
    {  
        $usuario = $_POST['usuario'];  
        $pass = $_POST['pass']; 
        $idempleado = $_POST['empleado'];
        

        $query = "INSERT INTO usuarios (username, pass, idempleado, estado) 
        VALUES ('$usuario','$pass',$idempleado,true)";
        
        $con->probar($query);

        insertarPermisos();
        
        echo "<script>toastr.success('¡Usuario creado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Producto creado correctamente!</p></center>";
        
    }

    function insertarPermisos(){
        global $con;
        $sql = "SELECT MAX(idusuario) as codigo FROM usuarios";
        $resultado = $con->consulta($sql);

        foreach($resultado as $registro){
            $idusuario =  $registro['codigo'];
        }
        
        if(isset($_POST['maestros']))
            $maestros = true;
        else
            $maestros = 0;

        if(isset($_POST['transacciones']))
            $transacciones = true;
        else
            $transacciones = 0;

        if(isset($_POST['consultas']))
            $consultas = true;
        else
            $consultas = 0;

        if(isset($_POST['reportes']))
            $reportes = true;
        else
            $reportes = 0;

        if(isset($_POST['seguridad']))
            $seguridad = true;
        else
            $seguridad = 0;


        $query = "INSERT INTO permisos (idusuario, datosmaestros, transacciones, consultas, reportes, seguridad) 
        VALUES ($idusuario,$maestros,$transacciones,$consultas,$reportes,$seguridad)";
        
        $con->probar($query);
    }


    function actualizarPermisos(){
        global $con;
        $idusuario = $_POST['idusuario'];
        
        if(isset($_POST['maestrosAct']))
            $maestros = true;
        else
            $maestros = 0;

        if(isset($_POST['transaccionesAct']))
            $transacciones = true;
        else
            $transacciones = 0;

        if(isset($_POST['consultasAct']))
            $consultas = true;
        else
            $consultas = 0;

        if(isset($_POST['reportesAct']))
            $reportes = true;
        else
            $reportes = 0;

        if(isset($_POST['seguridadAct']))
            $seguridad = true;
        else
            $seguridad = 0;


        $query = "UPDATE permisos 
        SET datosmaestros=$maestros, transacciones=$transacciones, consultas=$consultas, reportes=$reportes, seguridad=$seguridad
        WHERE idusuario=$idusuario";
        $con->probar($query);
    }


    function eliminarPermisos(){
        global $con;
        $idusuario = $_POST['idUsuarioDel'];


        $query = "DELETE FROM permisos 
        WHERE idusuario=$idusuario";
        $con->probar($query);
    }

    // function buscarCodigoCategoria(){
    //     global $con;
    //     global $idcategoria;
    //     $categoria = ($_POST['categoria']);
    //     $sql = "SELECT idcategoria FROM categoria_producto
    //     WHERE categoria = '". $categoria . "' "; 

    //     $resultado = $con->consulta($sql);

    //     foreach ($resultado as $registro) {
    //         $idcategoria = $registro['idcategoria'];
    //     }
      
    // }


    if(isset($_POST['edit']))
    {   
        //buscarCodigoCategoria();
        $id = $_POST['idusuario']; 
        $usuario = $_POST['usuarioAct'];  
        $pass = $_POST['passAct'];


        $query = "UPDATE usuarios 
        SET username='$usuario', pass='$pass'
        WHERE idusuario=$id";
        
        $con->probar($query);
        
        actualizarPermisos();

        echo "<script>toastr.success('¡Usuario actualizado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>Producto actualizado correctamente!</p></center>";
        
        //    echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }


    if(isset($_POST['del']))
    {        

        eliminarPermisos();

        $id = $_POST['idUsuarioDel'];
        
        $query = "DELETE FROM usuarios
        WHERE idusuario = $id";
        
        $con->probar($query);

        echo "<script>toastr.success('¡Usuario eliminado correctamente!','Aviso!');</script>";
        //echo "<center><br><p class='alert alert-success agileits' role='alert' style='width: 60%;'>¡Producto eliminado correctamente!</p></center>";
        
        //    echo "<p class='alert alert-danger agileits' role='alert'>:::Error:::" . $query . " " . mysqli_error($con) . "</p>";

        
    }
?>

    <script src="busquedaUsuario.js"></script>
    

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
                        <h2 class="pull-left">Administrar Usuarios</h2>                      
                        <a href="#" class="btn btn-primary pull-right" data-toggle='modal' data-target='#newModal'>Agregar Usuario</a>
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