<?php
    if(isset($_POST['valorSelect']))
    {     
        require_once "conexion.php";
        $con = new conexion(); 

        $idproducto = $_POST['valorSelect'];

        $sql = "SELECT imagen FROM producto WHERE idproducto=$idproducto";  
        $resultado = $con->consulta($sql);

        if($resultado[0]['imagen'] != "")
            echo $resultado[0]['imagen'];
        else
            echo "imagenes/productos/product.jpg";
   
    }
                                
?>