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
            <th>Cargo</th>           
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
                    <td><?php echo $registro['cargoId']; ?></td>                                    
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
                        <a class='add_empleado' href='#' title='Editar' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class="fa fa-edit"></span></a>
                        <a class='add_empleado' href='#' title='Eliminar' onclick='return modalDelete(event);' data-toggle='modal' data-target='#deleteModal'><span class='fa fa-trash'></span></a>
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

<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="empleados.php" enctype="multipart/form-data" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Ingrese Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                        <span class="help-block"></span>
                    </div> 
                    
                    <div class="form-group">
                        <label>Ingrese Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Edad:</label>
                        <input type="text" name="edad" id="edad" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Seleccione el cargo:</label>
                        <select name="cargoId" id="cargoId" class="form-control">
                            <option value="0">Seleccione el cargo</option>

                            <?php $query = $con -> consulta ("SELECT * FROM cargos");
                            foreach($query as $registro) { ?>
                                <option value="<?php echo $registro['cargoId']; ?>"><?php echo $registro['nombre']; ?></option>
                            <?php }?>

                        </select>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label>Ingrese Telefono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Direccion:</label>
                        <input type="text" name="direccion" id="direccion" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    
                    

                    <div class="form-group">
                        <label>Seleccione Imagen:</label>
                        <input type="file" name="archivo" class="form-control" id="archivo">
                        <span class="help-block"></span>
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

<style>
    ::-webkit-file-upload-button {
  font-family: arial;
  font-size: 14px;
  height: 40px;
  width: 200px;
  -webkit-appearance: none;
  border: 0;
  background: #E3DEDE !important;
  color: black;
  border-color: black !important;
  position: relative;
  
  left: -7px;
  right: 5px;
  bottom: 5px;
}

#archivo, #archivoAct{
    padding: 0;
}
</style>

<!-- MODAL EDITAR REGISTRO -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="empleados.php" enctype="multipart/form-data" method="post" onsubmit="return validaCampos('2');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Empleado:</label>
                    <input type="text" name="idempleado" id="idempleado" class="d-none form-control" readonly>                                
                
                    <div class="form-group">
                        <label>Ingrese Nombre:</label>
                        <input type="text" name="nombreAct" id="nombreAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 
                    
                    <div class="form-group">
                        <label>Ingrese Apellidos:</label>
                        <input type="text" name="apellidosAct" id="apellidosAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Edad:</label>
                        <input type="text" name="edadAct" id="edadAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                   <div class="form-group">
                        <label>Seleccione el cargo:</label>
                        <select name="cargoIdAct" id="cargoIdAct" class="form-control">
                            <option value="0">Seleccione el cargo</option>

                            <?php $query = $con -> consulta ("SELECT * FROM cargos");
                            foreach($query as $registro) { ?>
                                <option value="<?php echo $registro['cargoId']; ?>"><?php echo $registro['nombre']; ?></option>
                            <?php }?>

                        </select>
                        <span class="help-block"></span>
                    </div>


                    <div class="form-group">
                        <label>Ingrese Telefono:</label>
                        <input type="text" name="telefonoAct" id="telefonoAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Direccion:</label>
                        <input type="text" name="direccionAct" id="direccionAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Seleccione Imagen:</label>
                        <input type="file" name="archivoAct" class="form-control" id="archivoAct">
                        <span class="help-block"></span>
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
            <form action="empleados.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este empleado?</label>                              

                    <div class="form-group">
                        <br>
                        <!-- <input type="text" name="idCargoDel" id="idCargoDel" class="d-none form-control">                                 -->
                        <input type="text" id="idEmpleadoDel" name="idEmpleadoDel" style="display: none;">
                        <label for="">Id empleado: </label>
                        <label for="" id="lblEmpleado"></label><br>
                        <label for="">Nombre: </label>                               
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

    var id, nombre, apellidos, edad, telefono, direcion, imagen;

    function modalImagen(img){
        $("#imgEmpleado").attr("src",img);
    }
    
    function modalEdit(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        nombre = $(evento.target).parents("tr").find("td").eq(1).text();
        apellidos = $(evento.target).parents("tr").find("td").eq(2).text();
        edad = $(evento.target).parents("tr").find("td").eq(3).text();
        cargo = $(evento.target).parents("tr").find("td").eq(4).text();
        telefono = $(evento.target).parents("tr").find("td").eq(5).text();
        direccion = $(evento.target).parents("tr").find("td").eq(6).text();
        
        $("#idempleado").val(id);                            
        $("#nombreAct").val(nombre);                            
        $("#apellidosAct").val(apellidos);       
        $("#edadAct").val(edad);
        $("#cargoIdAct").val(cargo); 
        $("#telefonoAct").val(telefono);      
        $("#direccionAct").val(direccion); 
                                                                                                               
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        nombre = $(evento.target).parents("tr").find("td").eq(1).text();        
        apellidos =  $(evento.target).parents("tr").find("td").eq(2).text();     

        $("#lblEmpleado").text(id);
        $("#idEmpleadoDel").val(id);
        $("#empleadoDel").text(nombre + ' ' + apellidos);
    }

    function validaCampos(indice){
      
         let id, nombre, apellidos, edad, cargo, telefono, direcion;
 
 
 
         if(indice == 1)
         {
             nombre = $("#nombre").val();
             apellidos = $("#apellidos").val();
             edad = $("#edad").val();
             cargo = $("#cargoId").val();
             telefono = $("#telefono").val();
             direccion = $("#direccion").val();
         }
 
         if(indice == 2)
         {
            nombre = $("#nombreAct").val();
            apellidos = $("#apellidosAct").val();
            edad = $("#edadAct").val();
            cargo = $("#cargoIdAct").val();
            telefono = $("#telefonoAct").val();
            direccion = $("#direccionAct").val();
         }
 
         //validamos campos
         if($.trim(nombre) == ""){
         toastr.error("No ha ingresado un nombre","Aviso!");
             return false;
         }

         if($.trim(apellidos) == ""){
         toastr.error("No ha ingresado los apellidos","Aviso!");
             return false;
         }

         if($.trim(edad) == ""){
         toastr.error("No ha ingresado la edad","Aviso!");
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


