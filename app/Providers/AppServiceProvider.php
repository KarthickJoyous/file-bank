<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Blade;

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
        Password::defaults(function () {
            return Password::min(8)->mixedCase()->rules(['max:25', 'regex:/^[^\s]+$/']);
        });

        Blade::if('authorized', function () {
            
            return (auth('web')->check() && auth('web')->user()->email_status && auth('web')->user()->email_verified_at);
        });
    }
}
