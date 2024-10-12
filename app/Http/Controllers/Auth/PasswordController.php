<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Actualiza la contraseña del usuario.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validaciones de los datos con mensajes en español
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => [
                'required', 
                'current_password', 
                'string'
            ],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(10)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(), // Regla personalizada para complejidad de contraseña
            ],
        ], [
            // Mensajes personalizados en español
            'current_password.required' => 'El campo de contraseña actual es obligatorio.',
            'current_password.current_password' => 'La contraseña actual no es correcta.',
            'password.required' => 'El campo de la nueva contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La nueva contraseña debe tener al menos 10 caracteres.',
            'password.letters' => 'La nueva contraseña debe contener al menos una letra.',
            'password.mixedCase' => 'La nueva contraseña debe contener letras mayúsculas y minúsculas.',
            'password.numbers' => 'La nueva contraseña debe incluir al menos un número.',
            'password.symbols' => 'La nueva contraseña debe incluir al menos un símbolo especial.',
        ]);

        // Actualización de la contraseña del usuario
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return back()->with('status', 'Contraseña actualizada exitosamente.');
    }
}
