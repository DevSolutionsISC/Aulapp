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
        <h3>Bandeja de notificaciones</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
            <a href=""><span class="material-symbols-outlined" id="campana">
                notifications
                </span></a>
          <a class="nav-link active" aria-current="page" href="menu" id="inicio">Inicio</a>
          <a class="nav-link active" aria-current="page" href="@yield("registrar")" id="registrar">DevSolution</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
      <div id="tipos"><span class="tipo_m" id="recibidos">Recibidos</span><span class="tipo_m" id="enviados">Enviados</span></div>
        <div id="tabla">
            <table class="table">
                <thead>
                    <th>Fecha de envio</th>
                    <th>Descripcion</th>
                </thead>
                <tbody>
                    
                 @foreach ($respuestas as $respuesta)
                    
                        
                   @if ($respuesta->estado != "enviado")
                   <tr class="efecto {{$respuesta->estado}}" data-url="{{route('respuestas',['tipo'=>'recibido','id'=>$respuesta->id])}}">     
                    <td>{{$respuesta->created_at}}</td>     
                     <td>{{$respuesta->estado}} - {{$respuesta->motivo}}</td>
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
 //click enviados
 enviados.onclick=function(){
     enviados.style.background="grey"
     recibidos.style.background="white"
     var tbody=document.getElementsByTagName("tbody");
    
     tbody[0].innerHTML="";
     @foreach ($respuestas as $respuesta)
   
      tbody[0].innerHTML+="<tr class='efecto2' data-url='{{route('respuestas',['tipo'=>'enviado','id'=>$respuesta->id])}}'><td>{{$respuesta->created_at}}</td><td>{{$respuesta->motivo}}</td></tr>"
    
     @endforeach
     $(function () {$('table.table tr').click(function () {  window.location.href = $(this).data('url'); });})
  
     
 }
 //click recibido
 recibidos.onclick=function(){
     enviados.style.background="white"
     recibidos.style.background="grey"
     var tbody=document.getElementsByTagName("tbody");
     tbody[0].innerHTML="";
     @foreach ($respuestas as $respuesta)
     @if ($respuesta->estado != "enviado")
        tbody[0].innerHTML+="<tr class='efecto {{$respuesta->estado}}' data-url='{{route('respuestas',['tipo'=>'recibido','id'=>$respuesta->id])}}'> <td>{{$respuesta->created_at}}</td><td>{{$respuesta->estado}} - {{$respuesta->motivo}}</td></tr>"
      @endif
     @endforeach
     $(function () {$('table.table tr').click(function () {  window.location.href = $(this).data('url'); });})
  
 }
 
  
</script>

</body>

</html>