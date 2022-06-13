@extends('plantilla2')


<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>

      <form class="d-flex m-0">
        <a class="nav-link active" aria-current="page" href="{{url('menu')}}">Inicio</a>
      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex justify-content-center" id="formulario">
  <div class="d-flex" id="formularioEditar">
        <form action="{{ route('CambiarContraseña') }}" method="POST"id="formulario">
        <h3>Cambiar Contraseña</h3>
            @csrf
            <div >
           
                <div>
                    <label for="oldPasswordInput" class="form-label" >Contraseña actual</label>
                    <input class="form-control"name="old_password" type="texto" 
                    id="oldPasswordInput" value="{{old('old_password')}}" autofocus>
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    
                </div>
                <div>
                    <label for="newPasswordInput" class="form-label">Nueva contraseña</label>
                    <input class="form-control" name="new_password" type="texto" 
                    id="newPasswordInput"value="{{old('new_password')}}">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="confirmNewPasswordInput" class="form-label">Repetir contraseña</label>
                    <input class="form-control" name="new_password_confirmation" type="texto"
                    id="confirmNewPasswordInput"value="{{old('new_password_confirmation')}}"> 
                    @error('new_password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <br>

                    <div class="d-flex justify-content-center">
                    <button class="btn btn-dark btn-block btn-lg" type="submit" >Guardar</button>
                        <a href="javascript: history.go(-1)" class="btn btn-dark btn-block btn-lg"
                        type="button"style="margin-left: 10px">Cancelar</a>
                    </div>


        </form>
    </div>
</div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('actualizar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Contraseña cambiada con éxito!',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif

@endsection
