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
            WHERE viajes.viajeId LIKE '%$f%' OR clientes.idcliente LIKE '%$f%' OR clientes.telefono LIKE '%$f%' OR clientes.DNI LIKE '%$f%'";        
}


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
                        <a class='add_empleado' href='#' title='Editar' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class="fa fa-edit"></span></a>
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
            <form action="ventas.php" method="post" onsubmit="return validaCampos('1');">
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
                            $sqlClientes = "SELECT idcliente, CONCAT(clientes.nombre, ' ', clientes.apellido) AS nombre_completo FROM clientes";
                            $clientes = $con->consulta($sqlClientes);
                            foreach ($clientes as $cliente) {
                                echo "<option value='" . $cliente['idcliente'] . "'>" . $cliente['nombre_completo'] . "</option>";
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

                    <!-- Nombre Empleado -->
                    <div class="form-group">
                        <label for="empleadoId">Empleado:</label>
                        <select class="form-control" id="empleadoId" name="empleadoId">
                            <?php
                            // Obtener empleados de la base de datos
                            $sqlEmpleados = "SELECT idempleado, CONCAT(empleados.nombre, ' ', empleados.apellidos) AS nombre_empleado FROM empleados";
                            $empleados = $con->consulta($sqlEmpleados);
                            foreach ($empleados as $empleado) {
                                echo "<option value='" . $empleado['idempleado'] . "'>" . $empleado['nombre_empleado'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Tipo Viaje -->
                    <div class="form-group">
                        <label for="tipoViajeId">Tipo Viaje:</label>
                        <select class="form-control" id="tipoViajeId" name="tipoViajeId">
                            <?php
                            // Obtener tipo viaje de la base de datos
                            $sqlTipo = "SELECT tipoViajeId, nombre AS nombre FROM tipoviaje";
                            $tipos = $con->consulta($sqlTipo);
                            foreach ($tipos as $tipo) {
                                echo "<option value='" . $tipo['tipoViajeId'] . "'>" . $tipo['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Nombre Categoria -->
                    <div class="form-group">
                        <label for="categoriaId">Categoria:</label>
                        <select class="form-control" id="categoriaId" name="categoriaId">
                            <?php
                            // Obtener categoria de la base de datos
                            $sqlCategorias = "SELECT categoriaId, nombre AS nombre FROM categorias";
                            $categorias = $con->consulta($sqlCategorias);
                            foreach ($categorias as $categoria) {
                                echo "<option value='" . $categoria['categoriaId'] . "'>" . $categoria['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Fecha de Salida -->
                    <div class="form-group">
                        <label for="fechaSalida">Fecha de Ida:</label>
                        <input type="date" class="form-control" id="fechaSalida" name="fechaSalida">
                    </div>

                    <!-- Fecha de Regreso -->
                    <div class="form-group">
                        <label for="fechaRegreso">Fecha de Vuelta:</label>
                        <input type="date" class="form-control" id="fechaRegreso" name="fechaRegreso">
                    </div>

                    <!-- Precio en Lempiras (Lps) -->
                    <div class="form-group">
                        <label for="precio">Precio (Lps):</label>
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese el precio en Lempiras (Lps)" step="0.01">
                    </div>


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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="ventas.php" enctype="multipart/form-data" method="post" onsubmit="return ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro de Viaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Id Viaje -->
                    <div class="form-group">
                        <label for="viajeId">Id Viaje:</label>
                        <input type="text" class="d-none form-control" id="viajeId" name="viajeId" readonly>
                    </div>

                    <!-- Cliente -->
                    <div class="form-group">
                        <label for="clienteId">Cliente:</label>
                        <select class="form-control" id="clienteId" name="clienteId">
                            <?php
                            // Obtener clientes de la base de datos
                            $sqlClientes = "SELECT idcliente, CONCAT(clientes.nombre, ' ', clientes.apellido) AS nombre_completo FROM clientes";
                            $clientes = $con->consulta($sqlClientes);
                            foreach ($clientes as $cliente) {
                                echo "<option value='" . $cliente['idcliente'] . "'>" . $cliente['nombre_completo'] . "</option>";
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

                    <!-- Nombre Empleado -->
                    <div class="form-group">
                        <label for="empleadoId">Empleado:</label>
                        <select class="form-control" id="empleadoId" name="empleadoId">
                            <?php
                            // Obtener empleados de la base de datos
                            $sqlEmpleados = "SELECT idempleado, CONCAT(empleados.nombre, ' ', empleados.apellidos) AS nombre_empleado FROM empleados";
                            $empleados = $con->consulta($sqlEmpleados);
                            foreach ($empleados as $empleado) {
                                echo "<option value='" . $empleado['idempleado'] . "'>" . $empleado['nombre_empleado'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Tipo Viaje -->
                    <div class="form-group">
                        <label for="tipoViajeId">Tipo Viaje:</label>
                        <select class="form-control" id="tipoViajeId" name="tipoViajeId">
                            <?php
                            // Obtener tipo viaje de la base de datos
                            $sqlTipo = "SELECT tipoViajeId, nombre AS nombre FROM tipoviaje";
                            $tipos = $con->consulta($sqlTipo);
                            foreach ($tipos as $tipo) {
                                echo "<option value='" . $tipo['tipoViajeId'] . "'>" . $tipo['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Nombre Categoria -->
                    <div class="form-group">
                        <label for="categoriaId">Categoria:</label>
                        <select class="form-control" id="categoriaId" name="categoriaId">
                            <?php
                            // Obtener categoria de la base de datos
                            $sqlCategorias = "SELECT categoriaId, nombre AS nombre FROM categorias";
                            $categorias = $con->consulta($sqlCategorias);
                            foreach ($categorias as $categoria) {
                                echo "<option value='" . $categoria['categoriaId'] . "'>" . $categoria['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Fecha de Salida -->
                    <div class="form-group">
                        <label for="fechaSalida">Fecha de Ida:</label>
                        <input type="date" class="form-control" id="fechaSalida" name="fechaSalida">
                    </div>

                    <!-- Fecha de Regreso -->
                    <div class="form-group">
                        <label for="fechaRegreso">Fecha de Vuelta:</label>
                        <input type="date" class="form-control" id="fechaRegreso" name="fechaRegreso">
                    </div>

                    <!-- Precio en Lempiras (Lps) -->
                    <div class="form-group">
                        <label for="precio">Precio (Lps):</label>
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese el precio en Lempiras (Lps)" step="0.01">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-primary" value="Actualizar" name="edit"/>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL ELIMINAR REGISTRO -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="ventas.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Viaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este Viaje?</label>                              

                    <div class="form-group">
                        <br>
                        <input type="text" id="idViajeDel" style="display: none;">
                        <label for="">Id Viaje: </label>
                        <label for="" id="lblViaje"></label><br>                               
                        <label id="viajeDel"></label>                                
                    </div>                            
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-danger" value="Borrar" name="del"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var viajeId, clienteId, destinoId, empleadoId, categoriaId, tipoViajeId, fechaSalida, fechaRegreso, precio;

function cargarDatosViaje(evento, esEdicion) {
    viajeId = $(evento.target).parents("tr").find("td").eq(0).text();
    clienteId = $(evento.target).parents("tr").find("td").eq(1).text();
    destinoId = $(evento.target).parents("tr").find("td").eq(2).text();
    empleadoId = $(evento.target).parents("tr").find("td").eq(3).text();
    tipoViajeId = $(evento.target).parents("tr").find("td").eq(4).text();
    categoriaId = $(evento.target).parents("tr").find("td").eq(5).text();
    fechaSalida = $(evento.target).parents("tr").find("td").eq(6).text();
    fechaRegreso = $(evento.target).parents("tr").find("td").eq(7).text();
    precio = $(evento.target).parents("tr").find("td").eq(8).text();

    $("#viajeId").val(viajeId);
    $("#clienteId").val(clienteId);
    $("#destinoId").val(destinoId);
    $("#empleadoId").val(empleadoId);
    $("#tipoViajeId").val(tipoViajeId);
    $("#categoriaId").val(categoriaId);
    $("#fechaSalida").val(fechaSalida);
    $("#fechaRegreso").val(fechaRegreso);
    $("#precio").val(precio);

    if (esEdicion) {
        $('#editModal').modal('show');
    }
}

    function modalEdit(evento) {
        cargarDatosViaje(evento, true);
    }

    function modalDel(evento) {
        viajeId = $(evento.target).parents("tr").find("td").eq(0).text();   

        $("#lblViaje").val(viajeId);
        $("#idViajeDel").val(viajeId);
    }

    function validaCampos(indice) {
        let precio;

        if (indice == 1) {
            precio = $("#precio").val();
        }

        if (indice == 2) {
            precio = $("#precioAct").val();
        }

        // Validamos campos
        if ($.trim(precio) == "") {
            toastr.error("No ha ingresado un precio", "Aviso!");
            return false;
        }

        // Resto de la lógica de validación si es necesario

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
        };

        // Resto de la lógica de validación si es necesario
    }
</script>
