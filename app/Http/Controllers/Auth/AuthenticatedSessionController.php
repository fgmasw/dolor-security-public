<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->ensureIsNotRateLimited($request);

        try {
            $request->authenticate();

            $request->session()->regenerate();

            RateLimiter::clear($this->throttleKey($request));

            return redirect()->intended(route('dashboard'));
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Ensure the login request is not rate limited.
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        $key = $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'message' => __('auth.throttle', ['seconds' => $seconds]),
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
