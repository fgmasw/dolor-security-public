<!-- resources/views/auth/register.blade.php -->

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre*')" />
            <x-text-input id="name" class="block mt-1 w-full @error('name') border-red-500 @enderror" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          required 
                          minlength="2" 
                          maxlength="20" 
                          pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                          title="Solo se permiten letras y espacios. Mínimo 2 caracteres, máximo 20."
                          autofocus 
                          autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Apellidos -->
        <div class="mt-4">
            <x-input-label for="apellidos" :value="__('Apellidos*')" />
            <x-text-input id="apellidos" class="block mt-1 w-full @error('apellidos') border-red-500 @enderror" 
                          type="text" 
                          name="apellidos" 
                          :value="old('apellidos')" 
                          required 
                          minlength="2" 
                          maxlength="40" 
                          pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                          title="Solo se permiten letras y espacios. Mínimo 2 caracteres, máximo 40."
                          autocomplete="family-name" />
            <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
        </div>

        <!-- DNI -->
        <div class="mt-4">
            <x-input-label for="dni" :value="__('DNI*')" />
            <x-text-input id="dni" class="block mt-1 w-full @error('dni') border-red-500 @enderror" 
                          type="text" 
                          name="dni" 
                          :value="old('dni')" 
                          required 
                          pattern="\d{8}[A-Za-z]" 
                          title="Formato: 8 números seguidos de una letra. Ejemplo: 11111112L"
                          autocomplete="dni" />
            <x-input-error :messages="$errors->get('dni')" class="mt-2" />
        </div>

        <!-- Dirección de correo electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo electrónico*')" />
            <x-text-input id="email" class="block mt-1 w-full @error('email') border-red-500 @enderror" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña*')" />
            <x-text-input id="password" class="block mt-1 w-full @error('password') border-red-500 @enderror"
                          type="password"
                          name="password"
                          required 
                          minlength="10" 
                          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{10,}"
                          title="La contraseña debe tener al menos 10 caracteres, incluir una letra mayúscula, una minúscula, un número y un símbolo."
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña*')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full @error('password_confirmation') border-red-500 @enderror"
                          type="password"
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full @error('telefono') border-red-500 @enderror" 
                          type="tel" 
                          name="telefono" 
                          :value="old('telefono')" 
                          pattern="^\+?\d{9,12}$" 
                          title="El número de teléfono debe tener entre 9 y 12 dígitos. Puede incluir el símbolo + para el prefijo de país."
                          autocomplete="tel" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- País -->
        <div class="mt-4">
            <x-input-label for="pais" :value="__('País')" />
            <select id="pais" name="pais" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('pais') border-red-500 @enderror">
                <option value="">{{ __('Seleccionar país') }}</option>
                <option value="ES" {{ old('pais') == 'ES' ? 'selected' : '' }}>{{ __('España') }}</option>
                <option value="US" {{ old('pais') == 'US' ? 'selected' : '' }}>{{ __('Estados Unidos') }}</option>
                <option value="AR">{{ __('Argentina') }}</option>
                <option value="BO">{{ __('Bolivia') }}</option>
                <option value="BR">{{ __('Brasil') }}</option>
                <option value="CL">{{ __('Chile') }}</option>
                <option value="CO">{{ __('Colombia') }}</option>
                <option value="CR">{{ __('Costa Rica') }}</option>
                <option value="CU">{{ __('Cuba') }}</option>
                <option value="DO">{{ __('República Dominicana') }}</option>
                <option value="EC">{{ __('Ecuador') }}</option>
                <option value="SV">{{ __('El Salvador') }}</option>
                <option value="GT">{{ __('Guatemala') }}</option>
                <option value="HN">{{ __('Honduras') }}</option>
                <option value="MX">{{ __('México') }}</option>
                <option value="NI">{{ __('Nicaragua') }}</option>
                <option value="PA">{{ __('Panamá') }}</option>
                <option value="PY">{{ __('Paraguay') }}</option>
                <option value="PE">{{ __('Perú') }}</option>
                <option value="PR">{{ __('Puerto Rico') }}</option>
                <option value="UY">{{ __('Uruguay') }}</option>
                <option value="VE">{{ __('Venezuela') }}</option>
            </select>
            <x-input-error :messages="$errors->get('pais')" class="mt-2" />
        </div>

        <!-- Sobre ti -->
        <div class="mt-4">
            <x-input-label for="sobre_ti" :value="__('Sobre ti (Descripción personal)')" />
            <textarea id="sobre_ti" class="block mt-1 w-full @error('sobre_ti') border-red-500 @enderror" 
                      name="sobre_ti" 
                      rows="3" 
                      minlength="20" 
                      maxlength="250" 
                      autocomplete="sobre-ti">{{ old('sobre_ti') }}</textarea>
            <x-input-error :messages="$errors->get('sobre_ti')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <!-- Enlace para iniciar sesión si ya está registrado -->
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <!-- Botón de registro -->
            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>

        <!-- Opción para ir a home.blade.php -->
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('home') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('Ir a la página principal') }}
            </a>
        </div>
    </form>
</x-guest-layout>
