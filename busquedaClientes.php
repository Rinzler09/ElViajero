<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT * FROM clientes";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        // $sql = "SELECT * FROM clientes
        // WHERE nombre LIKE '%". $f . "%' OR idcliente LIKE '%". $f . "%' OR  telefono LIKE '%". $f . "%' ";        
        $sql = "SELECT * FROM clientes
          WHERE nombre LIKE '%". $f . "%' OR idcliente LIKE '%". $f . "%' OR apellido LIKE '%". $f . "%' OR telefono LIKE '%". $f . "%' OR DNI LIKE '%". $f . "%' ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Nombre Cliente</th>   
            <th>Apellido Cliente</th>          
            <th>Telefono</th>  
            <th>DNI</th>                 
            <th>Accion</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idcliente']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>  
                    <td><?php echo $registro['apellido']; ?></td>  
                    <td><?php echo $registro['telefono']; ?></td> 
                    <td><?php echo $registro['DNI']; ?></td> 
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
    });

    $('#datosE').DataTable( {
            "dom": 'lrtip'
        } );
</script>

<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="clientes.php" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Cliente</h5>
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
                        <label>Ingrese Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Telefono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese DNI:</label>
                        <input type="text" name="dni" id="dni" class="form-control">
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
            <form action="clientes.php" method="post" onsubmit="return validaCampos('2');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Cliente:</label>
                    <input type="text" name="idcliente" id="idcliente" class="d-none form-control" readonly>                                
                
                    <div class="form-group">
                        <label>Ingrese Nombre:</label>
                        <input type="text" name="nombreAct" id="nombreAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Apellido:</label>
                        <input type="text" name="apellidoAct" id="apellidoAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese Telefono:</label>
                        <input type="text" name="telefonoAct" id="telefonoAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Ingrese DNI:</label>
                        <input type="text" name="dniAct" id="dniAct" class="form-control">
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
            <form action="clientes.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este cliente?</label>                              

                    <div class="form-group">
                        <br>
                        <!-- <input type="text" name="idCargoDel" id="idCargoDel" class="d-none form-control">                                 -->
                        <input type="text" id="idClienteDel" name="idClienteDel" style="display: none;">
                        <label for="">Id cliente: </label>
                        <label for="" id="lblCliente"></label><br>
                        <label for="">Nombre: </label>                               
                        <label id="clienteDel"></label><br> 
                        <label for="">Apellido: </label>                               
                        <label id="clienteApeDel"></label><br>
                        <label for="">DNI: </label>                               
                        <label id="dniDel"></label>                                 
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

    var id, nombre, telefono, dni, apellido;
    
    function modalEdit(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        nombre = $(evento.target).parents("tr").find("td").eq(1).text();
        apellido = $(evento.target).parents("tr").find("td").eq(2).text();
        telefono = $(evento.target).parents("tr").find("td").eq(3).text();  
        dni = $(evento.target).parents("tr").find("td").eq(4).text();       
        
        $("#idcliente").val(id);                            
        $("#nombreAct").val(nombre);  
        $("#apellidoAct").val(apellido);                           
        $("#telefonoAct").val(telefono);  
        $("#dniAct").val(dni);                                                                                                         
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        nombre = $(evento.target).parents("tr").find("td").eq(1).text();   
        apellido =  $(evento.target).parents("tr").find("td").eq(2).text();  
        dni = $(evento.target).parents("tr").find("td").eq(3).text();    //ojo  

        $("#lblCliente").text(id);
        $("#idClienteDel").val(id);
        $("#clienteDel").text(nombre);
        $("#clienteApeDel").text(apellido);
        $("#dniDel").text(dni);
    }

    function validaCampos(indice){
      
      let id, nombre, apellido, telefono;



      if(indice == 1)
      {
          nombre = $("#nombre").val();
          apellido = $("#apellido").val();
          telefono = $("#telefono").val();
          dni = $("#dni").val();
      }

      if(indice == 2)
      {
         nombre = $("#nombreAct").val();
         apellido = $("#apellidoAct").val();
         telefono = $("#telefonoAct").val();
         dni = $("#dniAct").val();
      }

      //validamos campos
      if($.trim(nombre) == ""){
      toastr.error("No ha ingresado un nombre de cliente","Aviso!");
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


