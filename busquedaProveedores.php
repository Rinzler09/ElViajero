<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT * FROM proveedores";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT * FROM proveedores
        WHERE proveedor LIKE '%". $f . "%' OR idproveedor LIKE '%". $f . "%'
        OR telefono LIKE '%". $f . "%' OR direccion LIKE '%". $f . "%' ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Proveedor</th>            
            <th>Telefono</th>
            <th>Direccion</th>                        
            <th>Accion</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idproveedor']; ?></td>
                    <td><?php echo $registro['proveedor']; ?></td>  
                    <td><?php echo $registro['telefono']; ?></td> 
                    <td><?php echo $registro['direccion']; ?></td>                                      
                    <td>
                        
                        <a class='add_proveedor' href='#' title='Editar' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class="fa fa-edit"></span></a>
                        <a class='add_proveedor' href='#' title='Eliminar' onclick='return modalDelete(event);' data-toggle='modal' data-target='#deleteModal'><span class='fa fa-trash'></span></a>
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

<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proveedores.php" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Ingrese Proveedor:</label>
                        <input type="text" name="proveedor" id="proveedor" class="form-control">
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
            <form action="proveedores.php" method="post" onsubmit="return validaCampos('2');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Proveedor:</label>
                    <input type="text" name="idproveedor" id="idproveedor" class="d-none form-control">                                
                
                    <div class="form-group">
                        <label>Ingrese Proveedor:</label>
                        <input type="text" name="proveedorAct" id="proveedorAct" class="form-control">
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
            <form action="proveedores.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este proveedor?</label>                              

                    <div class="form-group">
                        <br>
                        <!-- <input type="text" name="idCargoDel" id="idCargoDel" class="d-none form-control">                                 -->
                        <input type="text" id="idProveedorDel" name="idProveedorDel" style="display: none;">
                        <label for="">Id Proveedor: </label>
                        <label for="" id="lblProveedor"></label><br>
                        <label for="">Proveedor: </label>                               
                        <label id="proveedorDel"></label>                                
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

    var id, proveedor, telefono, direcion;
    
    function modalEdit(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        proveedor = $(evento.target).parents("tr").find("td").eq(1).text();
        telefono = $(evento.target).parents("tr").find("td").eq(2).text();
        direccion = $(evento.target).parents("tr").find("td").eq(3).text();
        
        $("#idproveedor").val(id);                            
        $("#proveedorAct").val(proveedor);                            
        $("#telefonoAct").val(telefono);      
        $("#direccionAct").val(direccion);                                                                                                          
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        proveedor = $(evento.target).parents("tr").find("td").eq(1).text();        

        $("#lblProveedor").text(id);
        $("#idProveedorDel").val(id);
        $("#proveedorDel").text(proveedor);
    }

    function validaCampos(indice){
      
      let id, proveedor, telefono, direcion;



      if(indice == 1)
      {
          proveedor = $("#proveedor").val();
          telefono = $("#telefono").val();
          direccion = $("#direccion").val();
      }

      if(indice == 2)
      {
        proveedor = $("#proveedorAct").val();
        telefono = $("#telefonoAct").val();
        direccion = $("#direccionAct").val();
      }

      //validamos campos
      if($.trim(proveedor) == ""){
      toastr.error("No ha ingresado un proveedor","Aviso!");
          return false;
      }

      if($.trim(telefono) == ""){
      toastr.error("No ha ingresado un numero de telefono","Aviso!");
          return false;
      }

      if($.trim(direccion) == ""){
      toastr.error("No ha ingresado una direccion","Aviso!");
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


