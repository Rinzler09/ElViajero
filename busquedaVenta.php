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

/*if (isset($_POST['query'])) {
    $f = ($_POST['query']);
    $sql = "SELECT * FROM viajes
    WHERE nombre LIKE '%". $f . "%' OR idcliente LIKE '%". $f . "%' OR telefono LIKE '%". $f . "%' OR DNI LIKE '%". $f . "%' ";        
}*/

$resultado = $con->consulta($sql);

?>

<?php if (count($resultado) > 0) { ?>

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
                <th>Acción</th>
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
                    <td>
                        <a class='add' href='#' title='Editar' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class="fa fa-edit"></span></a>
                        <a class='add' href='#' title='Eliminar' onclick='return modalDelete(event);' data-toggle='modal' data-target='#deleteModal'><span class='fa fa-trash'></span></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } else echo "<p class='lead'><em>No hay registros</em></p>"; ?>

<script>
    $(document).ready(function () {
        $("#datosE").DataTable();
    });

    $('#datosE').DataTable({
        "dom": 'lrtip'
    });
</script>

<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="viaje.php" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro de Viaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Cliente -->
                    <div class="form-group">
                        <label for="clienteId">Cliente:</label>
                        <select class="form-control" id="clienteId" name="clienteId">
                            <?php
                            // Obtener clientes de la base de datos
                            $sqlClientes = "SELECT clienteId, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM clientes";
                            $clientes = $con->consulta($sqlClientes);
                            foreach ($clientes as $cliente) {
                                echo "<option value='" . $cliente['clienteId'] . "'>" . $cliente['nombre_completo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Destino -->
                    <div class="form-group">
                        <label for="destinoId">Destino:</label>
                        <select class="form-control" id="destinoId" name="destinoId">
                            <?php
                            // Obtener destinos de la base de datos
                            $sqlDestinos = "SELECT destinoId, nombre FROM destinos";
                            $destinos = $con->consulta($sqlDestinos);
                            foreach ($destinos as $destino) {
                                echo "<option value='" . $destino['destinoId'] . "'>" . $destino['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Otros campos... -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Guardar" name="add" />
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL EDITAR REGISTRO -->

<div class="modal fade" id="editModalViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Código para el modal de editar registro de viaje -->
</div>

<!-- MODAL ELIMINAR REGISTRO -->

<div class="modal fade" id="deleteModalViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Código para el modal de eliminar registro de viaje -->
</div>

<script>
    var viajeId, clienteId, destinoId, empleadoId, categoriaId, aerolineaId, tipoViajeId, terrestreId;

    function modalEdit(evento) {
        // Código para obtener los valores de la fila seleccionada y cargarlos en el formulario de edición
    }

    function modalDelete(evento) {
        // Código para obtener los valores de la fila seleccionada y cargarlos en el formulario de eliminación
    }
</script>