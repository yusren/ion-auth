<?php

namespace PtpnId\IonAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class IonAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrapping package (routing, middleware, config publish).
     */
    public function boot()
    {
        // Register route file from the package
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Register middleware alias
        $this->registerMiddleware($this->app->make(Router::class));

        // Allow config to be published to the client app
        $this->publishes([
            __DIR__ . '/../config/ion-auth.php' => config_path('ion-auth.php'),
        ], 'ion-auth-config');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        // Merge default config into Laravel application
        $this->mergeConfigFrom(
            __DIR__ . '/../config/ion-auth.php',
            'ion-auth'
        );
    }

    /**F
     * Register middleware alias to the router.
     */
    protected function registerMiddleware(Router $router)
    {
        // Middleware with dynamic guard & mode support
        $router->aliasMiddleware('ion.auth', \PtpnId\IonAuth\Middleware\IonAuthenticate::class);
    }
}
