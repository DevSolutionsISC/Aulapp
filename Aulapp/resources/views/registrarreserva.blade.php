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
        <h3>Realizar reserva</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
          <a class="nav-link active" aria-current="page" href="menu_docente" id="inicio">Inicio</a>
          <a class="nav-link active" aria-current="page" href="@yield("registrar")" id="registrar">DevSolution</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
    <div class="row">
        <div >
          <div class="d-flex" id="formularioEditar">
            <form method="GET" action="" id="formulario">
              
              @csrf
              <h3 text-center>Realizar reserva</h3>
              <label>Materia:</label>
              <select name="materia" id="materia" class="form-select"> <option value="0">Elegir materia</option></select>
                <label id="nombre">Nombre:</label>
              <br>
              <div id="docentes"></div>
              <label id="añadir">Añadir docente + </label> <br>
              <label>Grupos:</label><br>
              <label id="grupos">Añadir grupos +</label> <br>
              <div class="row">
                  <div class="col"><label>Cantidad de estudiantes:</label></div>
                  <div class="col"><input type="text" id="cantidad" class="form-control"></div>
              </div> <br>
              <label>Motivo</label><br>
              <textarea name="motivo" id="motivo" cols="45" rows="3" class="form-control"></textarea><br>
                <label>Fecha: </label> <input type="date" name="fecha" id="fecha" class="date"><br><br>
                <div class="row">
                    <div class="col"><label>Horario:</label></div>
                    <div class="col"><select name="horario" id="horario" class="form-select">
                        <option value="6:45">6:45</option>
                        <option value="6:45">8:15</option>
                        <option value="6:45">9:45</option>
                        <option value="6:45">11:15</option>
                        <option value="6:45">12:45</option>
                        <option value="6:45">14:15</option>
                        <option value="6:45">15:45</option>
                        <option value="6:45">17:15</option>
                        <option value="6:45">18:45</option>
                    </select></div>
                </div><br>
                <div class="row">
                        <div class="col"><label>Duración:</label></div>
                        <div class="col"><select name="duracion" id="duracion" class="form-select">
                            <option value="1:30">1:30</option>
                            <option value="3:00">3:00</option>    
                        </select></div>
                        <div class="col"><label>Hrs.</label></div>
                </div>
              <div class="d-grid gap-2">
                <button class="btn btn-dark btn-block btn-lg " id="botonRegistrar" type="submit">Guardar</button>
                <a href="" class="btn btn-danger btn-block btn-lg " id="botonRegistrar"
                  type="button">Cancelar</a>
              </div>
            </form>
          </div>
        
        </div>
  </div>
  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
<script>
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
</body>
@php
  use App\Models\Usuario;
  $docentes = Usuario::all();
@endphp
<script>
  var nombre=document.getElementById("nombre")
</script>
</html>