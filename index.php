<?php
    
    include("encabezado.php");

    $_SESSION['pagina'] = basename(__FILE__);
?>

<?php
    /*$conect = new conexion();
    $query = "INSERT INTO `cargo` (`idcargo`, `cargo`) VALUES (NULL, 'Gerente Financiero');";
    $conect->probar($query);*/
?>

<style>
    .wrapper{
        width: 80%;
        margin-left: 15rem;
    }

    @media (max-width: 768px) {

        .wrapper {
            margin-left: 5rem;
        }

        #info{
            margin-top: 30rem;
            margin-left: 20rem;
            width: 40rem;   
            text-align: justify;         
        }

      

        
    }
</style>

<div class="wrapper">
    <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-6">
                    <img id="logo" src="img/favicon.jpg" alt="" style="width: 350px; height: 350px; position: absolute; left:270px;">                       
                </div>
                
                <div class="col-md-6" id="info">
                    <h1 class="display-3" style="color: black;">Bienvenido a El Viajero</h1>            
                    <p class="lead" style="color: black;">Descubre el mundo con El Viajero, tu socio confiable para experiencias aéreas y terrestres inolvidables. 
                    Ofrecemos servicios de reserva de vuelos, emocionantes recorridos terrestres. Nuestro equipo dedicado garantiza atención personalizada para 
                    hacer de tu viaje una experiencia única. ¡Viaja con nosotros y haz realidad tus sueños!</p>
                    <hr class="my-2">
                    <button class="btn btn-success" type="button">Mas Informacion</button>                
                </div>
             </div>
        
    </div>
    
</div>
        
        