<?php

namespace App\Providers;

use App\Services\QiitaApiService;
use App\Services\QiitaApiServiceInterface;
use App\Services\QiitaService;
use App\Services\QiitaServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            QiitaServiceInterface::class,
            QiitaService::class
        );
        $this->app->bind(
            QiitaApiServiceInterface::class,
            QiitaApiService::class
        );
    }
}
