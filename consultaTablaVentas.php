<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
require_once "conexion.php";
$con = new conexion();

$id;

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

if (isset($_POST['query'])) {
    $f = $_POST['query'];
    
    $sql = "SELECT viajes.viajeId, 
            CONCAT(clientes.nombre, ' ', clientes.apellido) AS cliente_nombre, 
            destinos.nombre AS destino_nombre, 
            CONCAT(empleados.nombre, ' ', empleados.apellidos) AS empleado_nombre, 
            categorias.nombre AS categoria_nombre, 
            tipoviaje.nombre AS tipoviaje_nombre, 
            viajes.fechaSalida, 
            viajes.fechaRegreso, 
            viajes.precio
            FROM viajes
            JOIN clientes ON viajes.clienteId = clientes.idcliente
            JOIN destinos ON viajes.destinoId = destinos.destinoId
            JOIN empleados ON viajes.empleadoId = empleados.idempleado
            JOIN categorias ON viajes.categoriaId = categorias.categoriaId
            JOIN tipoviaje ON viajes.tipoViajeId = tipoviaje.tipoViajeId
            WHERE viajes.viajeId LIKE '%$f%' 
                OR CONCAT(clientes.nombre, ' ', clientes.apellido) LIKE '%$f%'
                OR destinos.nombre LIKE '%$f%'
                OR CONCAT(empleados.nombre, ' ', empleados.apellidos) LIKE '%$f%'
                OR categorias.nombre LIKE '%$f%'
                OR tipoviaje.nombre LIKE '%$f%'
                OR viajes.fechaSalida LIKE '%$f%'
                OR viajes.fechaRegreso LIKE '%$f%'
                OR viajes.precio LIKE '%$f%'";        
}


$resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

    <table class="table table-bordered table-striped" id='datosE'>
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
            <?php foreach ($resultado as $registro) { ?>
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
