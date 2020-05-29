<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        App::bind('Helper', function() {
            return new \App\Helper\Helper;
        });
    }
}
