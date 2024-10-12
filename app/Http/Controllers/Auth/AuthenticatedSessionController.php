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
        Log::info('AuthenticatedSessionController: Displaying login view.');
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info('AuthenticatedSessionController: store method called for user: '.$request->email);
        $this->ensureIsNotRateLimited($request);

        try {
            Log::info('AuthenticatedSessionController: Attempting authentication for user: '.$request->email);
            $request->authenticate();

            $request->session()->regenerate();
            Log::info('AuthenticatedSessionController: Session regenerated for user: '.$request->email);

            RateLimiter::clear($this->throttleKey($request));
            Log::info('AuthenticatedSessionController: Rate limiter cleared for user: '.$request->email);

            return redirect()->intended(route('dashboard'));
        } catch (ValidationException $e) {
            Log::warning('AuthenticatedSessionController: Authentication failed for user: '.$request->email);

            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info('AuthenticatedSessionController: Logging out user and destroying session.');

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
        Log::info("AuthenticatedSessionController: Checking rate limit for user: ".$request->email);

        $key = $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            Log::info('AuthenticatedSessionController: User '.$key.' is blocked for '.$seconds.' seconds.');

            throw ValidationException::withMessages([
                'message' => __('auth.throttle', ['seconds' => $seconds]),
            ]);
        }
        Log::info("AuthenticatedSessionController: User has not exceeded rate limit.");
    }

    /**
     * Get the throttle key for the request.
     */
    protected function throttleKey(Request $request): string
    {
        Log::info("AuthenticatedSessionController: Generating throttle key for user: ".$request->email);
        return strtolower($request->input('email')).'|'.$request->ip();
    }
}
