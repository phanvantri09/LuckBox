<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
// use App\Repositories\ProductRepository;
// use App\Repositories\ProductRepositoryInterface;
// use App\Repositories\ProductRepository;
// use App\Repositories\ProductRepositoryInterface;
// use App\Repositories\ProductRepository;
// use App\Repositories\ProductRepositoryInterface;
// use App\Repositories\ProductRepository;
// use App\Repositories\ProductRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
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