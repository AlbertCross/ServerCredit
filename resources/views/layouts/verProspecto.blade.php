@extends('dashboard.layoutBar')
@section('title')
<title>Registro Prospectos</title>
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12 position-relative">
            <div class="bg-light p-4 rounded position-absolute top-0 start-50 translate-middle-x padding-form">
                <form class="needs-validation" novalidate method="POST" action="{{ route('autorizarProspecto') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                    <div class="col-sm-4">
                        <input type="hidden" value="{{ $prospecto->id }}" name="prospecto_id">
                        <label for="firstName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre"  value="{{ $prospecto->nombre }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Apellido paterno</label>
                        <input type="text" class="form-control" name="apellido_p"  value="{{ $prospecto->apellido_p }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Apellido materno</label>
                        <input type="text" class="form-control"  name="apellido_m"  value="{{ $prospecto->apellido_m }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Calle</label>
                        <input type="text" class="form-control"  name="calle"  value="{{ $prospecto->calle }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Colonia</label>
                        <input type="text" class="form-control" name="colonia"  value="{{ $prospecto->colonia }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="firstName" class="form-label">Numero</label>
                        <input type="number" class="form-control" name="numero"  value="{{ $prospecto->numero }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Codigo postal</label >
                        <input type="text" class="form-control" name="cp"  value="{{ $prospecto->codigo_postal }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Teléfono</label>
                        <input type="text" class="form-control"  name="telefono"   min="0" max="9" maxlength=10
                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="{{ $prospecto->telefono }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc"  min="0" max="9" maxlength=13 value="{{ $prospecto->rfc }}" readonly>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Estado</label>
                            @if ($prospecto->estatus==1)
                            <input type="text" class="form-control" value="Enviado" readonly>
                            @elseif ($prospecto->estatus==2)
                            <input type="text" class="form-control" value="Autorizado" readonly>
                            @elseif ($prospecto->estatus==3)
                            <input type="text" class="form-control" value="Rechazado" readonly>
                            @endif
                    </div>
                    <!-- si el prospecto tiene estatus 3 muestra la observacion del rechazo  -->
                    @if ($prospecto->estatus==3)
                        <div class="col-sm-12">
                            <label for="firstName" class="form-label">Observación</label>
                            <input type="text" class="form-control" name="observaciones" value="{{ $prospecto->observaciones }}" readonly>
                            <div class="invalid-feedback">
                            Elemento requerido.
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <label for="" class="form-label">Archivos</label>
                    </div>

                    <!-- recorre y muestra la cantidad de documentos del prospecto y si tiene muestra el icono de descargar el documento  -->
                    @foreach ($documentos as $doc)
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nombre: {{ $doc->nombre_doc }}</label>
                            @if ( $doc->documento==""|| $doc->documento==null)
                            @else
                                <a href='{{url('documentos/'.$doc->documento)}}' download>
                                    <img class="imgDown" src="{{ url('images/iconos/disminucion.png') }}" alt="">
                                </a>
                            @endif
                        </div>
                    @endforeach

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-6">
                    <!-- defino dependiendo el estatus del prospecto para determinar que boton mostrar -->
                            @if ($prospecto->estatus==2 || $prospecto->estatus==3)
                            @else
                                <button class="w-100 btn btn-success btn-lg" type="submit">Autorizar</button>
                            @endif
                        </div>
                        <div class="col-md-6">

                            @if ($prospecto->estatus==3)
                            @else
                                <button class="w-100 btn btn-danger btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#rechazarModal">Rechazar</button>
                            @endif
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
<!-- Modal para rechazar el prospecto-->
<div class="modal fade" id="rechazarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Motivo de rechazar el prospecto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('observacionRechazar') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $prospecto->id }}" name="prospecto_id">
                <div class="row div-pad">
                    <div class="col-sm-12">
                        <label for="firstName" class="form-label">Observación</label>
                        <input type="text" class="form-control" name="observaciones" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  </main>
@endsection