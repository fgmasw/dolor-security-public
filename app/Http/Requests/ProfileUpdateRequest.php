<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],  // Regla para apellidos
            'dni' => ['required', 'string', 'regex:/^\d{8}[A-Za-z]$/'],  // Regla para DNI (formato español)
            'telefono' => ['nullable', 'string', 'regex:/^\+?\d{9,12}$/'],  // Regla para teléfono
            'pais' => ['required', 'string', 'max:2'],  // Regla para país (código de 2 letras)
            'sobre_ti' => ['nullable', 'string', 'max:250'],  // Regla para descripción personal
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe tener más de 255 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.string' => 'El campo correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no debe tener más de 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ];
    }
}
