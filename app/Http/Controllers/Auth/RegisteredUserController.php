<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:20', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'apellidos' => ['required', 'string', 'min:2', 'max:40', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'dni' => ['required', 'string', 'regex:/^\d{8}[A-Za-z]$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}$/', 'confirmed'],
            'telefono' => ['nullable', 'string', 'regex:/^\+?\d{9,12}$/'],
            'pais' => ['nullable', 'string'],
            'sobre_ti' => ['nullable', 'string', 'min:20', 'max:250'],
        ], [
            // Mensajes de error personalizados en español
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede exceder los 20 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.min' => 'Los apellidos deben tener al menos 2 caracteres.',
            'apellidos.max' => 'Los apellidos no pueden exceder los 40 caracteres.',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.regex' => 'El formato del DNI no es válido. Debe ser 8 números seguidos de una letra.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe incluir una letra mayúscula, una minúscula, un número y un símbolo.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'telefono.regex' => 'El teléfono debe tener entre 9 y 12 dígitos y puede incluir un prefijo de país.',
            'sobre_ti.min' => 'La descripción personal debe tener al menos 20 caracteres.',
            'sobre_ti.max' => 'La descripción personal no puede exceder los 250 caracteres.',
        ]);

        // Si la validación falla, redirigir con los errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el usuario si la validación pasa
        $user = User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'sobre_ti' => $request->sobre_ti,
        ]);

        event(new Registered($user));

        // Autenticación automática después del registro
        Auth::login($user);

        // Redirigir al dashboard
        return redirect(route('dashboard'));
    }
}
