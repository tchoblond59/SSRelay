<?php

namespace Tchoblond59\SSRelay;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SSRelayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/assets/js' => public_path('/js/tchoblond59/ssrelay'),
        ], 'larahome-package');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'ssrelay');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        Event::listen('App\Events\MSMessageEvent', 'Tchoblond59\SSRelay\EventListener\SSRelayEventListener');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
