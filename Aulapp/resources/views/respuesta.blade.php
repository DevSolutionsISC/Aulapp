<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
  <link rel="stylesheet" href="{{asset('css/editar.css')}}" />
  <link rel="stylesheet" href="{{asset('css/bandeja.css')}}" />
  <title>@yield('title')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
        <h3>Responder a solicitud</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
            <a href="bandeja_administrador"><span class="material-symbols-outlined" id="campana">
                notifications
                </span></a>
          <a class="nav-link active" aria-current="page" href="menu_adm" id="inicio">Inicio</a>
          <a class="nav-link active" aria-current="page" href="@yield("registrar")" id="registrar">DevSolution</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
      <div id="tipos">
          <span class="tipo_m">Docentes:</span>
          <span class="tipo_m">Motivo:</span>
          <span class="tipo_m">Fecha:</span>
          <button class="btn btn-dark" id="btn_aceptar">Aceptar</button>
          <button class="btn btn-dark" id="btn_rechazar">Rechazar</button>
          <button class="btn btn-danger" id="btn_cancelar">Cancelar</button>
      </div>
        <div id="aceptado">
           <h5>Seleccione las aulas necesarias para la reserva de:1000 estudiantes</h5>
           <h5>Capacidad asignada</h5>
           <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Edificio nuevo primer piso
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>690A-100 Estudiantes</span></div>
                    <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>690B-100 Estudiantes</span></div>
                     <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>690C-100 Estudiantes</span></div>
                    <button class="btn enviar">Enviar</button>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Edificio nuevo segundo piso
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>691A-100 Estudiantes</span></div>
                    <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>691B-100 Estudiantes</span></div>
                     <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>691C-100 Estudiantes</span></div>
                    <button class="btn enviar">Enviar</button>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Edificio nuevo tercer piso
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>692A-100 Estudiantes</span></div>
                    <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>692B-100 Estudiantes</span></div>
                     <div class="check"><input class="form-check-input" type="checkbox" value="">
                        <span>692C-100 Estudiantes</span></div>
                    <button class="btn enviar">Enviar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="rechazado">
          <h3>Motivo de rechazo</h3>
          <textarea name="motivo_rechazo" id="motivo_rechazo" cols="60" rows="8"></textarea><br>
          <button class="btn btn-dark enviar">Enviar</button>
        </div>
    </div>
  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
<script>
    //menu hamburguesa
  var menu=document.getElementsByClassName("nav-link");
  var btn_menu=document.getElementById("menu")
  btn_menu.onclick=function(){
    if(btn_menu.innerHTML=="menu"){
      for(var i=0 ; i<menu.length;i++){
      menu[i].style.display="block"
      }
       btn_menu.innerHTML="close";
    }else{
      for(var i=0 ; i<menu.length;i++){
      menu[i].style.display="none"
    }
    btn_menu.innerHTML="menu";
    }
  }
</script>
<script>
 
 var btn_aceptar=document.getElementById("btn_aceptar")
 var btn_rechazar=document.getElementById("btn_rechazar")
 var btn_cancelar=document.getElementById("btn_cancelar")
 var aceptado=document.getElementById("aceptado")
 var rechazado=document.getElementById("rechazado")
 rechazado.style.display="none"
 btn_aceptar.onclick=function(){
   rechazado.style.display="none"
   aceptado.style.display="block"
 }
 btn_rechazar.onclick=function(){
   rechazado.style.display="block"
   aceptado.style.display="none"
 }
</script>
</body>

</html>