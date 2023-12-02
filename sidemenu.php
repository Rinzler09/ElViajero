<?php


    $con = new conexion();   

    $usuario = $_SESSION['usuario'];
    $pass = $_SESSION['passw'];
       

    echo $usuario;
    

    $sql = "SELECT us.idusuario, username, pass, CONCAT(nombre, ' ', apellidos) As Nombre, nombre, apellidos, datosmaestros, transacciones, consultas, reportes, seguridad, imagen FROM usuarios us INNER JOIN empleados em
    ON us.idempleado = em.idempleado INNER JOIN permisos pe ON us.idusuario = pe.idusuario
    WHERE username = '". $usuario . "' AND pass = '". $pass . "' ";
    
    $resultado = $con->consulta($sql);
    $nomApe="";
    if(count($resultado) > 0)
    {
        foreach($resultado as $registro){
            $_SESSION['nom'] = $registro['nombre'];
            $_SESSION['ape'] = $registro['apellidos'];

           
            
            for($i = 0; $i <  strlen($_SESSION['nom']); $i++)
            {
                
                if(substr($_SESSION['nom'], $i, 1) != " ")
                    $nomApe = $nomApe . substr($_SESSION['nom'], $i, 1);
                else
                    $i = strlen($_SESSION['nom']);
            }

            $nomApe = $nomApe . " ";

            for($i = 0; $i <  strlen($_SESSION['ape']); $i++)
            {
                if(substr($_SESSION['ape'], $i, 1) != " ")
                    $nomApe = $nomApe . substr($_SESSION['ape'], $i, 1);
                else
                    $i = strlen($_SESSION['ape']);
            }
            
            $_SESSION['nomApe'] = $nomApe;
            //echo  $nomApe;

            $maestros =  $registro['datosmaestros'];
            $transacciones =  $registro['transacciones'];
            $consultas =  $registro['consultas'];
            $reportes =  $registro['reportes'];
            $seguridad =  $registro['seguridad'];

            if($registro['imagen'] != "")
                $imagen = $registro['imagen'];
            else
                $imagen = "imagenes/empleados/avatar.png";

            $_SESSION['idusuario'] = $registro['idusuario'];            
            $_SESSION['maestros'] = $maestros;
            $_SESSION['transacciones'] = $transacciones;
            $_SESSION['seguridad'] = $seguridad;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menuStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Menu</title>
</head>
<body>
        <div id="sidemenu" class="menu-expanded">
            <div id="header">
                <div id="title"><span>Menu</span></div>
                <div id="menu-btn">
                    <div class="btn-hamburger"></div>
                    <div class="btn-hamburger"></div>
                    <div class="btn-hamburger"></div>
                </div>
            </div>

            <div id="profile">
                <div id="photo"><img style="background-color: white;" id="mifoto" src="<?php echo $imagen; ?>" alt=""></div>

                <div id="name"><span><?php echo $nomApe; ?></span></div>
                <a href="index.php"><div class="icon"><i class="fas fa-home"></i></div></a>
                
                <br>

                <a href="cerrar.php" id="cerrar">[Cerrar Sesión]</a>  
                <a href="cerrar.php" title="Cerrar Sesion" id="cerrarIcon"><i class="fa-solid fa-power-off"></i></a>
            </div>


            <div id="menu-items">
                <div class="item" id="mae" style=" <?php if(isset($maestros) && $maestros != '1') echo "display: none"; ?>">
                    <a href="#mae">
                        <div class="icon"><img src="icons/data-folder.png" alt=""></div>
                        <div class="title"><span>Datos Maestros</span></div>
                    </a>
                    
                    <!-- <div class="subitem">
                        <a href="CategoriaProducto.php">  
                            <div class="icon"><i class="fas fa-box"></i></div>                      
                            <div class="title"><span>Admimistrar Categorías de Productos</span></div>                    
                        </a>
                    </div> -->

                    <div class="subitem">
                        <a href="Clientes.php">     
                            <div class="icon"><i class="fas fa-user"></i></div>                   
                            <div class="title"><span>Administrar Clientes</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="empleados.php">   
                            <div class="icon"><i class="fas fa-people-carry"></i></div>                                        
                            <div class="title"><span>Administrar Empleados</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="aerolinea.php">    
                            <div class="icon"><i class="fas fa-plane"></i></div>                                                            
                            <div class="title"><span>Administrar Aerolinea</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="tviajes.php">         
                            <div class="icon"><i class="fas fa-truck"></i></div>             
                            <div class="title"><span>Administrar Tipo de Viajes</span></div>                    
                        </a>
                    </div>
                    
                    <div class="subitem">
                        <a href="destinos.php">         
                            <div class="icon"><i class="fas fa-map"></i></div>             
                            <div class="title"><span>Administrar Destinos</span></div>                    
                        </a>
                    </div>    
                </div>

                <div class="item separator" style=" <?php if(isset($maestros) && $maestros != '1') echo "display: none"; ?>">
                    
                </div>

                <div class="item" id="tran" style=" <?php if(isset($transacciones) && $transacciones != '1') echo "display: none"; ?>">
                    <a href="#tran">
                        <div class="icon"><img src="icons/transacction.png" alt=""></div>
                        <div class="title"><span>Transacciones</span></div>
                    </a>

                    <!-- <div class="subitem">
                        <a href="compras.php">            
                            <div class="icon"><i class="fas fa-shopping-cart"></i></div>                         
                            <div class="title"><span>Administar Compras</span></div>                    
                        </a>
                    </div> -->

                    <div class="subitem">
                        <a href="#">         
                            <div class="icon"><i class="fas fa-money-bill-alt"></i></div>                                        
                            <div class="title"><span>Administar Ventas</span></div>                    
                        </a>
                    </div>
                </div>


                <div class="item separator" style=" <?php if(isset($transacciones) && $transacciones != '1') echo "display: none"; ?>">
                    
                </div>

                <div class="item" id="con" style=" <?php if(isset($consultas) && $consultas != '1') echo "display: none"; ?>">
                    <a href="#con">
                        <div class="icon"><img src="icons/query.png" alt=""></div>
                        <div class="title"><span>Consultas</span></div>
                    </a>

                    <div class="subitem">
                        <a href="consultaClientes.php">     
                            <div class="icon"><i class="fas fa-search"></i></div>                                            
                            <div class="title"><span>Consultar Clientes</span></div>                    
                        </a>
                    </div>

                    <!-- <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-search"></i></div>                                            
                            <div class="title"><span>Consultar Compras</span></div>                    
                        </a>
                    </div> -->

                    <div class="subitem">
                        <a href="consultaEmpleados.php">     
                            <div class="icon"><i class="fas fa-search"></i></div>                                            
                            <div class="title"><span>Consultar Empleados</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-search"></i></div>                                            
                            <div class="title"><span>Consultar Viajes</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-search"></i></div>                                            
                            <div class="title"><span>Consultar Ventas</span></div>                    
                        </a>
                    </div>
                </div>


                <div class="item separator" style=" <?php if(isset($consultas) && $consultas != '1') echo "display: none"; ?>">
                    
                </div>


                <div class="item" id="repo" style=" <?php if(isset($reportes) && $reportes != '1') echo "display: none"; ?>">
                    <a href="#repo">
                        <div class="icon"><img src="icons/reports.png" alt=""></div>
                        <div class="title"><span>Reportes</span></div>
                    </a>

                    <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-chart-bar"></i></div>                                            
                            <div class="title"><span>Reporte de Clientes</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-chart-bar"></i></div>                                            
                            <div class="title"><span>Reporte de Viajes</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="reporteEmpleados.php">     
                            <div class="icon"><i class="fas fa-chart-bar"></i></div>                                            
                            <div class="title"><span>Reporte de Empleados</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-chart-bar"></i></div>                                            
                            <div class="title"><span>Reporte de Ventas</span></div>                    
                        </a>
                    </div>

                    <div class="subitem">
                        <a href="#">     
                            <div class="icon"><i class="fas fa-chart-line"></i></div>                                            
                            <div class="title"><span>Graficos</span></div>                    
                        </a>
                    </div>
                </div>

                
                <div class="item separator" style=" <?php if(isset($reportes) && $reportes != '1') echo "display: none"; ?>">
                    
                </div>

                <div class="item" id="seg" style=" <?php if(isset($seguridad) && $seguridad != '1') echo "display: none"; ?>">
                    <a href="#seg">
                        <div class="icon"><img src="icons/security.png" alt=""></div>
                        <div class="title"><span>Seguridad</span></div>
                    </a>

                    <div class="subitem">
                        <a href="usuarios.php">     
                            <div class="icon"><i class="fas fa-user-shield"></i></div>                                            
                            <div class="title"><span>Adminsitrar Usuarios</span></div>                    
                        </a>
                    </div>
                </div>

            </div>
        </div>

        
        <div id="main-container">
            
        </div>

        <script>


            const btn = document.querySelector('#menu-btn');
            const menu = document.querySelector('#sidemenu');

            btn.addEventListener('click', e => {
                menu.classList.toggle("menu-expanded");
                menu.classList.toggle("menu-collapsed");
                document.querySelector('body').classList.toggle('body-expanded');
            });
            
     
            $(".item").on("click", function(){  
                
                if(document.querySelector('body').className == 'body-expanded')
                {                   
                    menu.classList.toggle("menu-expanded");
                    menu.classList.toggle("menu-collapsed");
                    document.querySelector('body').classList.toggle('body-expanded');
                }
                
                if($(this).children(".subitem").css("display") == "none")
                    $(this).children(".subitem").show();
                else
                {
                    $(this).children(".subitem").hide();
                }
                
            });

        </script>
