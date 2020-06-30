<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Services\CustomerServiceInterface::class,
            \App\Services\CustomerService::class
        );
        $this->app->singleton(
            \App\Services\ProductServiceInterface::class,
            \App\Services\ProductService::class
        );
        $this->app->singleton(
            \App\Services\ImportOrderServiceInterface::class,
            \App\Services\ImportOrderService::class
        );
        $this->app->singleton(
            \App\Services\SupplierServiceInterface::class,
            \App\Services\SupplierService::class
        );
        $this->app->singleton(
            \App\Services\BillServiceInterface::class,
            \App\Services\BillService::class
        );
        $this->app->singleton(
            \App\Services\PostServiceInterface::class,
            \App\Services\PostService::class
        );
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
        $this->app->singleton(
            \App\Services\CheckInventoryServiceInterface::class,
            \App\Services\CheckInventoryService::class
        );
        $this->app->singleton(
            \App\Services\UserServiceInterface::class,
            \App\Services\UserService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        App::bind('Helper', function() {
            return new \App\Helper\Helper;
        });
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }
    }
}
