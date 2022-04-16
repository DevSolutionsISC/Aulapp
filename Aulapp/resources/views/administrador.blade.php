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
  <link rel="stylesheet" href="{{asset('css/formulario.css')}}" />
  <title>Document</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">Aulapp</a>
        @yield('Titulo')
        <form class="d-flex">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          <a class="nav-link active" aria-current="page" href="#">DevSolutions</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Contenido">
    <form id="formulario" method="post" @yield('Direccion')>
      @csrf
      @yield('Titulo formulario')
      <label for="inputNombre" class="form-label">Nombre</label>
      <input type="text" id="inputNombre" class="form-control" name="Nombre" value="{{old('Nombre')}}">
      @if ($errors->has('Nombre'))
      <span class="error text-danger" for="input-nombre">{{ $errors->first('Nombre') }}</span>
      @endif
      <br>
      @yield('Contenido formulario')
      <input class="btn btn-lg  btn-block" type="submit" value="Registrar">
    </form>
    @yield('Tabla')
  </div>
  <footer>
  </footer>
</body>

</html>