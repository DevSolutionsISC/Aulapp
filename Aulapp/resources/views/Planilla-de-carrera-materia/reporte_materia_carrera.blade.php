@extends('plantilla')
@section('title', 'Carreras')
@section("editar","carreraEdit")
@section("registrar","carreras")
@section("reporte","")
@section("eliminar","eliminar-carrera")
@section('Titulo')
<h3 text-center>Administración de materia-carrera </h3>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('Contenido formulario')

<h3 class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de carreras y sus materias</h3>
     

      <table class="table table-striped " id="tablita">
      
            <thead>       

                  <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>
                        <th scope="col">Activo</th>
                        

                  </tr>
            </thead>
            <tbody>
                    @foreach($materia_carreras as $materia_carrera)
                   <tr>
                         <td>{{$materia_carrera->id}}</td>
                         <td>{{$materia_carrera->carrera->Nombre}}</td>
                         <td>{{$materia_carrera->materia->nombre_materia}}</td>
                         
                         @if($materia_carrera->estado==1)
                                                
                            <td>SI</td>

                          @else
                          
                           <td>NO</td>
                                          
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
@endsection