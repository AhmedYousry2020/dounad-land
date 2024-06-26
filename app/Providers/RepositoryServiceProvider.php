<?php

namespace App\Providers;

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
        $this->app->bind(\App\Interfaces\BaseInterface::class, \App\Repositories\BaseRepository::class);
        $this->app->bind(\App\Interfaces\CategoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Interfaces\ItemInterface::class, \App\Repositories\ItemRepository::class);
        $this->app->bind(\App\Interfaces\CartInterface::class, \App\Repositories\CartRepository::class);
        $this->app->bind(\App\Interfaces\CartItemInterface::class, \App\Repositories\CartItemRepository::class);
        $this->app->bind(\App\Interfaces\BoxInterface::class, \App\Repositories\BoxRepository::class);
        $this->app->bind(\App\Interfaces\OtpInterface::class, \App\Repositories\OtpRepository::class);
        $this->app->bind(\App\Interfaces\WarehouseInterface::class, \App\Repositories\WarehouseRepository::class);
        $this->app->bind(\App\Interfaces\OrderInterface::class, \App\Repositories\OrderRepository::class);
        $this->app->bind(\App\Interfaces\OrderItemInterface::class, \App\Repositories\OrderItemRepository::class);

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
