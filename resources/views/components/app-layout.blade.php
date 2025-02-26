<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Unidad de Dolor') }}</title>

    <!-- Incluye los estilos de Tailwind -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100">

    <!-- Contenido principal -->
    <main class="py-4">
        {{ $slot }}
    </main>

    <!-- Mensajes de Éxito y Error -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @stack('scripts')
</body>
</html>
