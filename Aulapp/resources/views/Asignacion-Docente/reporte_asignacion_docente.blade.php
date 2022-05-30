@extends('plantilla')

@section('title', 'Asignacion docente')
@section("editar","")
@section("registrar","materia_docente")
@section("reporte","")
@section("eliminar","eliminar-asignacion-docente")
@section('Titulo')
<h3 text-center>Administracion de docente-grupo</h3>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('Contenido formulario')

<h3 class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de docentes y sus materias</h3>
     

      <table class="table table-striped " id="tablita">
      
            <thead>       

                  <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Activo</th>

                  </tr>
            </thead>
            <tbody>
                    @foreach($asignacionDocentes as $asignacionDocente)
                   <tr>
                        @if ($asignacionDocente->user_rol_id!="")
                             
                       
                        <td>{{$asignacionDocente->id}}</td>
                        <td>{{$asignacionDocente->user_rol->usuario->Nombre}}</td>
                        <td>{{$asignacionDocente->user_rol->usuario->Apellido}}</td>
                        <td>{{$asignacionDocente->grupos->materia_carrera->materia->nombre_materia}}</td>
                        <td>{{$asignacionDocente->grupos->nombre}}</td>
                        <td>{{$asignacionDocente->grupos->materia_carrera->carrera->Nombre}}</td>
                        
                         @if($asignacionDocente->estado==1)
                                                
                                <td>SI</td>
                    
                          @else
                                <td>NO</td>
                                                              
                          @endif
                          @endif
                   </tr>     
                  @endforeach
            </tbody>
      </table>

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
      $('#tablita').DataTable({
      responsive:true,
      autoWidth:false,
      "language": {
            "lengthMenu": "Mostrar _MENU_  ",
            "zeroRecords": "No hay resultados",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search":"Buscar",
            "paginate":{
                  "next":"Siguiente",
                  "previous":"Anterior"
            }
        }
      });
     
</script>
<script>
      var editar=document.getElementById("editar")
      editar.style.display="none"
</script>
@endsection