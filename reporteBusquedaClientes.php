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
          WHERE nombre LIKE '%". $f . "%' OR idcliente LIKE '%". $f . "%' OR telefono LIKE '%". $f . "%' OR DNI LIKE '%". $f . "%' ";        
    }

    $resultado = $con->consulta($sql);

?>

<?php if(count($resultado) > 0) { ?>

<table class="table table-bordered table-striped"  id='datosE'>
    <thead style="background-color: #D3E9F1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>            
            <th>Telefono</th>  
            <th>DNI</th>                 
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $registro){ ?>            
                <tr>
                    <td><?php echo $registro['idcliente']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>  
                    <td><?php echo $registro['telefono']; ?></td> 
                    <td><?php echo $registro['DNI']; ?></td> 
                  
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



<!-- MODAL EDITAR REGISTRO -->


<!-- MODAL ELIMINAR REGISTRO -->

<script>

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


