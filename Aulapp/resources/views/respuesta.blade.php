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
  <link rel="stylesheet"
    href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}"
            width="50" id="logo"></a>
        <h3>Responder a solicitud</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
          <a href="bandeja_administrador"><span class="material-symbols-outlined" id="campana">
              notifications
            </span></a>
          <a class="nav-link active" aria-current="page" href="menu_adm" id="inicio">Inicio</a>
          <a class="nav-link active" aria-current="page" href="@yield(" registrar")" id="registrar">DevSolution</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
    <div id="tipos">
      <span class="tipo_m"><b>Docentes:</b> {{$reserva->docentes }}</span>
      <span class="tipo_m"><b>Motivo:</b>{{$reserva->motivo }}</span>
      <span class="tipo_m"><b>Fecha:</b> {{$reserva->fecha_examen }}</span>
      <span class="tipo_m"> <b>Hora de inicio:</b> {{$reserva->hora_inicio }}</span>
      <span class="tipo_m"> <b>Hora de finalizacion:</b> {{$reserva->hora_fin }}</span>
      <button class="btn btn-dark" id="btn_aceptar">Aceptar</button>
      <button class="btn btn-dark" id="btn_rechazar">Rechazar</button>
      <button class="btn btn-danger" id="btn_cancelar">Cancelar</button>
    </div>
    <div id="aceptado">
      <h5>Seleccione las aulas necesarias para la reserva de: <b>{{$reserva->cantE}}</b> estudiantes</h5>
      <h5>Capacidad asignada</h5>
      @php
      use App\Models\Section;
      $sections=Section::all();
      use App\Models\Aula;
      $aulas=Aula::all();
      use App\Models\AulaAsignada;
      $aulas_asignadas=AulaAsignada::all();

      @endphp
      <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach ($sections as $section)
        <div id="{{$section->id}}" class="accordion-item">

          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-{{$section->id}}" aria-expanded="false" aria-controls="flush-{{$section->id}}">
              {{$section->nombre}}
            </button>
          </h2>
          <div id="flush-{{$section->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              @foreach ($aulas as $aula )
              @if ($aula->section_id==$section->id)
              <div id="{{$aula->id}}" class="check"><input class="form-check-input" type="checkbox" value="">
                <span>{{$aula->nombre}} {{$aula->capacidad}}</span>
              </div>
              @endif
              @endforeach
              <button class="btn enviar">Enviar</button>
            </div>
          </div>
        </div>
        @endforeach
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
      @foreach ($aulas_asignadas as $aula_asignada)
       
        console.log("aula asignada: "+'{{$aula_asignada->aula->nombre}}');
        console.log("aula asignada capacidad: "+{{$aula_asignada->aula->capacidad}});
        console.log("aula asignada cantidad estudiantes: "+{{$aula_asignada->reserva->cantE}});
        console.log("aula asignada fecha de examen: "+'{{$aula_asignada->reserva->fecha_examen}}');
        console.log("hora inicio: "+'{{$aula_asignada->reserva->hora_inicio}}');
        console.log("hora fin: "+'{{$aula_asignada->reserva->hora_fin}}');
      @endforeach
      var cantidad = {{$reserva->cantE}};    
              @foreach ($sections as $section)
             var seccion = document.getElementById('{{$section->id}}');
              var suma = 0;
              //console.log('{{$section->nombre}}');
              @foreach ($aulas as $aula)
                var aula = document.getElementById('{{$aula->id}}');
              
              if ('{{$aula->section_id}}'=='{{$section->id}}'){
                if({{$aula->capacidad}}>90){
                 aula.innerHTML= 'hola' 
                }
               else{suma = suma + {{$aula->capacidad}};}
               
              }
              @endforeach
                console.log(suma);
             if (suma>=cantidad) {
             seccion.style.display = 'block';
             }else{
             seccion.style.display = 'none';
             }
              @endforeach
    </script>


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