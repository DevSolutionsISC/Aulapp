@extends("header")
@section("Contenido")
<div class="row">
    <div >
      <div class="d-flex" id="formularioEditar">
        <form method="POST" action="/login" id="formulario">

          @csrf
          <h3 text-center>Iniciar sesión</h3>
          <br>
          <span class="error text-danger" for="input-nombre"></span>
          <label for="inputNombre" class="form-label ">Usuario</label>
          <input type="text" id="inputUsuario" class="form-control ed" name="usuario" value="{{old('usuario')}}" autofocus>
          <label id="mensajeUsuario"></label>
          <br>
          <label for="Contraseña" class="form-label ">Contraseña</label>
          <input type="text" id="inputcontraseña" class="form-control " name="contrasenia" value="{{old('contrasenia')}}" autofocus>
          <label id="mensajeContraseña"></label>
          <br>
          <div class="d-grid gap-2">

            <button class="btn btn-dark btn-block btn-lg ed" id="acceder" type="submit">
                Acceder
            </button>

          </div>
        </form>
      </div>

    </div>
     <!-- </script>
    {{--@php
      use App\Models\UserRol;
      $usuarios=UserRol::all();
    @endphp
    <script>
      var acceder=document.getElementById("acceder")
      var usuario=document.getElementById("inputUsuario")
      var contraseña=document.getElementById("inputcontraseña")
      acceder.onclick=function(){
        @foreach ($usuarios as $u )
        if('{{$u->usuario->usuario}}'== usuario.value && '{{$u->usuario->usuario}}'==usuario.value){
          if('{{$u->rol_id}}'==1){
            location.href="menu_adm"
          }else{location.href="menu_docente"}
          localStorage.setItem("usuario", {{$u->id}});
        }
      @endforeach
      }
    </script>--}}-->
    <script>
      var inicio=document.getElementById("inicio");
      inicio.href="/"

     var campana=document.getElementById("campana");
     campana.style.display="none"
     
</script>
    
  
 @endsection

