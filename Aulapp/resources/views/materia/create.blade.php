@extends('plantilla')
@section('title', 'Materia')
@section('Titulo')
<h3 text-center>Plantilla de materias</h3>
@endsection
@section('Contenido formulario')
<div class="row">
  <div class="col-xl-3 col-md-4 col-12">     
    <form id="formulario" action="{{ route('materia.store') }}" method='post'>
    <h4 text-center>Registrar Materias</h4>
      @csrf
      <label for="nombre_materia" class="form-label">Nombre</label>
      <input type="text" name ="nombre_materia" value = "{{old('nombre_materia')}}" id="nombre_materia" class="form-control">
      @error('nombre_materia')
      <p class="form-text text-danger">{{$message}}</p>
      @enderror      

      <label for="Cod_materia" class="form-label">Código</label>
      <input type="number" name="Cod_materia" value = "{{old('Cod_materia')}}" id="Cod_materia" class="form-control"> 
      @error('Cod_materia')
      <p class="form-text text-danger">{{$message}}</p>
      @enderror
      
      @if (Session::has('mensaje'))
          <div class="alert alert-info my-5">
              {{Session::get('mensaje')}}
         </div>
      @endif
      <input class="btn btn-lg  btn-block" type="submit" value="Registrar">

    </form>
  </div>

  <div class="col-xl-9 col-md-8 col-12">
    <h3 id="listaSecciones">Lista de materias</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Código</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
    
      <tr>
          <td>nombre</td>
          <td>codigo</td>
          <td><button id="EditarEliminar">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path
                  d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd"
                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
              </svg></button>
            <button id="EditarEliminar">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </button>
          </td>
        </tr> 
         
      </tbody>
    </table>
  </div>
</div>

</div>
@endsection