<?php

    if(!isset($_SESSION['pagina']))
        session_start();

    require("conexion.php");
    $con = new conexion();   

   
    $usuario = $_SESSION['usuario'];
    $pass = $_SESSION['passw'];
    $nombre = $_SESSION['nombre'];

    if(isset($usuario) == "")
     header("location: login.php");

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Viajero, Menu</title>
    
    <link rel="stylesheet" href="estiloMenu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
 
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="swalert2.js"></script>
  <link href="swalertStyle.css" rel="stylesheet" /> -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>    
    <input type="text" name="contra" style="display: none;" id="contra" value="<?php if(isset($_SESSION["passw"])) echo $_SESSION["passw"]; ?>">

    <?php
        include("sidemenu.php");
        if($_SESSION['estado'] == '1')
        {
            echo "<script>toastr.success('Bienvenido ". $nombre . "','Aviso!');</script>";
            $_SESSION['estado'] = '0';
        }
    ?>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.js" integrity="sha512-/lbeISSLChIunUcgNvSFJSC+LFCZg08JHFhvDfDWDlY3a/NYb/NPKOcfDte3aA6E3mxm9a3sdxvkktZJSCpxGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>    
        timeOut();
    </script>