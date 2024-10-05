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
        // Validación de los datos
        $this->validator($request->all())->validate();

        // Creación del nuevo usuario
        $user = $this->create($request->all());

        // Inicio de sesión automático después del registro (opcional)
        auth()->login($user);

        // Redirigir al dashboard u otra ruta
        return redirect()->route('dashboard');
    }

    /**
     * Valida los datos de registro.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:20', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'apellidos' => ['required', 'string', 'min:2', 'max:40', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/'],
            'dni' => ['required', 'string', 'regex:/^\d{8}[A-Za-z]$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}$/', 'confirmed'],
            'telefono' => ['nullable', 'string', 'regex:/^\+?\d{9,12}$/'],
            'pais' => ['nullable', 'string'],
            'sobre_ti' => ['nullable', 'string', 'min:20', 'max:250'],
        ]);
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
