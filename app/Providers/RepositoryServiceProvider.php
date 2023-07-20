<?php
namespace App\Providers;

use App\Repositories\BoxProductRepository;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepository;
use App\Repositories\BoxRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\BoxEventRepository;
use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxItemRepository;
use App\Repositories\BoxItemRepositoryInterface;
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
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(BoxRepositoryInterface::class, BoxRepository::class);
        $this->app->bind(BoxProductRepositoryInterface::class, BoxProductRepository::class);
        $this->app->bind(BoxEventRepositoryInterface::class, BoxEventRepository::class);
        $this->app->bind(BoxItemRepositoryInterface::class, BoxItemRepository::class);
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
