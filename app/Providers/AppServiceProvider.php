<?php

namespace App\Providers;

use App\Services\SnsAccountService;
use App\Services\SnsAccountServiceInterface;
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
			SnsAccountServiceInterface::class,
			SnsAccountService::class
		);
    }
}
