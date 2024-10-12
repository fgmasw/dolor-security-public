<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $key = strtolower($request->input('email')).'|'.$request->ip();

            Log::info('Initializing rate limit for '.$key);

            if (RateLimiter::tooManyAttempts($key, 2)) {
                $seconds = RateLimiter::availableIn($key);
                Log::info('User '.$key.' blocked for '.$seconds.' seconds (should be 10800)');

                return Limit::none()->response(function () use ($seconds) {
                    Log::info('Returning rate limit response, blocking user for '.$seconds.' seconds.');
                    return response()->json([
                        'message' => 'Has superado el límite de 2 intentos fallidos. La cuenta está bloqueada por 10800 segundos.'
                    ], 429);
                })->retryAfter(10800); // Tiempo de bloqueo de 10800 segundos
            }

            Log::info('Incrementing login attempt for '.$key);
            RateLimiter::hit($key, 10800); // Tiempo de bloqueo de 10800 segundos
        });
    }
}
