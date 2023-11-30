<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT idproducto, producto, categoria, imagen FROM producto pro INNER JOIN categoria_producto cat
    ON pro.idcategoria_producto = cat.idcategoria ";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT idproducto, producto, categoria, imagen FROM producto pro INNER JOIN categoria_producto cat
        ON pro.idcategoria_producto = cat.idcategoria
        WHERE producto LIKE '%". $f . "%' OR idproducto LIKE '%". $f . "%' OR categoria LIKE '%". $f . "%' ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Producto</th>            
            <th>Categoria</th>                   
            <th>Accion</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idproducto']; ?></td>
                    <td><?php echo $registro['producto']; ?></td>  
                    <td><?php echo $registro['categoria']; ?></td> 
                    <td>
                        <?php
                            if($registro['imagen'] != "")
                                $imagen = $registro['imagen'];
                            else
                                $imagen = "imagenes/productos/product.jpg";
                        ?>
                        <a class="add_empleado" href="#" title="Ver Imagen" onclick="return modalImagen('<?php echo $imagen ?>');" data-toggle="modal" data-target="#imageModal"><span id="imgIcon" class="fa fa-sharp fa-regular fa-image"></span></a>
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


<!-- MODAL IMAGEN -->

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="productos.php" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto del Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <center>
                        <div class="form-group">
                            <img id="imgProducto" name="imgProducto" alt="">
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
    #imgProducto{
        max-width: 400px;
        max-height: 400px;
        border: 3px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }

    #imgProducto:hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

</style>

<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="productos.php" enctype="multipart/form-data" method="post" onsubmit="return validaCampos('1');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Ingrese Producto:</label>
                        <input type="text" name="producto" id="producto" value="" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Seleccione Categoria de Producto:</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="0">Seleccione una categoria</option>

                            <?php $query = $con -> consulta ("SELECT * FROM categoria_producto");
                            foreach($query as $registro) { ?>
                                <option value="<?php echo $registro['idcategoria']; ?>"><?php echo $registro['categoria']; ?></option>
                            <?php } ?>

                        </select>
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
            <form action="productos.php" enctype="multipart/form-data" method="post" onsubmit="return validaCampos('2');">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Producto:</label>
                    <input type="text" name="idproducto" id="idproducto" readonly class="d-none form-control">                                
                
                    <div class="form-group">
                        <label>Ingrese Producto:</label>
                        <input type="text" name="productoAct" id="productoAct" class="form-control">
                        <span class="help-block"></span>
                    </div> 

                    <div class="form-group">
                        <label>Seleccione Categoria de Producto:</label>
                            
                        <select name="categoriaAct" id="categoriaAct" class="form-control" onload>
                            <option value="0">Seleccione una categoria</option>

                            <?php $query = $con -> consulta ("SELECT * FROM categoria_producto");
                            
                            foreach($query as $registro) { ?>
                                <option value="<?php echo $registro['idcategoria']; ?>"><?php echo $registro['categoria']; ?></option>
                            <?php } ?>
                                
                        </select>
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
            <form action="productos.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este producto?</label>                              

                    <div class="form-group">
                        <br>
                        <!-- <input type="text" name="idCargoDel" id="idCargoDel" class="d-none form-control">                                 -->
                        <input type="text" id="idProductoDel" name="idProductoDel" style="display: none;">
                        <label for="">Id Producto: </label>
                        <label for="" id="lblProducto"></label><br>
                        <label for="">Producto: </label>                               
                        <label id="productoDel"></label>                                
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

    var id, producto, categoria;

    function modalImagen(img){
        $("#imgProducto").attr("src",img);
    }
    
    function modalEdit(evento){
 

        id = $(evento.target).parents("tr").find("td").eq(0).text();
        producto = $(evento.target).parents("tr").find("td").eq(1).text();
        categoria = $(evento.target).parents("tr").find("td").eq(2).text();        
        
        $("#idproducto").val(id);                            
        $("#productoAct").val(producto);     

        
       

        for(let i = 1; i < $("#categoriaAct option").length; i++)
        {
            //alert($("#categoriaAct option:eq("+ i + ")").text());
           

            if($("#categoriaAct option:eq("+ i + ")").text() == categoria)
            {                
                $("#categoriaAct opt    ion:eq("+ i + ")").attr("selected",true);       
            }               
            else
                $("#categoriaAct option:eq("+ i + ")").attr("selected",false);    
        }                                        
        

       // $("#categoriaAct").val(categoria);  
                                                                                                      
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        producto = $(evento.target).parents("tr").find("td").eq(1).text();        

        $("#lblProducto").text(id);
        $("#idProductoDel").val(id);
        $("#productoDel").text(producto);
    }


    function validaCampos(indice){
         
        let producto;
        let categoria;



        if(indice == 1)
        {
            producto = $("#producto").val();
            categoria = $("#categoria").val();
        }

        if(indice == 2)
        {
            producto = $("#productoAct").val();
            categoria = $("#categoriaAct").val();
        }

        //validamos campos
        if($.trim(producto) == ""){
        toastr.error("No ha ingresado Producto","Aviso!");
            return false;
        }
        if($.trim(categoria) == "" || $.trim(categoria) == "0"){
        toastr.error("No ha seleccionado Categoria","Aviso!");
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


