<?php

namespace DissanayajeG\pack;

use DissanayajeG\pack\Console\InstallBlogPackage;
use DissanayajeG\pack\Http\Middleware\CapitalizeTitle;
use DissanayajeG\pack\Providers\EventServiceProvider;
use DissanayajeG\pack\View\Components\Alert;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class BlogPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('calculator', function($app) {
            return new Calculator();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'blogpackage');
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(Kernel $kernel)
    {
        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallBlogPackage::class,
            ]);
//            $this->app->booted(function () {
//                $schedule = $this->app->make(Schedule::class);
//                $schedule->command('blogpackage:install')->everyMinute();
//            });

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('blogpackage.php'),
            ], 'config');

            // Export the migration
            if (! class_exists('CreatePostsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_posts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_posts_table.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }

            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/blogpackage'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../src/View/Components/' => app_path('View/Components'),
                __DIR__.'/../resources/views/components/' => resource_path('views/components'),
            ], 'view-components');

            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('blogpackage'),
            ], 'assets');
        }

        $this->registerRoutes();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'blogpackage');
        $this->loadViewComponentsAs('blogpackage', [
            Alert::class,
        ]);

//        $kernel->pushMiddleware(CapitalizeTitle::class);
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('capitalize', CapitalizeTitle::class);
//        $router->pushMiddlewareToGroup('web', CapitalizeTitle::class);

    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('blogpackage.prefix'),
            'middleware' => config('blogpackage.middleware'),
        ];
    }
}