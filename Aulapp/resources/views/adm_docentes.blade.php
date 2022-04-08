@extends('administrador')
@section('Titulo')
<h3 text-center>Administracion de docentes</h3>
@endsection
@section('Titulo formulario')
<h3 text-center>Registrar docente</h3>
@endsection
@section('Contenido formulario')
<label for="inputApellido" class="form-label">Apellido</label>
<input type="text" id="inputApellido" class="form-control">
<label for="inputCI" class="form-label">CI</label>
<input type="text" id="inputCI" class="form-control">
<label for="inputEmail" class="form-label">Email</label>
<input type="email" id="inputEmail" class="form-control">
@endsection