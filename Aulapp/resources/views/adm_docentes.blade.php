@extends('administrador')
@section("Direccion")
action="{{route('docentes')}}"
@endsection
@section('Titulo')
<h3 text-center>Administracion de docentes</h3>
@endsection
@section('Titulo formulario')
<h3 text-center>Registrar docente</h3>
@endsection
@section('Contenido formulario')
<label for="inputApellido" class="form-label">Apellido</label>
<input type="text" id="inputApellido" class="form-control" name="Apellido" value="{{old('Apellido')}}">
@if ($errors->has('Apellido'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Apellido') }}</span>
      @endif
<br>
<label for="inputCI" class="form-label">CI</label>
<input type="text" id="inputCI" class="form-control" name="CI" value="{{old('CI')}}">
@if ($errors->has('CI'))
      <span class="error text-danger" for="inputCI">{{ $errors->first('CI') }}</span>
      @endif
<br>
<label for="inputEmail" class="form-label">Email</label>
<input type="email" id="inputEmail" class="form-control" name="Email" value="{{old('Email')}}">
@if ($errors->has('Email'))
      <span class="error text-danger" for="inputEmail">{{ $errors->first('Email') }}</span>
      @endif
<br>
@endsection