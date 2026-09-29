<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator; // 1. Tume-import Paginator kwa ajili ya Pagination

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
        // Kulazimisha matumizi ya HTTPS ikiwa website iko live (production)
        // Hii ni muhimu sana kwenye InfinityFree ili assets (CSS/JS) zisigome kupakia
        if (config('app.env') === 'production' || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // 2. Lazimisha Laravel itumie muonekano wa Bootstrap 5 kwenye Pagination links
        Paginator::useBootstrapFive();
    }
}