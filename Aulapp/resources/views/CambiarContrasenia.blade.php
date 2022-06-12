@extends('plantilla2')
@section('Titulo')
@endsection
<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <form class="d-flex m-0">
        <a class="nav-link active" aria-current="page" href="{{url('menu')}}">Inicio</a>
      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<h3>Cambiar Contraseña</h3>




<form action="{{ route('update-password') }}" method="POST"id="formulario">
    @csrf
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-3">
            <label for="oldPasswordInput" class="form-label">Contraseña actual</label>
            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" 
            id="oldPasswordInput" value="{{old('old_password')}}" autofocus>
            @error('old_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="newPasswordInput" class="form-label">Nueva contraseña</label>
            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" 
            id="newPasswordInput"value="{{old('new_password')}}">
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="confirmNewPasswordInput" class="form-label">Repetir contraseña</label>
            <input name="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
            id="confirmNewPasswordInput"value="{{old('new_password_confirmation')}}"> 
            @error('new_password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

    </div>

    <div class="card-footer">
        <button class="btn btn-success">Guardar</button>
        <a href="javascript: history.go(-1)" class="btn btn-success"
          type="button">Cancelar</a>
    </div>

</form>

@endsection