<!-- resources/views/partials/header.blade.php -->
<header class="bg-gray-800 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold">
            Unidad de Dolor
        </a>

        <!-- Navegación -->
        <nav class="space-x-4">
       
            <!-- Mostrar enlaces para usuarios invitados (no autenticados) -->
            @guest
                <a href="{{ route('login') }}" class="hover:text-gray-400">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="hover:text-gray-400">Registrarse</a>
            @endguest

            <!-- Mostrar enlaces para usuarios autenticados -->
            @auth
                <a href="{{ route('profile.edit') }}" class="hover:text-gray-400">Perfil</a>     
         
                <!-- Enlace para cerrar sesión -->
                <a href="{{ route('logout') }}" class="hover:text-gray-400"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </nav>
    </div>
</header>
