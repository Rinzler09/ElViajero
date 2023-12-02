<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT * FROM empleados";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT * FROM empleados
        WHERE nombre LIKE '%". $f . "%' OR idempleado LIKE '%". $f . "%' OR apellidos LIKE '%". $f . "%'
        OR edad LIKE '%". $f . "%' OR telefono LIKE '%". $f . "%' OR direccion LIKE '%". $f . "%' ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>            
            <th>Apellidos</th>            
            <th>Edad</th>            
            <th>Telefono</th>
            <th>Direccion</th>   
            <th>Accion</th>                         
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idempleado']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>  
                    <td><?php echo $registro['apellidos']; ?></td>                    
                    <td><?php echo $registro['edad']; ?></td>                                      
                    <td><?php echo $registro['telefono']; ?></td> 
                    <td><?php echo $registro['direccion']; ?></td> 
                    <td>
                        <?php
                            if($registro['imagen'] != "")
                                $imagen = $registro['imagen'];
                            else
                                $imagen = "imagenes/empleados/avatar.png";
                        ?>
                        <a class="add_empleado" href="#" title="Ver Foto" onclick="return modalImagen('<?php echo $imagen ?>');" data-toggle="modal" data-target="#imageModal"><span id="imgIcon" class="fa fa-sharp fa-regular fa-image"></span></a>
                    </td>                                                        
                </tr>
        <?php } ?>
    </tbody>    
</table>


<?php } else echo "<p class='lead'><em>No hay regitros</em></p>"; 
    
?>


<script>
    $(document).ready(function(){
        $("#datosE").DataTable();   
    });

    $('#datosE').DataTable( {
            "dom": 'lrtip'
        } );
</script>


<!-- MODAL IMAGEN -->

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="empleados.php" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto del Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <center>
                        <div class="form-group">
                            <img id="imgEmpleado" name="imgEmpleado" alt="">
                        </div>
                    </center> 
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                    
                </div>
            </form>                
        </div>
    </div>
</div>

<style>
    #imgEmpleado{
        max-width: 400px;
        max-height: 400px;
        border: 3px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }

    #imgEmpleado:hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

</style>


<script>

    var id, nombre, apellidos, edad, telefono, direcion, imagen;

    function modalImagen(img){
        $("#imgEmpleado").attr("src",img);
    }
 
         //importamos configuraciones de toastr
     toastr.options = {
     "closeButton": false,
     "debug": false,
     "newestOnTop": false,
     "progressBar": false,
     "positionClass": "toast-top-right",
     "preventDuplicates": false,
     "onclick": null,
     "showDuration": "300",
     "hideDuration": "1000",
     "timeOut": "5000",
     "extendedTimeOut": "1000",
     "showEasing": "swing",
     "hideEasing": "linear",
     "showMethod": "fadeIn",
     "hideMethod": "fadeOut"
     }

</script>


