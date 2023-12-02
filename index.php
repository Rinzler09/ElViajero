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

    #infoExtra {
        margin-top:20rem;
    justify-content: center;
    text-align: center;
}

#btnMasInfo{
           background-color: blue;
           font-weight: bold;
           color:white;
           border: 1px solid gainsboro;
           border-radius: 5px;
           cursor:pointer;
            padding: 5px 5px;
        }

        #btnMasInfo:hover{
            width: 180px;
            height: 50px;
        }
        #divImg{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin-left: 300px;
        }

        #divImg img{
            height: 300px;
            width:500px;
            margin: 20px 20px;
            border-radius: 10%;
            box-shadow: 0px 0px 2px 2px blue;
        }

        #divTrans{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin-left: 300px;
        }

        #divTrans span{
            margin: 22px 22px;
            width:500px;
        }

        #divDest{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin-left: 300px;
        }

        #divDest img{
            height: 300px;
            width:500px;
            margin: 20px 20px;
            border-radius: 5%;
        }

        #sitios span:nth-of-type(1){
            margin-left: 240px;
            width:20px;
        }
        #sitios span:nth-of-type(2){
            margin-left: 330px;
            width:20px;
        }

        #redesSoc{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin-left: 450px;
            margin-top:  50px;
        }

        #redesSoc span{
            margin-right: 80px;
        }

</style>


<div class="wrapper">
    <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-6">
                    <img src="img/favicon.jpg" alt="" style="width: 350px; height: 350px; position: absolute; left:230px;">                       
                </div>
                
                <div class="col-md-6" id="info">
                    <h1 class="display-3" style="color: black;">Bienvenido a El Viajero</h1>            
                    <p class="lead" style="color: black;">Descubre el mundo con El Viajero, tu socio confiable para experiencias aéreas y terrestres inolvidables. 
                    Ofrecemos servicios de reserva de vuelos, emocionantes recorridos terrestres. Nuestro equipo dedicado garantiza atención personalizada para 
                    hacer de tu viaje una experiencia única. ¡Viaja con nosotros y haz realidad tus sueños!</p>
                    <hr class="my-2">
                    <button id="btnMasInfo" type="button" onclick="masInfo();mostrar();">Mas Informacion</button>                
                </div>
             </div>
    
    </div>
</div>

<div id="infoExtra" style="display:none;"></div>

<script>
    function masInfo() {
    var divInfoExtra = document.createElement("div");
    divInfoExtra.id = "AdicionInfo";

    divInfoExtra.innerHTML = "<h1 style='margin-left:22rem;'>Gracias por interesarte en nosotros!</h1>"+
    '<div id="divImg"><img src="img/terminal-bus.png"><img src="img/vuelos-aereos.png"></div>'+
    '<div id="divTrans"><span>Te ofrecemos transporte terrestre de la mejor calidad para que viajes comodamente.'+
    '</span><span>Quieres viajar mas rapido? No hay problema te brindamos la opcion de vuelos aereos para que puedas literalmente sentirte en cielo con nuestro servicio!</span></div>'+
    "<h1 style='margin-left:22rem;' >Nuestros Destinos</h1>"+
    "<div id='divDest'><img src='img/Cancun.jpg'><img src='img/Vegas.jpg'></div>"+
    "<div id='sitios'><span>Cancun, Mexico</span><span>Las Vegas, Estados Unidos</span></div>"+
    "<h1 style='margin-left:21rem;'>Contactanos</h1>"+
    "<div id='redesSoc'><img src='img/whatsapp.jpg'><span>(+504) 52368974</span><img src='img/insta.jpg'><span>@ElViajero</span>"+
    "<img src='img/correo.jpg'><span>elviajero.ddns.net/ElViajero</span></div>";

    var divInfo = document.getElementById("infoExtra");
    if (divInfo.innerHTML == ""){
        divInfo.append(divInfoExtra);
    } 

}

function mostrar(){
    var divInfo = document.getElementById("infoExtra");
    var divInfoExtra = document.getElementById("AdicionInfo");
    if (divInfo.style.display == "none"){
        divInfo.style.display = "block";
    }
    else if (divInfo.style.display == "block"){
        divInfo.style.display = "none";
    }
}

    </script>
        
        