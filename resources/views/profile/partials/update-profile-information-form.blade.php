<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualiza la información de tu perfil y dirección de correo electrónico.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre*')" />
            <x-text-input id="name" 
                          name="name" 
                          type="text" 
                          class="mt-1 block w-full @error('name') border-red-500 @enderror" 
                          :value="old('name', $user->name)" 
                          required 
                          minlength="2" 
                          maxlength="20" 
                          pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                          title="Solo se permiten letras y espacios. Mínimo 2 caracteres, máximo 20."
                          autofocus 
                          autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Apellidos -->
        <div>
            <x-input-label for="apellidos" :value="__('Apellidos*')" />
            <x-text-input id="apellidos" 
                          name="apellidos" 
                          type="text" 
                          class="mt-1 block w-full @error('apellidos') border-red-500 @enderror" 
                          :value="old('apellidos', $user->apellidos)" 
                          required 
                          minlength="2" 
                          maxlength="40" 
                          pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                          title="Solo se permiten letras y espacios. Mínimo 2 caracteres, máximo 40."
                          autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('apellidos')" />
        </div>

        <!-- DNI -->
        <div>
            <x-input-label for="dni" :value="__('DNI*')" />
            <x-text-input id="dni" 
                          name="dni" 
                          type="text" 
                          class="mt-1 block w-full @error('dni') border-red-500 @enderror" 
                          :value="old('dni', $user->dni)" 
                          required 
                          pattern="\d{8}[A-Za-z]" 
                          title="Formato: 8 números seguidos de una letra. Ejemplo: 11111112L"
                          autocomplete="dni" />
            <x-input-error class="mt-2" :messages="$errors->get('dni')" />
        </div>

        <!-- Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico*')" />
            <x-text-input id="email" 
                          name="email" 
                          type="email" 
                          class="mt-1 block w-full @error('email') border-red-500 @enderror" 
                          :value="old('email', $user->email)" 
                          required 
                          autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Tu dirección de correo electrónico no está verificada.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nuevo enlace de verificación ha sido enviado a tu dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" 
                          name="telefono" 
                          type="tel" 
                          class="mt-1 block w-full @error('telefono') border-red-500 @enderror" 
                          :value="old('telefono', $user->telefono)" 
                          pattern="^\+?\d{9,12}$" 
                          title="El número de teléfono debe tener entre 9 y 12 dígitos. Puede incluir el símbolo + para el prefijo de país."
                          autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <!-- País -->
        <div>
            <x-input-label for="pais" :value="__('País')" />
            <select id="pais" name="pais" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('pais') border-red-500 @enderror">
                <option value="ES" {{ old('pais', $user->pais) == 'ES' ? 'selected' : '' }}>{{ __('España') }}</option>
                <option value="US" {{ old('pais', $user->pais) == 'US' ? 'selected' : '' }}>{{ __('Estados Unidos') }}</option>
                <option value="AR" {{ old('pais', $user->pais) == 'AR' ? 'selected' : '' }}>{{ __('Argentina') }}</option>
                <option value="BO" {{ old('pais', $user->pais) == 'BO' ? 'selected' : '' }}>{{ __('Bolivia') }}</option>
                <option value="BR" {{ old('pais', $user->pais) == 'BR' ? 'selected' : '' }}>{{ __('Brasil') }}</option>
                <option value="CL" {{ old('pais', $user->pais) == 'CL' ? 'selected' : '' }}>{{ __('Chile') }}</option>
                <option value="CO" {{ old('pais', $user->pais) == 'CO' ? 'selected' : '' }}>{{ __('Colombia') }}</option>
                <option value="CR" {{ old('pais', $user->pais) == 'CR' ? 'selected' : '' }}>{{ __('Costa Rica') }}</option>
                <option value="CU" {{ old('pais', $user->pais) == 'CU' ? 'selected' : '' }}>{{ __('Cuba') }}</option>
                <option value="DO" {{ old('pais', $user->pais) == 'DO' ? 'selected' : '' }}>{{ __('República Dominicana') }}</option>
                <option value="EC" {{ old('pais', $user->pais) == 'EC' ? 'selected' : '' }}>{{ __('Ecuador') }}</option>
                <option value="SV" {{ old('pais', $user->pais) == 'SV' ? 'selected' : '' }}>{{ __('El Salvador') }}</option>
                <option value="GT" {{ old('pais', $user->pais) == 'GT' ? 'selected' : '' }}>{{ __('Guatemala') }}</option>
                <option value="HN" {{ old('pais', $user->pais) == 'HN' ? 'selected' : '' }}>{{ __('Honduras') }}</option>
                <option value="MX" {{ old('pais', $user->pais) == 'MX' ? 'selected' : '' }}>{{ __('México') }}</option>
                <option value="NI" {{ old('pais', $user->pais) == 'NI' ? 'selected' : '' }}>{{ __('Nicaragua') }}</option>
                <option value="PA" {{ old('pais', $user->pais) == 'PA' ? 'selected' : '' }}>{{ __('Panamá') }}</option>
                <option value="PY" {{ old('pais', $user->pais) == 'PY' ? 'selected' : '' }}>{{ __('Paraguay') }}</option>
                <option value="PE" {{ old('pais', $user->pais) == 'PE' ? 'selected' : '' }}>{{ __('Perú') }}</option>
                <option value="PR" {{ old('pais', $user->pais) == 'PR' ? 'selected' : '' }}>{{ __('Puerto Rico') }}</option>
                <option value="UY" {{ old('pais', $user->pais) == 'UY' ? 'selected' : '' }}>{{ __('Uruguay') }}</option>
                <option value="VE" {{ old('pais', $user->pais) == 'VE' ? 'selected' : '' }}>{{ __('Venezuela') }}</option>
                
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('pais')" />
        </div>

        <!-- Sobre ti -->
        <div>
            <x-input-label for="sobre_ti" :value="__('Sobre ti (Descripción personal)')" />
            <textarea id="sobre_ti" 
                      name="sobre_ti" 
                      class="mt-1 block w-full @error('sobre_ti') border-red-500 @enderror" 
                      rows="3" 
                      minlength="20" 
                      maxlength="250" 
                      autocomplete="sobre-ti">{{ old('sobre_ti', $user->sobre_ti) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('sobre_ti')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
