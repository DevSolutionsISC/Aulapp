@extends("header")
@section("Contenido")
<div class="row">
    <div >
      <div class="d-flex" id="formularioEditar">
        <form method="GET" action="" id="formulario">
          
          @csrf
          <h3 text-center>Iniciar sesión</h3>
          <br>
          <span class="error text-danger" for="input-nombre"></span>
          <label for="inputNombre" class="form-label ">Usuario</label>
          <input type="text" id="inputUsuario" class="form-control ed" name="Usuario" value="{{old('Usuario')}}" autofocus>
          <label id="mensajeUsuario"></label>
          <br>
          <label for="Contraseña" class="form-label ">Contraseña</label>
          <input type="text" id="inputcontraseña" class="form-control " name="Contraseña" value="{{old('Contraseña')}}" autofocus>
          <label id="mensajeContraseña"></label>
          <br>
          <div class="d-grid gap-2">
            <a href="" class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar"
              type="button">Acceder</a>
          </div>
        </form>
      </div>
    
    </div>
    <script>
      var inicio=document.getElementById("inicio");
      inicio.href="/"

     var campana=document.getElementById("campana");
     campana.style.display="none"

    </script>
    @endsection