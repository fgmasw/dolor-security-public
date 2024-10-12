<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        Log::info('Displaying login view');
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->ensureIsNotRateLimited($request);

        try {
            Log::info('Attempting to authenticate user: '.$request->email);
            $request->authenticate();

            $request->session()->regenerate();
            Log::info('User authenticated and session regenerated for '.$request->email);

            RateLimiter::clear($this->throttleKey($request));

            Log::info('Rate limit cleared for user: '.$request->email);

            return redirect()->intended(route('dashboard'));
        } catch (ValidationException $e) {
            Log::warning('Authentication failed for user: '.$request->email);
            RateLimiter::hit($this->throttleKey($request), 10800); // Tiempo de bloqueo

            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info('Destroying session for user');

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        $key = $this->throttleKey($request);
        Log::info('Checking rate limiting for '.$key);

        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            Log::info('Limit reached, blocking user '.$key.' for '.$seconds.' seconds');

            throw ValidationException::withMessages([
                'email' => __('auth.throttle', [
                    'seconds' => $seconds,
                ]),
                'message' => 'Has superado el límite de 2 intentos fallidos. La cuenta está bloqueada temporalmente por 10800 segundos.'
            ]);
        }
    }

    /**
     * Get the throttle key for the request.
     */
    protected function throttleKey(Request $request): string
    {
        return strtolower($request->input('email')).'|'.$request->ip();
    }
}
