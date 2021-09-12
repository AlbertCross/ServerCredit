@extends('dashboard.layoutBar')
@section('title')
<title>Aplicación</title>
@endsection
@section('content')
<main class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">Selecciona el icono para descargar la aplicación</h4>
        </div>
        <br>
        <div class="col-md-12">
            <a href='{{url("aplicacion/concredito.apk")}}' download><img src="{{asset("images/descargar.png")}}" width="30%" alt=""></a>

        </div>
        <div class="col-md-12">
            <video src="{{ url("video/prueba.mp4") }}" width="480" height="640" autoplay muted loop></video>
        </div>
    </div>
  </main>
@endsection