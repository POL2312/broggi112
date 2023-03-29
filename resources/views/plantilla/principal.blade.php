<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'])
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('inici') }}">Volver</a>

            <!-- Icono de la aplicación y ajuste de la posición -->
            <img src="https://via.placeholder.com/150x50" alt="Imagen" class="ms-4">

            <!-- Botón para el usuario -->
            <div class="btn-group ms-auto">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person"></i>
                    <span>{{ auth()->user()->nom }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-light" type="submit">Tancar Sessió</button>
                    </form>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <section>
            @yield('contingut')
        </section>
    </div>

</body>


</html>
