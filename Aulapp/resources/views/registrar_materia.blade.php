@extends('registrar')
@section('title', 'Materia')
@section('Titulo')
<h3 text-center  id="Titulo"> Administración de materias</h3>
@endsection
@section('action')
action="{{route('materias')}}"
@endsection
@section('TituloForm','Registrar materia')
@section('NombreCampo','Nombre')
@section('Name')
name="nombre"
@endsection
@section('value')
value="{{old('nombre')}}"
@endsection
@section('error1')
@if ($errors->has('nombre'))
      <span class="error text-danger" for="input1">{{ $errors->first('nombre') }}</span>
      @endif
      <br>
@endsection
@section('NombreCampo2','Codigo')
@section('Name2')
name="codigo"
@endsection

@section('value2')
value="{{old('codigo')}}"
@endsection
@section('error2')
@if ($errors->has('codigo'))
      <span class="error text-danger" for="input1"> {{ $errors->first('codigo') }}</span>
      @endif
      <br>
@endsection