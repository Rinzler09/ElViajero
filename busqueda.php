

<?php

//header("Content-Type: applications/xls");
//header("Content-Disposition: attachment; filename=archivo.xls");
?>


<?php
    require_once "conexion.php";
    $con = new conexion();   

    $id;
    $nom;

    $sql = "SELECT * FROM cargo";

    if(isset($_POST['query']))
    {
        $f = ($_POST['query']);
        $sql = "SELECT * FROM cargo
        WHERE cargo LIKE '%". $f . "%' OR idcargo LIKE '%". $f . "%'";        
    }

    $resultado = $con->consulta($sql);
    
    //print_r($resultado);

?>

<?php if(count($resultado) > 0) { ?>

<table class='table table-bordered table-striped' id='datosE'>
    <thead bgcolor='#AFDDF7'>
        <tr>
            <th>Id Cargo</th>
            <th>Cargo</th>            
            <th>Accion</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idcargo']; ?></td>
                    <td><?php echo $registro['cargo']; ?></td>                    
                    <td>
                        
                        <a class='add_empleado' href='#' title='Editar' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class="fa fa-pencil"></span></a>
                        <a class='add_empleado' href='#' title='Eliminar' onclick='return modalDelete(event);' data-toggle='modal' data-target='#deleteModal'><span class='fa fa-trash'></span></a>
                    </td>
                </tr>
        <?php } ?>
    </tbody>    
</table>

    <?php
        $registros = count($resultado);
        $paginas = $registros / 5;
        $paginas = ceil($paginas);
        $pageAct=0;
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            
            <li >
                <a class="page-link" href="empleados.php" onclick="location.href=this.href+'?pagina='+pagAnt;return false;">Anterior</a>
            </li>
            
            <?php for($i=0; $i < $paginas; $i++): ?>
             
            <li class="page-item">
                <a class="page-link" id="navItem<?php echo $i+1; ?>" name="navItem<?php echo $i+1; ?>" onclick="capturaPagina(<?php echo $i+1; ?>);" 
                    href="empleados.php?pagina=<?php echo $i+1; ?> ">
                    <?php echo $i+1; 
                      
                    ?>
                </a>
            </li>

             <?php endfor ?>
             
            <li class='page-item'>
                <a class='page-link' href='#'>Siguiente</a>
            </li>
             
        </ul>
    </nav>


<?php } else echo "<p class='lead'><em>No hay regitros</em></p>"; 
    
?>

<?php
/*
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table class='table table-bordered table-striped' id='datosE'>";
                echo "<thead>";
                    echo "<tr bgcolor='#AFDDF7'>";
                        echo "<th>ID</th>";     
                        echo "<th>Nombre</th>";
                        echo "<th>Apellido</th>";
                        echo "<th>Edad</th>";
                        echo "<th>Telefono</th>";
                        echo "<th>Dirección</th>";
                        echo "<th>Acción</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_array($result)){           
                    $nom = $row['nombre'];                      
                    echo "<tr>";
                    echo "<td>" . $row['idempleado'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['apellidos'] . "</td>";
                    echo "<td>" . $row['edad'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['direccion'] . "</td>";
                    echo "<td>";
                        echo "<a class='add_empleado' href='#' title='Ver' onclick='return modalEdit(event);' data-toggle='modal' data-target='#editModal'><span class='fa fa-edit'></span></a>";
                        echo "<a class='add_empleado' href='#' title='Ver' onclick='return modalDelete(event);' data-toggle='modal' data-target='#deleteModal'><span class='fa fa-trash'></span></a>";
                        //echo "<a href='consultar.php?id=". $row['idempleado'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                        //echo "<a href='editar.php?id=". $row['idempleado'] ."' title='Actualizar' data-toggle='#editModal'><span class='glyphicon glyphicon-pencil'></span></a>";
                        //echo "<a href='eliminar.php?id=". $row['idempleado'] ."' title='Eliminar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                }
                echo "</tbody>";
            echo "</table>";

            $registros = mysqli_num_rows($result);
            $paginas = $registros / 5;
            $paginas = ceil($paginas);

            echo "<nav aria-label='Page navigation example'>";
                echo "<ul class='pagination'>";
                    echo "<li class='page-item'><a class='page-link' href='empleados.php?=pagina=" . ($_GET['pagina'] - 1) . "'>Anterior</a></li>";
                    for($i=0; $i < $paginas; $i++):
                    echo "<li class='page-item ". $i + 1 . "'><a class='page-link' href='empleados.php?pagina=". $i+1 . "'>";                     
                    echo $i+1;
                    echo "</a></li>";                                        
                    endfor;
                    echo "<li class='page-item'><a class='page-link' href='#'>Siguiente</a></li>";
                echo "</ul>";
            echo "</nav>";

            mysqli_free_result($result);
        }else{
            echo "<p class='lead'><em>No hay regitros</em></p>";            
        }
    }
    mysqli_close($con);
    */
?>



<!-- MODAL NUEVO REGISTRO -->

<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="cargo.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Ingrese Cargo:</label>
                        <input type="text" name="cargo" class="form-control">
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
            <form action="cargo.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizando Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Id Cargo:</label>
                    <input type="text" name="idCargo" id="idCargo" class="d-none form-control">                                
                
                    <div class="form-group">
                        <label>Ingrese Cargo:</label>
                        <input type="text" name="cargo" id="cargo" class="form-control">
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
            <form action="cargo.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminando Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <label>Esta seguro de eliminar este cargo?</label>                              

                    <div class="form-group">
                        <br>
                        <!-- <input type="text" name="idCargoDel" id="idCargoDel" class="d-none form-control">                                 -->
                        <input type="text" id="idCargoDel" name="idCargoDel" style="display: none;">
                        <label for="">Id cargo: </label>
                        <label for="" id="lblCargo"></label><br>
                        <label for="">Cargo: </label>                               
                        <label id="cargoDel"></label>                                
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

    var id, nombre;
    
    function modalEdit(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        cargo = $(evento.target).parents("tr").find("td").eq(1).text();
        
        $("#idCargo").val(id);                            
        $("#cargo").val(cargo);                                    
    }

    function modalDelete(evento){
        id = $(evento.target).parents("tr").find("td").eq(0).text();
        cargo = $(evento.target).parents("tr").find("td").eq(1).text();        

        $("#lblCargo").text(id);
        $("#idCargoDel").val(id);
        $("#cargoDel").text(cargo);
    }



    


</script>


