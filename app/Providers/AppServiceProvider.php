<?php

namespace App\Providers;

use App\Repositories\BikeRepositoryGateway;
use App\Repositories\BikeRepositoryInterface;
use App\Repositories\CacheRepository;
use App\Repositories\CacheRepositoryInterface;
use App\Repositories\ItemRepository;
use App\Repositories\ItemRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BikeRepositoryInterface::class, BikeRepositoryGateway::class);
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->bind(CacheRepositoryInterface::class, CacheRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
