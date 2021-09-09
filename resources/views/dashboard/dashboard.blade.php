<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ url('css/cover.css') }}" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto text-center">
        <div>
        <h3 class="float-md-center mb-0">Prospectos</h3>
        <nav>
          @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('registro') }}" class="btn btn-lg btn-secondary text-sm text-gray-700 underline">Entrar</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-lg btn-secondary text-sm text-gray-700 underline">Iniciar Sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-lg btn-secondary ml-4 text-sm underline">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>Ejercicio Práctico</h1>
        <p class="lead">Desarrollar un sistema que permita a los promotores el seguimiento de sus prospectos a ser
            clientes, así como una pantalla para el departamento de evaluación de prospectos donde se pueda
            visualizar la información del prospecto, donde le permita la autorización o rechazo del mismo</p>
        <p class="lead">
        <a href="{{ url('registro') }}" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Empezar</a>
        </p>
    </main>

    <footer class="mt-auto text-white-50">

    </footer>
    </div>

  </body>
</html>
