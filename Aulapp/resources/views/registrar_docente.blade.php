@extends('registrar')
@section('title', 'Docente')
@section('Titulo')
<h3 text-center  id="Titulo"> Administracion de docentes</h3>
@endsection
@section('action')
action="{{route('materias')}}"
@endsection
@section('TituloForm','Registrar docente')
@section('NombreCampo','Nombre')
@section('Name')
name="nombre"
@endsection
@section('NombreCampo2','Apellido')
@section('Name2')
name="apellido"
@endsection
@section('campos')
    <label for="input3" class="form-label">Cédula de identidad</label>
    <input type="text" id="input3" class="form-control" name='ci' value=""   autofocus>
    <span class=" error text-danger" for="input3"></span>
    <br>
    
    <label for="input4" class="form-label">Email</label>
    <input type="text" id="input4" class="form-control" name='email' value=""  autofocus>
    <span class=" error text-danger" for="input4"></span>
    <br>
   
@endsection