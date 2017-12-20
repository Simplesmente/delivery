<?php

namespace Delivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        //
    }
    
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(\Delivery\Repositories\CategoryRepository::class,
        \Delivery\Repositories\CategoryRepositoryEloquent::class);
        
        $this->app->bind(\Delivery\Repositories\ClientRepository::class,
        \Delivery\Repositories\ClientRepositoryEloquent::class);

        $this->app->bind(\Delivery\Repositories\OrderItemRepository::class,
        \Delivery\Repositories\OrderItemRepositoryEloquent::class);

        $this->app->bind(\Delivery\Repositories\OrderRepository::class,
        \Delivery\Repositories\OrderRepositoryEloquent::class);

        $this->app->bind(\Delivery\Repositories\ProductRepository::class,
        \Delivery\Repositories\ProductRepositoryEloquent::class);

        $this->app->bind(\Delivery\Repositories\UserRepository::class,
        \Delivery\Repositories\UserRepositoryEloquent::class);

        $this->app->bind(\Delivery\Repositories\CupomRepository::class,
        \Delivery\Repositories\CupomRepositoryEloquent::class);

    }
}
