<?php

namespace QuadStudio\Online;

use Illuminate\Support\ServiceProvider;

class OnlineServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->loadConfig()->registerMiddleware();
    }


    private function registerMiddleware()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('online', OnlineMiddleware::class);

        return $this;
    }

    /**
     * @param $path
     * @return string
     */
    private function packagePath($path)
    {
        return __DIR__ . "/../{$path}";
    }

    /**
     * @return $this
     */
    private function loadConfig()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/online.php'), 'online'
        );

        return $this;
    }

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishConfig();
    }

    /**
     * Publish Portal config
     *
     * @return $this
     */
    private function publishConfig()
    {
        $this->publishes([
            $this->packagePath('config/online.php') => config_path('online.php'),
        ], 'config');

        return $this;
    }

}