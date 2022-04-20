@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de materias</h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="col-xl-3 col-md-4 col-12">
    <form method="POST" action="{{route('materias')}}" id="formulario">
      @csrf
      <h3 text-center>Registrar Materia</h3>

      <label for="nombre_materia" class="form-label">Nombre</label>
      <input type="text" id="nombre_materia" class="form-control" name="nombre_materia" value="{{old('nombre_materia')}}" autofocus>
      @if ($errors->has('nombre_materia'))
      <span class="error text-danger" for="input-nombre_materia">{{ $errors->first('nombre_materia') }}</span>
      @endif
      <br>
      <label for="Cod_materia" class="form-label">Código</label>
      <input type="text" id="Cod_materia" class="form-control" name="Cod_materia" value="{{old('Cod_materia')}}"
        autofocus>
      @if ($errors->has('Cod_materia'))
      <span class=" error text-danger" for="input-Cod_materia">{{ $errors->first('Cod_materia') }}</span>
      @endif
      <br>
      <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
    </form>
  </div>

  <div class="col-xl-9 col-md-8 col-12">
    <h3 id="listaMaterias">Lista de Materias</h3>
    <table class="table table-striped">
      <thead>
        <tr id="filaMateria">
          <th scope="col">Nombre</th>
          <th scope="col">Codigo</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($materias as $materia)
        <tr>
          <td>{{$materia->nombre_materia}}</td>
          <td>{{$materia->Cod_materia}}</td>

          <td>

          

          </td>
          <td>


         

  </div>

</div>
</td>


</tr>

@endforeach


</tbody>
</table>
</div>
</div>

@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.Eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estás seguro que quieres eliminar esta materia?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
      });
</script>
@if (session('registrar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Registro exitoso',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('actualizar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Cambios guardados exitosamente',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Materia eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection