@extends('administrador')
@section('Direccion')
action="{{route('carreras')}}"
@endsection
@section('Titulo')
<h3 text-center>Administracion de Carreras</h3>
@endsection
@section('Titulo formulario')
<h3 text-center>Registrar carrera</h3>
@endsection
@section('Contenido formulario')
<label for="inputApellido" class="form-label">Código</label>
<input type="text" id="inputApellido" class="form-control" name="Codigo" value="{{old('Codigo')}}">


@if ($errors->has('Codigo'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Codigo') }}</span>
      @endif
<br>

@endsection
