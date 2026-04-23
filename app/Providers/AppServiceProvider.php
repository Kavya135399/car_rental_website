<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
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
        $appUrl = (string) env('APP_URL', '');

        if (
            Str::startsWith($appUrl, 'https://')
            || env('FORCE_HTTPS')
        ) {
            URL::forceScheme('https');
        }
    }
}
