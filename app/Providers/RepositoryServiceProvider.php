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
