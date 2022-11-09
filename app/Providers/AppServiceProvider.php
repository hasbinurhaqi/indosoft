<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RestaurantRepository;
use App\Repositories\RestaurantRepositoryInterface;
use App\Repositories\AuthenticationRepositoryInterface;
use App\Repositories\AuthenticationRepository;
use App\Repositories\VehicleRepositoryInterface;
use App\Repositories\VehicleRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RestaurantRepositoryInterface::class,
            RestaurantRepository::class,
        );

        $this->app->bind(
            AuthenticationRepositoryInterface::class,
            AuthenticationRepository::class
        );

        $this->app->bind(
            VehicleRepositoryInterface::class,
            VehicleRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
