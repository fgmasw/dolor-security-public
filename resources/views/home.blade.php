<x-guest-layout>
    <div class="flex justify-center items-center min-h-[25vh] bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white shadow-md rounded-lg">
            <!-- Texto de bienvenida -->
            <h2 class="text-2xl font-bold text-center mb-4">Bienvenido a la Unidad de Dolor</h2>
            <p class="text-center text-gray-600 mb-6">Seleccione una opción para continuar:</p>

            <!-- Botones de inicio de sesión y registro -->
            <div class="flex flex-col space-y-4">
                <a href="{{ route('login') }}" class="inline-flex justify-center w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="inline-flex justify-center w-full px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Registrarse
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
