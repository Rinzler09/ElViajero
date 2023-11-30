
var tiempoGen = 5000;

function timeOut() {
  var initial;
  var contador = 15;
  var pw;
  var pswd = document.getElementById('contra').value; 
  

  function invocar() {

    initial = window.setTimeout(function () {



      tiempo = setInterval(mostrarCont, 1000);

      function mostrarCont() {

        if (contador == 0) {
          clearInterval()          
          window.location.href = "login.php"
        }
        else {          
          contador--
          sessionStorage.tiempo = contador
          if (contador <= 9)
            $('#contar').css('left', '47.5%')
          else
            $('#contar').css('left', '43.5%')  
        }

      }

      
      (async () => {        
        await Swal.fire({          
          title: 'Fin de Sesion',
          html: '<p>Su sesion expirara en..</p><p id="contar"></p><div class="preloader"></div><br><input type="password" id="pass" placeholder="Ingrese su password"></input><br><span id="msj" style="color: red; display: none;">Password incorrecto</span><br><br><button id="conectar" class="btn btn-default">Seguir conectado</button>',
          timer: 15000,
          timerProgressBar: 'true',
          position: 'center',          
          width: '25%',
          heightAuto: true,
          showConfirmButton: false,
          customClass: 'swal-hight',
          //confirmButtonText: 'Seguir conectado',
          //confirmButtonColor: '#183BC1',
          stopKeyDownPropagation: false,
          allowOutsideClick: false,          
          allowEscapeKey: false,
          allowEnterKey: false,
          didOpen: () => {

            if (sessionStorage.getItem('status') == 1)
              contador = sessionStorage.getItem('tiempo')
            else
              contador = 15

            sessionStorage.setItem('status', 1);                        

            document.getElementById("conectar").addEventListener('click', function (e) {
                
            pw = Swal.getHtmlContainer().querySelector('#pass').value;
               
              if (pw == pswd) {
                  Swal.close()
                  clearTimeout(initial)
                  clearInterval(tiempo)
                  sessionStorage.status = 0
                  sessionStorage.tiempo = 15
                  contador = 15
                  tiempoGen = 5000
                  invocar()                  
                }
                else {
                  Swal.getHtmlContainer().querySelector('#msj').style.display = 'inline'                                     
                }
            })
            
            timerInterval = setInterval(() => {                           
              Swal.getHtmlContainer().querySelector('#contar')
                .textContent = ((parseInt(sessionStorage.getItem('tiempo'))*1000) / 1000)
                  .toFixed(0)
            }, 100)
          },
          willClose: () => {            
            clearInterval(timerInterval)            
            contador = 15

            if (sessionStorage.getItem('status') == 1 && sessionStorage.getItem('tiempo') == 0)
            {
              
              sessionStorage.clear()
              window.location.href = "login.php?stat=1";            
            }
          }          

        }).then((result) => {
          //if (Swal.getHtmlContainer().querySelector('#conectar').click())
          //{

          //}
          //if (!result.isConfirmed) {            
          //  document.location.href = "../../Login.aspx";
          //}
                      
        });
             
      })()

    }, tiempoGen);
  }

  

  if (sessionStorage.getItem('status') == 1) {
    clearTimeout(initial)
    tiempoGen = 1;
    invocar(); 
  }
  else
  {
    tiempoGen = 5000;
    if (sessionStorage.getItem('tiempo') != null)  
      sessionStorage.tiempo = 15;        
    else
      sessionStorage.setItem('tiempo', 15);

    invocar();
  }       
  
}

