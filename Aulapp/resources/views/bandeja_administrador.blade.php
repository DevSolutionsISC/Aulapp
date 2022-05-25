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
        <h3>Bandeja de solicitudes </h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
            <a href="respuestaAdmin"><span class="material-symbols-outlined" id="campana">
                notifications
                </span></a>
          <a class="nav-link active" aria-current="page" href="menu" id="inicio">Inicio</a>
        </form>
      </div>
    </nav>
  </header>
    <div id="Container" class="container-fluid">
            <div id="tipos">
              
            <span class="tipo_m" id="recibidos">Por llegada</span>
            <span class="tipo_m" id="enviados">Por urgencia</span>

           </div>
        <div id="tabla">
            <table class="table">
                <thead>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha de envío</th>

                </thead>
                <tbody>
                 @foreach($reservas as $reservaBandeja)
                 @if ($reservaBandeja->estado == 'enviado')
                    <tr class="efecto {{$reservaBandeja->estado}}" data-url="{{route('respuesta',['id'=>$reservaBandeja->id])}}">
    
                        <td>{{$reservaBandeja->docentes}}</td>
                        <td>{{$reservaBandeja->motivo}}</td>
                        <td>{{$reservaBandeja->estado}}</td>
                        <td>{{$reservaBandeja->created_at}}</td>
                       
                    </tr> 
                    @else 
                    <tr class="efecto {{$reservaBandeja->estado}}" data-url="{{route('respuestas',['id'=>$reservaBandeja->id])}}">
    
                        <td>{{$reservaBandeja->docentes}}</td>
                        <td>{{$reservaBandeja->motivo}}</td>
                        <td>{{$reservaBandeja->estado}}</td>
                        <td>{{$reservaBandeja->created_at}}</td>
                       
                    </tr> 
                    @endif  
                    @endforeach          
                </tbody>
            </table>
        </div>
    </div>

  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
  <script>
    $(function () {$('table.table tr').click(function () {  window.location.href = $(this).data('url'); });}) 
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
 var enviados=document.getElementById("enviados")
 var recibidos=document.getElementById("recibidos")
 recibidos.style.background="grey"
 enviados.onclick=function(){
     enviados.style.background="grey"
     recibidos.style.background="white"
 }
 recibidos.onclick=function(){
     enviados.style.background="white"
     recibidos.style.background="grey"
 }
 
</script>

@if (session('actualizar')=='ok')
  <script>localStorage.setItem('ruta',"")
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Respuesta enviada exitosamente',
    showConfirmButton: false,
    timer: 1500
    })</script>
@endif
</body>

</html>