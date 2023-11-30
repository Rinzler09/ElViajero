<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT us.idusuario, username, pass, CONCAT(nombre, ' ', apellidos) As Nombre, datosmaestros, transacciones, consultas, reportes, seguridad FROM usuarios us INNER JOIN empleados em
    ON us.idempleado = em.idempleado INNER JOIN permisos pe ON us.idusuario = pe.idusuario";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT us.idusuario, username, pass, CONCAT(nombre, ' ', apellidos) As Nombre, datosmaestros, transacciones, consultas, reportes, seguridad FROM usuarios us INNER JOIN empleados em
        ON us.idempleado = em.idempleado INNER JOIN permisos pe ON us.idusuario = pe.idusuario
        WHERE username LIKE '%". $f . "%' OR Nombre LIKE '%". $f . "%' OR us.idusuario LIKE '%". $f . "%' ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>  
            <th>Password</th>          
            <th>Empleado</th>                   
            <th>Maestros</th>
            <th>Transacciones</th>
            <th>Consultas</th>
            <th>Reportes</th>
            <th>Seguridad</th>
            <th>Accion</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idusuario']; ?></td>
                    <td><?php echo $registro['username']; ?></td>  
                    <td><?php echo $registro['pass']; ?></td>  
                    <td><?php echo $registro['Nombre']; ?></td> 
                    <td><?php echo $registro['datosmaestros']; ?></td> 
                    <td><?php echo $registro['transacciones']; ?></td> 
                    <td><?php echo $registro['consultas']; ?></td> 
                    <td><?php echo $registro['reportes']; ?></td> 
                    <td><?php echo $registro['seguridad']; ?></td> 
                    <td>
                        
                        <a class='add_cliente' href='#' title='Editar' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class="fa fa-edit"></span></a>
                        <a class='add_cliente' href='#' title='Eliminar' onclick='return modalDelete(event);' data-toggle='modal' data-target='#deleteModal'><span class='fa fa-trash'></span></a>
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
        $("#datosE th:nth-child(3)").hide();
        $("#datosE td:nth-child(3)").hide();
        $("#datosE th:nth-child(5)").hide();
        $("#datosE td:nth-child(5)").hide();
        $("#datosE th:nth-child(6)").hide();
        $("#datosE td:nth-child(6)").hide();
        $("#datosE th:nth-child(7)").hide();
        $("#datosE td:nth-child(7)").hide();
        $("#datosE th:nth-child(8)").hide();
        $("#datosE td:nth-child(8)").hide();
        $("#datosE th:nth-child(9)").hide();
        $("#datosE td:nth-child(9)").hide();
    });

    $('#datosE').DataTable( {
            "dom": 'lrtip'
    } );

</script>

