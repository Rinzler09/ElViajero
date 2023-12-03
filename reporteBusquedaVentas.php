<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT viajes.viajeId, 
    CONCAT(clientes.nombre, ' ', clientes.apellido) as cliente_nombre, 
    destinos.nombre as destino_nombre, 
    CONCAT(empleados.nombre, ' ', empleados.apellidos) as empleado_nombre, 
    categorias.nombre as categoria_nombre, 
    tipoviaje.nombre as tipoviaje_nombre, 
    viajes.fechaSalida, 
    viajes.fechaRegreso, 
    viajes.precio
    FROM viajes
    JOIN clientes ON viajes.clienteId = clientes.idcliente
    JOIN destinos ON viajes.destinoId = destinos.destinoId
    JOIN empleados ON viajes.empleadoId = empleados.idempleado
    JOIN categorias ON viajes.categoriaId = categorias.categoriaId
    JOIN tipoviaje ON viajes.tipoViajeId = tipoviaje.tipoViajeId";


    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT viajes.viajeId, 
        CONCAT(clientes.nombre, ' ', clientes.apellido) as cliente_nombre, 
        destinos.nombre as destino_nombre, 
        CONCAT(empleados.nombre, ' ', empleados.apellidos) as empleado_nombre, 
        categorias.nombre as categoria_nombre, 
        tipoviaje.nombre as tipoviaje_nombre, 
        viajes.fechaSalida, 
        viajes.fechaRegreso, 
        viajes.precio
        FROM viajes
        JOIN clientes ON viajes.clienteId = clientes.idcliente
        JOIN destinos ON viajes.destinoId = destinos.destinoId
        JOIN empleados ON viajes.empleadoId = empleados.idempleado
        JOIN categorias ON viajes.categoriaId = categorias.categoriaId
        JOIN tipoviaje ON viajes.tipoViajeId = tipoviaje.tipoViajeId";
          }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
                <th>ID</th>
                <th>Nombre Cliente</th>
                <th>Destino</th>
                <th>Nombre Empleado</th>
                <th>Categoria</th>
                <th>Tipo Viaje</th>
                <th>Fecha Ida</th>
                <th>Fecha Vuelta</th>
                <th>Precio</th>
                                 
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                <td><?php echo $registro['viajeId']; ?></td>
                    <td><?php echo $registro['cliente_nombre']; ?></td>
                    <td><?php echo $registro['destino_nombre']; ?></td>
                    <td><?php echo $registro['empleado_nombre']; ?></td>
                    <td><?php echo $registro['categoria_nombre']; ?></td>
                    <td><?php echo $registro['tipoviaje_nombre']; ?></td>
                    <td><?php echo $registro['fechaSalida']; ?></td>
                    <td><?php echo $registro['fechaRegreso']; ?></td>
                    <td><?php echo $registro['precio']; ?></td>                                                    
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
                  


<script>

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