@extends('dashboard.layoutBar')
@section('title')
<title>Listado Prospectos</title>
@endsection
@section('css')
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12 position-relative">
            <table id="listado" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre del prospecto</th>
                        <th>Primero apellido</th>
                        <th>Segundo apellido</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($listado as $prospecto)
                        <tr data-href="{{ url("verProspecto/{$prospecto->id}") }}">
                            <td>{{$prospecto->nombre}}</td>
                            <td>{{$prospecto->apellido_p}}</td>
                            <td>{{$prospecto->apellido_m}}</td>
                            <td>
                                @if ($prospecto->estatus==1)
                                    <h4 class="enviado">Enviado</h4>
                                @elseif ($prospecto->estatus==2)
                                    <h4 class="autorizado">Autorizado</h4>
                                @elseif ($prospecto->estatus==3)
                                    <h4 class="rechazado">Rechazado</h4>
                                @endif
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </main>
@endsection
@section('js')
    <script  type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script  type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script  type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>

  <script  type="text/javascript">

  //hace funcionar el datatables
  $(document).ready(function() {
    $.noConflict();
        var table = $('#listado').DataTable({
            
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "language": {
            "lengthMenu": "Filtrar cantidad de registros _MENU_",
            "zeroRecords": "No hay registros - Lo siento",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "search":         "Buscar:",
        }
    });
    } );
  </script>

  <script>

      //link de referencia al seleccionar un registro de la tabla
      $('tr[data-href]').on("click", function() {
        document.location = $(this).data('href');
    });
  </script>
@endsection