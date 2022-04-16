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
@section('Tabla')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de docentes</h3>
      <table class="table">
      
            <thead>
                  
                  <tr>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Ci</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                  </tr>
            </thead>
            <tbody>
                  @foreach ($docentes as $docente)
                   <tr>
                         <td>{{$docente->Nombre . " ". $docente->Apellido}}</td>
                         <td>{{$docente->CI}}</td>
                         <td>{{$docente->Email}}</td>
                         <td>Editar</td>
                         <td>Eliminar</td>
                   </tr>     
                  @endforeach
            </tbody>
      </table>
</div>

@endsection