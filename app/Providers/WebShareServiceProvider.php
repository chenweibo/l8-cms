<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WebShareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        view()->composer(
            'templates.*',
            'App\Http\ViewComposers\BaseInfoComposer'
        );
    }
}
