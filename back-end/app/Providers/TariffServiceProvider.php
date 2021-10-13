<?php

namespace App\Providers;

use App\Repositories\Tariffrepository;
use App\Repositories\TariffRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TariffServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TariffRepositoryInterface::class,Tariffrepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
