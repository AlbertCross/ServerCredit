@extends('dashboard.layoutBar')
@section('title')
<title>Registro Prospectos</title>
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12 position-relative">
            <div class="bg-light p-4 rounded position-absolute top-0 start-50 translate-middle-x padding-form">
                <form class="needs-validation" novalidate method="POST" action="{{ route('clientProspecto') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Apellido paterno</label>
                        <input type="text" class="form-control" name="apellido_p" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Apellido materno</label>
                        <input type="text" class="form-control"  name="apellido_m" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Calle</label>
                        <input type="text" class="form-control"  name="calle" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstName" class="form-label">Colonia</label>
                        <input type="text" class="form-control" name="colonia" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="firstName" class="form-label">Numero</label>
                        <input type="number" class="form-control" name="numero" required>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Codigo postal</label>
                        <input type="text" class="form-control" name="cp" required >
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Teléfono</label>
                        <input type="text" class="form-control"  name="telefono" required  min="0" max="9" maxlength=10
                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc" required min="0" max="9" maxlength=13>
                        <div class="invalid-feedback">
                        Elemento requerido.
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label" for="">¿Agregar otro?</label>
                                <a class="plus" onclick="popletappend();">
                                    <img class=" more-files" src="{{ url('images/iconos/mas.png') }}" alt="">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label minus" for="" style="display: none">¿Quitar uno?</label>
                                <a class="minus" style="display: none;" onclick="popletremove();">
                                    <img class=" more-files" src="{{ url('images/iconos/boton-x.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="popletsinput">
                            <div class="file-field input-field poplet1">
                                <input name="poplets" type="hidden" class="popletsnum">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc1" required>
                                        <div class="invalid-feedback">
                                            Elemento requerido.
                                        </div>
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet1" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Elemento requerido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet2" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc2">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet3" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc3">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet3" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet4" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc4">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet4" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet5" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc5">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet5" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet6" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc6">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet6" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet7" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc7">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet7" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet8" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc8">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet8" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="file-field input-field poplet9" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc9">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet9" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="file-field input-field poplet10" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""  class="form-label">Nombre documento</label>
                                        <input  class="form-control" type="text" name="nombredoc10">
                                    </div>
                                    <div class="col-md-8 padd-input">
                                        <input type="file" name="poplet10" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="w-100 btn btn-success btn-lg" type="submit">Enviar</button>
                        </div>
                        <div class="col-md-6">
                            
                    <button class="w-100 btn btn-danger btn-lg" type="button">Salir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </main>
  <script>
      var poplet = 1;
//funcion para mostrar mas input para documentos
      function popletappend() {
          poplet++;
          $(".poplet" + poplet).fadeIn();

          $('.minus').fadeIn();
          $('.popletsnum').val(poplet);
          if (poplet >= 10) {
              $('.plus').fadeOut();
          }
      }
//funcion para quitar input para documentos

      function popletremove() {
          $(".poplet" + poplet).fadeOut();
          poplet--;
          if (poplet <= 1) {
              $('.minus').fadeOut();
          }
          if (poplet < 11) {
              $('.plus').fadeIn();
          }
          $('.popletsnum').val(poplet);
      }
  </script>
@endsection