<?php

namespace Shreesthapit\Corewebvitals;

use Illuminate\Support\ServiceProvider;
use Shreesthapit\Corewebvitals\Components\CoreWebComponent;

class CoreWebVitalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->make('Shreesthapit\Corewebvitals\CoreWebVitalController');
        $this->app->make('Shreesthapit\Corewebvitals\CoreWebVitalInsightController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'corewebvitals');
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/corewebvitals'),
        ], 'public');
        $this->loadViewComponentsAs('core-web-vital', [
            CoreWebComponent::class,
        ]);

    }
}
