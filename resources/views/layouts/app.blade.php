<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Unidad de Dolor')</title>

    <!-- Incluir Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Incluir el header (acceso rápido) -->
    @include('partials.header')

    <!-- Contenido Principal -->
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>

    <!-- Mensajes de Éxito y Error -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500 text-white p-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Scripts -->
    @vite('resources/js/app.js')
</body>
</html>
