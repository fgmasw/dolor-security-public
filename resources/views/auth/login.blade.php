<!-- resources/views/auth/login.blade.php -->

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Dirección de correo electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            @if ($errors->has('email'))
                <div class="mt-2 text-red-600">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password" 
            />
            @if ($errors->has('password'))
                <div class="mt-2 text-red-600">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <!-- Mostrar el mensaje general de error (bloqueo o intentos fallidos) -->
        @if ($errors->has('message'))
            <div class="mt-4 text-red-600">
                {{ $errors->first('message') }}
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
