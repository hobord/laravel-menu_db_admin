<?php

namespace Hobord\MenuDbAdmin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class MenuDbAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Http\Kernel $kernel)
    {
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/hobord/menu_db_admin'),
        ], 'resources');

        $this->setupRoutes($this->app->router);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Hobord\MenuDbAdmin\Http\Controllers'], function($router) {

            $router->group([
                'middleware' => 'web',
            ], function ($router) {
                include __DIR__ . '/routes/web.php';
            });

            $router->group([
                'middleware' => 'web',
            ], function ($router) {
                include __DIR__.'/routes/api.php';
            });

        });
    }
}