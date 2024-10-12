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
        Log::info('AppServiceProvider: Register method called.');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Log::info('AppServiceProvider: Boot method called.');
        
        RateLimiter::for('login', function (Request $request) {
            $key = strtolower($request->input('email')).'|'.$request->ip();
            Log::info('AppServiceProvider: Checking rate limiter for key: '.$key);

            if (RateLimiter::tooManyAttempts($key, 2)) {
                $seconds = RateLimiter::availableIn($key);
                Log::info('AppServiceProvider: User '.$key.' is blocked for '.$seconds.' seconds.');

                return Limit::none()->response(function () use ($seconds) {
                    return response()->json([
                        'message' => __('auth.throttle', ['seconds' => $seconds]),
                    ], 429);
                });
            }

            Log::info('AppServiceProvider: Incrementing login attempts for key: '.$key);
            return Limit::perMinute(5);
        });
    }
}
