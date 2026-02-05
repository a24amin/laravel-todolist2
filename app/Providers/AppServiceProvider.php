<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // 1. Forzar HTTPS
        URL::forceScheme('https');

        // 2. LA CLAVE: Forzar a usar la dirección del .env, ignorando localhost
        $url = config('app.url');
        if ($url && $url !== 'http://localhost') {
            URL::forceRootUrl($url);
        }
    }
}