<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="usuarios.php" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Ingrese nombre de usuario:</label>
                        <input type="text" name="usuario" id="usuario" value="" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese password:</label>
                        <input type="password" name="pass" id="pass" value="" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Seleccione empleado:</label>
                        <select name="empleado" id="empleado" class="form-control">
                            <option value="0">Seleccione un empleado</option>

                            <?php $query = $con -> consulta ("SELECT * FROM empleados");
                            foreach($query as $registro) { ?>
                                <option value="<?php echo $registro['idempleado']; ?>"><?php echo $registro['nombre'] . " " . $registro['apellidos']; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block"></span>
                    </div> 

                  
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="maestros" id="maestros"/>
                    <label class="custom-control-label" for="maestros">Datos Maestros</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="transacciones" id="transacciones"/>
                    <label class="custom-control-label" for="transacciones">Transacciones</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="consultas" id="consultas"/>
                    <label class="custom-control-label" for="consultas">Consultas</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="reportes" id="reportes"/>
                    <label class="custom-control-label" for="reportes">Reportes</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="seguridad" id="seguridad"/>
                    <label class="custom-control-label" for="seguridad">Seguridad</label>
                    </div>
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Guardar" name="add"/>
                </div>
            </form>                
        </div>
    </div>
</div>


<!-- MODAL EDITAR REGISTRO -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="usuarios.php" method="post" onsubmit="return validaCampos('2');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Usuario:</label>
                    <input type="text" name="idusuario" id="idusuario" readonly class="d-none form-control">                                
                
                    <div class="form-group">
                        <label>Nombre de usuario:</label>
                        <input type="text" name="usuarioAct" id="usuarioAct" readonly class="form-control">
                        <span class="help-block"></span>
                    </div> 
                    
                    <div class="form-group">
                        <label>Ingrese password:</label>
                        <input type="password" name="passAct" id="passAct" value="" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Empleado:</label>
                            
                        <select name="empleadoAct" id="empleadoAct" class="form-control" disabled onload>
                            <option value="0">Seleccione un empleado</option>

                            <?php $query = $con -> consulta ("SELECT * FROM empleados");
                            
                            foreach($query as $registro) { ?>
                                <option value="<?php echo $registro['idempleado']; ?>"><?php echo $registro['nombre'] . " " . $registro['apellidos']; ?></option>
                            <?php } ?>
                                
                        </select>
                        <span class="help-block"></span>
                    </div>
                    
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="maestrosAct" id="maestrosAct"/>
                        <label class="custom-control-label" for="maestros">Datos Maestros</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="transaccionesAct" id="transaccionesAct"/>
                        <label class="custom-control-label" for="transacciones">Transacciones</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="consultasAct" id="consultasAct"/>
                        <label class="custom-control-label" for="consultas">Consultas</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="reportesAct" id="reportesAct"/>
                        <label class="custom-control-label" for="reportes">Reportes</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="seguridadAct" id="seguridadAct"/>
                        <label class="custom-control-label" for="seguridad">Seguridad</label>
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
            <form action="usuarios.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este usuario?</label>                              

                    <div class="form-group">
                        <br>
                        <input type="text" id="idUsuarioDel" name="idUsuarioDel" style="display: none;">
                        <label for="">Id Usuario: </label>
                        <label for="" id="lblUsuario"></label><br>
                        <label for="">Usuario: </label>                               
                        <label id="usuarioDel"></label><br>                               
                        <label for="">Empleado: </label>                               
                        <label id="empleadoDel"></label>                                
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

    var id, usuario, pass, empleado, maestros, transacciones, consulas, reportes, seguridad;

    
    function modalEdit(evento){
 

        id = $(evento.target).parents("tr").find("td").eq(0).text();
        usuario = $(evento.target).parents("tr").find("td").eq(1).text();
        pass = $(evento.target).parents("tr").find("td").eq(2).text();
        empleado = $(evento.target).parents("tr").find("td").eq(3).text();        
        maestros = parseInt($(evento.target).parents("tr").find("td").eq(4).text());        
        transacciones = parseInt($(evento.target).parents("tr").find("td").eq(5).text());        
        consultas = parseInt($(evento.target).parents("tr").find("td").eq(6).text());        
        reportes = parseInt($(evento.target).parents("tr").find("td").eq(7).text());        
        seguridad = parseInt($(evento.target).parents("tr").find("td").eq(8).text());     
        
        
        $("#idusuario").val(id);                            
        $("#usuarioAct").val(usuario);     
        $("#passAct").val(pass);     
        $("#maestrosAct").prop("checked", maestros);
        $("#transaccionesAct").prop("checked", transacciones);
        $("#consultasAct").prop("checked", consultas);
        $("#reportesAct").prop("checked", reportes);
        $("#seguridadAct").prop("checked", seguridad);
    
        

        for(let i = 1; i < $("#empleadoAct option").length; i++)
        {
            
            if($("#empleadoAct option:eq("+ i + ")").text() == empleado)
            {
                $("#empleadoAct option:eq("+ i + ")").attr("selected",true);      
            }               
            else
            {
                $("#empleadoAct option:eq("+ i + ")").attr("selected",false);        
            }
    
        }                                        
          
                                                                                                      
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        usuario = $(evento.target).parents("tr").find("td").eq(1).text();        
        empleado = $(evento.target).parents("tr").find("td").eq(3).text();        

        $("#lblUsuario").text(id);
        $("#idUsuarioDel").val(id);
        $("#usuarioDel").text(usuario);
        $("#empleadoDel").text(empleado);
    }


    function validaCampos(indice){
         
        let usuario;
        let pass;
        let empleado;
        let maestros;
        let transacciones;
        let consultas;
        let reportes;
        let seguridad;


        if(indice == 1)
        {
            usuario = $("#usuario").val();
            pass = $("#pass").val();
            empleado = $("#empleado").val();
            maestros = $("#maestros").prop("checked");
            transacciones = $("#transacciones").prop("checked");
            consultas = $("#consultas").prop("checked");
            reportes = $("#reportes").prop("checked");
            seguridad = $("#seguridad").prop("checked");
        }

        if(indice == 2)
        {
            usuario = $("#usuarioAct").val();
            pass = $("#passAct").val();
            empleado = $("#empleadoAct").val();
            maestros = $("#maestrosAct").prop("checked");
            transacciones = $("#transaccionesAct").prop("checked");
            consultas = $("#consultasAct").prop("checked");
            reportes = $("#reportesAct").prop("checked");
            seguridad = $("#seguridadAct").prop("checked");
        }

        //validamos campos
        if($.trim(usuario) == ""){
        toastr.error("No ha ingresado un nombre de usuario","Aviso!");
            return false;
        }
        if($.trim(pass) == ""){
        toastr.error("No ha ingresado un password","Aviso!");
            return false;
        }
        if($.trim(empleado) == "" || $.trim(empleado) == "0"){
        toastr.error("No ha seleccionado un empleado","Aviso!");
            return false;
        }

        if(maestros == false && transacciones == false && consultas == false && reportes == false && seguridad == false){
        toastr.error("No ha asignado permisos al usuario","Aviso!");
            return false;
        }
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


