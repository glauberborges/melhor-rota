<?php

namespace App\Providers;

use App\Services\GeoCoding\GeoCoding;
use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoOne;

class GeoCodingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GeoCoding::class, function ($app) {
            return new GeoCoding();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
