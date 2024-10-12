<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validar los datos del perfil, incluyendo unicidad de DNI y email
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:20',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/'
            ],
            'apellidos' => [
                'required',
                'string',
                'min:2',
                'max:40',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/'
            ],
            'dni' => [
                'required',
                'string',
                'regex:/^\d{8}[A-Za-z]$/',
                Rule::unique('users', 'dni')->ignore($request->user()->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($request->user()->id)
            ],
            'telefono' => [
                'nullable',
                'string',
                'regex:/^\+?\d{9,12}$/'
            ],
            'pais' => [
                'nullable',
                'string'
            ],
            'sobre_ti' => [
                'nullable',
                'string',
                'min:20',
                'max:250'
            ],
        ], $this->messages());

        // Actualizar los datos del usuario
        $request->user()->fill($validatedData);

        // Si el correo ha cambiado, invalidar la verificación previa
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Guardar los cambios en la base de datos
        $request->user()->save();

        // Redirigir al usuario a la página de edición con un mensaje de éxito
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Mensajes personalizados para la validación
     */
    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede exceder los 20 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.min' => 'Los apellidos deben tener al menos 2 caracteres.',
            'apellidos.max' => 'Los apellidos no pueden exceder los 40 caracteres.',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',

            'dni.required' => 'El DNI es obligatorio.',
            'dni.regex' => 'El formato del DNI no es válido. Debe contener 8 números seguidos de una letra (Ej: 12345678A).',
            'dni.unique' => 'Este DNI ya está registrado.', // Mensaje personalizado para DNI duplicado

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'telefono.regex' => 'El formato del número de teléfono no es válido. Debe contener entre 9 y 12 dígitos y puede incluir el símbolo +.',

            'sobre_ti.min' => 'La descripción personal debe tener al menos 20 caracteres.',
            'sobre_ti.max' => 'La descripción personal no puede exceder los 250 caracteres.',
        ];
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validar la contraseña actual antes de proceder con la eliminación
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Obtener el usuario
        $user = $request->user();

        // Cerrar la sesión del usuario
        Auth::logout();

        // Eliminar la cuenta del usuario
        $user->delete();

        // Invalidar la sesión y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al usuario a la página principal después de la eliminación
        return Redirect::to('/');
    }
}
