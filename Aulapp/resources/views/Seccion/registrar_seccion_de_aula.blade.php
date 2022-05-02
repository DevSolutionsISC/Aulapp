@extends('registrar')
@section("editar","seccionEdit")
@section("registrar","seccion")
@section("reporte","reporte_section")
@section("eliminar","eliminar-seccion")
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center  id="Titulo"> Administración de sección</h3>
@endsection
@section('action')
action="{{route('secciones')}}"
@endsection
@section('TituloForm','Registrar sección')
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

@section('NombreCampo2','Descripción')
@section('Name2')
name="descripcion"
@endsection
@section('value2')
value="{{old('descripcion')}}"
@endsection
@section('error2')
@if ($errors->has('descripcion'))
      <span class="error text-danger" for="input1"> {{ $errors->first('descripcion') }}</span>
      @endif
      <br>
@endsection