@extends('registrar')
@section('title', 'Aula')
@section('Titulo')
<h3 text-center  id="Titulo"> Administracion de aulas</h3>
@endsection
@section('action')
action="{{route('aula')}}"
@endsection
@section('TituloForm','Registrar aula')
@section('NombreCampo','Nombre')
@section('Name')
name="nombre"
@endsection
@section('NombreCampo2','Capacidad')
@section('Name2')
name="capacidad"
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