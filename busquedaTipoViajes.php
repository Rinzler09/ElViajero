<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT * FROM tipoviaje";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT * FROM tipoviaje
        WHERE nombre LIKE '%". $f . "%' OR tipoViajeId LIKE '%". $f . "%' OR descripcion LIKE '%". $f . "%' OR empresa LIKE '%".$f . "%'
        ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>            
            <th>Descripcion</th>
            <th>Empresa</th>
            <th>Accion</th>               
                                    
            
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['tipoViajeId']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>  
                    <td><?php echo $registro['descripcion']; ?></td>
                    <td><?php echo $registro['empresa']; ?></td>                      
                                                                            
                    <td>                       
                      
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
            <form action="tviajes.php" enctype="multipart/form-data" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Tipo de Viaje</h5>
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
                        <label>Ingrese Descripcion:</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese el Nombre Empresa:</label>
                        <input type="text" name="empresa" id="empresa" class="form-control">
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
            <form action="tviajes.php" enctype="multipart/form-data" method="post" onsubmit="return validaCampos('2');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Tipo de Viajes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Tipo de Viajes:</label>
                    <input type="text" name="idTipoViajeAct" id="idTipoViajeAct" class="d-none form-control">                                
                
                    <div class="form-group">
                        <label>Ingrese Nombre:</label>
                        <input type="text" name="nombreAct" id="nombreAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 
                    
                    <div class="form-group">
                        <label>Ingrese Descripcion:</label>
                        <input type="text" name="descripcionAct" id="descripcionAct" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Ingrese el Nombre de la Empresa:</label>
                        <input type="text" name="empresaAct" id="empresaAct" class="form-control">
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
            <form action="tviajes.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Aerolinea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar el Tipo de Viaje?</label>                              

                    <div class="form-group">
                        <br>
                        <!-- <input type="text" name="idCargoDel" id="idCargoDel" class="d-none form-control">                                 -->
                        <input type="text" id="idTipoViajeaDel" name="idTipoViajeaDel" style="display: none;">
                        <label for="">Id Tipo de Viaje: </label>
                        <label for="" id="lblTipoViaje"></label><br>
                        <label for="">Nombre: </label>                               
                        <label id="tipoviajeDel"></label>                                
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

    var id, nombre, descripcion, empresa;   
    
    function modalEdit(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        nombre = $(evento.target).parents("tr").find("td").eq(1).text();
        descripcion = $(evento.target).parents("tr").find("td").eq(2).text();
        empresa = $(evento.target).parents("tr").find("td").eq(3).text();
        
        $("#idTipoViajeAct").val(id);                            
        $("#nombreAct").val(nombre);                            
        $("#descripcionAct").val(descripcion);
        $("#empresaAct").val(empresa);       
        
                                                                                                               
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        nombre = $(evento.target).parents("tr").find("td").eq(1).text();        
        descripcion =  $(evento.target).parents("tr").find("td").eq(2).text();     
        empresa = $(evento.target).parents("tr").find("td").eq(3).text();

        $("#lblTipoViaje").text(id);
        $("#idTipoViajeaDel").val(id);
        $("#tipoviajeDel").text(nombre + ' ' + descripcion);
    }

    function validaCampos(indice){
      
         let id, nombre, descripcion, empresa;
 
 
 
         if(indice == 1)
         {
             nombre = $("#nombre").val();
             descripcion = $("#descripcion").val();
             empresa = $("#empresa").val();
             
         }
 
         if(indice == 2)
         {
            nombre = $("#nombreAct").val();
            descripcion = $("#descripcionAct").val();
            empresa = $("#empresaAct").val();
            
         }
 
         //validamos campos
         if($.trim(nombre) == ""){
         toastr.error("No ha ingresado un nombre","Aviso!");
             return false;
         }

         if($.trim(descripcion) == ""){
         toastr.error("No ha ingresado la descripcion","Aviso!");
             return false;
         }
         if($.trim(empresa) == ""){
         toastr.error("No ha ingresado el nombre de la empresa","Aviso!");
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


