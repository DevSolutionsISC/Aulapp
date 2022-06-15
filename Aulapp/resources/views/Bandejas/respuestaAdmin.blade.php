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
        <h3>Mensaje detallado</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>

        <form class="d-flex">


        <div class="navbar-brand " style="padding-left:5%" href="/" >
          <a href="javascript: history.go(-1)">
          <span class="material-symbols-outlined">
          arrow_back
          </span>   
          </a>
        </div>

        </form>
      
      </div>
    </nav>
  </header>
<body>
    <br>
    <br>
    <div id="formularioEditar">
    <div id="formulario">
        <div class="row">
            <label class="col-5" style="font-weight: bold">Estado:</label>
            <label class="col">{{$mensaje->estado}}</label>
        </div>
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Motivo:</label>
            <label class="col">{{$mensaje->motivo}}</label>
        </div>
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Materia:</label>
            <label class="col">{{$mensaje->materia}}</label>
        </div>
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Grupos:</label>
            <label class="col">{{$mensaje->grupos}}</label>
        </div>
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Docente(s):</label>
            <label class="col">{{$mensaje->docentes}}</label>
        </div>
        <div class="row">
          <label class="col-5" style="font-weight: bold">Fecha de Examen:</label>
          <label class="col">{{$mensaje->fecha_examen}}</label>
      </div>
        <br>
        @if ($mensaje->estado!="enviado" && $mensaje->estado!="rechazado" && $tipo=="recibido" && $mensaje->estado!="reasignar")
     
        <div class="row">
            <label class="col-5" style="font-weight: bold">Hora Inicio-Fin:</label>
            <label class="col">{{$mensaje->hora_inicio}} - {{$mensaje->hora_fin}}</label>
        </div>
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Aulas:</label>
            <label class="col">{{$aulas}}</label>
        </div>
        @endif
        @if ($mensaje->estado =="rechazado" && $tipo=="recibido" )
        <div class="row">
            <label class="col-5" style="font-weight: bold">Motivo de rechazo:</label>
            <label class="col">{{$mensaje->motivo_rechazo}}</label>
        </div>
        @endif
        @if ($tipo =="enviado")
       
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Hora Inicio-Fin:</label>
            <label class="col">{{$mensaje->hora_inicio}} - {{$mensaje->hora_fin}}</label>
        </div>
        <br>
        <div class="row">
            <label class="col-5" style="font-weight: bold">Cantidad de estudiantes:</label>
            <label class="col"> {{$mensaje->cantE}}</label>
        </div>
        <br>
        @endif
    </div></div>
</body>
</html>