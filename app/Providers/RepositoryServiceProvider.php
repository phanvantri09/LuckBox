<?php
namespace App\Providers;

use App\Repositories\BoxProductRepository;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepository;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\CardRepository;
use App\Repositories\CardRepositoryInterface;
use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\BoxEventRepository;
use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxItemRepository;
use App\Repositories\BoxItemRepositoryInterface;


use App\Repositories\TransactionRepository;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\FolowRepository;
use App\Repositories\FolowRepositoryInterface;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\CartRepository;

use App\Repositories\BillRepository;
use App\Repositories\BillRepositoryInterface;

use App\Repositories\InfoUserBillRepository;
use App\Repositories\InfoUserBillRepositoryInterface;

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
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(BoxRepositoryInterface::class, BoxRepository::class);
        $this->app->bind(BoxProductRepositoryInterface::class, BoxProductRepository::class);
        $this->app->bind(BoxEventRepositoryInterface::class, BoxEventRepository::class);

        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(BoxItemRepositoryInterface::class, BoxItemRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);

        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(FolowRepositoryInterface::class, FolowRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(InfoUserBillRepositoryInterface::class, InfoUserBillRepository::class);
        $this->app->bind(BillRepositoryInterface::class, BillRepository::class);

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
