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
        Log::info("LoginRequest: authorize method called.");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        Log::info("LoginRequest: Setting validation rules for email and password.");
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     */
    public function authenticate(): void
    {
        Log::info("LoginRequest: authenticate method called for user: ".$this->input('email'));
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            Log::warning("LoginRequest: Authentication failed for user: ".$this->input('email'));

            RateLimiter::hit($this->throttleKey(), 10800);
            Log::info('LoginRequest: Rate limiter hit for user: '.$this->input('email'));

            $attemptsLeft = 2 - RateLimiter::attempts($this->throttleKey());
            Log::info('LoginRequest: Number of attempts left for user: '.$attemptsLeft);

            if ($attemptsLeft > 0) {
                Log::info("LoginRequest: Throwing validation warning with {$attemptsLeft} attempt(s) left.");
                throw ValidationException::withMessages([
                    'email' => __('auth.failed_with_attempts', ['attempts' => $attemptsLeft]),
                ]);
            }

            Log::info("LoginRequest: No attempts left. Blocking user: ".$this->input('email'));
            throw ValidationException::withMessages([
                'message' => __('auth.throttle', ['seconds' => 10800]),
            ]);
        }

        Log::info("LoginRequest: Authentication successful for user: ".$this->input('email'));
        RateLimiter::clear($this->throttleKey());
        Log::info('LoginRequest: Rate limiter cleared for user: '.$this->input('email'));
    }

    /**
     * Ensure the login request is not rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        Log::info("LoginRequest: ensureIsNotRateLimited method called.");
        $key = $this->throttleKey();
        Log::info('LoginRequest: Checking rate limiting for key: '.$key);

        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            Log::info('LoginRequest: User '.$key.' blocked for '.$seconds.' seconds.');

            event(new Lockout($this));

            throw ValidationException::withMessages([
                'message' => __('auth.throttle', ['seconds' => $seconds]),
            ]);
        }
        Log::info("LoginRequest: User has not exceeded the rate limit.");
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        Log::info("LoginRequest: throttleKey method called.");
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
