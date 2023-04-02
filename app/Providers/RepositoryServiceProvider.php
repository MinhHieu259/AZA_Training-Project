<?php

namespace App\Providers;

use App\Repository\IDeliveryRepository;
use App\Repository\RepositoryImplement\DeliveryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IDeliveryRepository::class, DeliveryRepository::class);
    }
}
