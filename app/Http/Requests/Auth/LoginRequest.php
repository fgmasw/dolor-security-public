<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        Log::info('Attempting to authenticate '.$this->input('email'));
        
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            Log::warning('Login attempt failed for user: '.$this->input('email'));
            RateLimiter::hit($this->throttleKey(), 10800); // Tiempo de bloqueo

            throw ValidationException::withMessages([
                'email' => __('Credenciales no válidas'),
            ]);
        }

        Log::info('Login successful for user: '.$this->input('email'));
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        $key = $this->throttleKey();
        Log::info('Checking rate limiting for '.$key);

        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            Log::info('Limit reached, blocking user '.$key.' for '.$seconds.' seconds');

            throw ValidationException::withMessages([
                'email' => __('auth.throttle', [ // Tiempo bloqueado en segundos
                    'seconds' => $seconds,
                ]),
                'message' => 'Has superado el límite de 2 intentos fallidos. La cuenta está bloqueada por 10800 segundos.',
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
