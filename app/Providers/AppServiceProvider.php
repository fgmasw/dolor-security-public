<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
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

            if (RateLimiter::tooManyAttempts($key, 2)) {
                $seconds = RateLimiter::availableIn($key);

                return Limit::none()->response(function () use ($seconds) {
                    return response()->json([
                        'message' => __('auth.throttle', ['seconds' => $seconds]),
                    ], 429);
                });
            }

            return Limit::perMinute(5);
        });
    }
}
