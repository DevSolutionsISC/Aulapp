<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
  <link rel="stylesheet" href="{{asset('css/editar.css')}}" />
  <title>Gestion</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
        <h3>Reporte de rechazados</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
          <a href="/respuestaAdmin"><img src="{{asset('Imagenes/campana.png')}}" id="campana" width="30" alt="notificaciones">
          </a>
          <a  class=" position-relative" id="cant_not">
           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
         {{$not}}
          </span>
          </a>
          <a class="nav-link active" aria-current="page" href="/menu" id="inicio">Inicio</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
    
    @if(count($rechazados) == 0)
      
    <br>
    <br>
    <br>
    <h4 class="row justify-content-center">No hay resultados</h4>

    @else

    <table class="table table-striped" id="tablaRechazados">
    
          <thead>                
                <tr>
                      <th scope="col">Fecha de envío</th>
                      <th scope="col">Docente</th>
                      <th scope="col">Materia</th>
                      <th scope="col">Motivo</th>
                      <th scope="col">Fecha de examen</th>

                </tr>
          </thead>
          <tbody>

                 @foreach($rechazados as $rechazado)
                 <tr data-url="{{route('respuestas',['tipo'=>'recibido','id'=>$rechazado->id])}}">
                       <td>{{$rechazado->created_at}}</td>
                       <td>{{$rechazado->docentes}}</td>
                       <td>{{$rechazado->materia}}</td>
                       <td>{{$rechazado->motivo}}</td>
                       <td>{{$rechazado->fecha_examen}}</td>
                       
    
                 </tr>    
                 @endforeach 
                
          </tbody>
    </table>
    @endif

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
    $(function () {$('table.table tr').click(function () {  
      if( $(this).data('url')!=null){
        window.location.href = $(this).data('url');
      }
       });
    }) 
  </script>
<script>
      $('#tablaRechazados').DataTable({
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

  </body>
  
</html>