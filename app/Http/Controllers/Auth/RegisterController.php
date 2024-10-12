<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Maneja la solicitud de registro.
     */
    public function register(Request $request)
    {
        // Validación de los datos con mensajes personalizados
        $this->validator($request->all())->validate();

        // Creación del nuevo usuario
        $user = $this->create($request->all());

        // Inicio de sesión automático después del registro (opcional)
        auth()->login($user);

        // Redirigir al dashboard u otra ruta
        return redirect()->route('dashboard');
    }

    /**
     * Valida los datos de registro con mensajes en español.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
                'regex:/^\d{8}[A-Za-z]$/'
            ],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users'
            ],
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}$/', 
                'confirmed'
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
    }

    /**
     * Mensajes de error personalizados en español.
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

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe incluir una letra mayúscula, una minúscula, un número y un símbolo.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',

            'telefono.regex' => 'El formato del número de teléfono no es válido. Debe contener entre 9 y 12 dígitos y puede incluir el símbolo +.',
            
            'sobre_ti.min' => 'La descripción personal debe tener al menos 20 caracteres.',
            'sobre_ti.max' => 'La descripción personal no puede exceder los 250 caracteres.',
        ];
    }

    /**
     * Crea un nuevo usuario.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellidos' => $data['apellidos'],
            'dni' => $data['dni'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telefono' => $data['telefono'],
            'pais' => $data['pais'],
            'sobre_ti' => $data['sobre_ti'],
        ]);
    }
}
