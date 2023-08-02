<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class AdminController extends Controller
{
    //
    protected $userRepository;
    protected $boxEventRepository;
    protected $boxItemRepository;
    protected $boxProductRepository;
    protected $boxRepository;
    protected $productRepository;
    protected $imageRepository;
    protected $cartRepository;
    protected $transactionRepository;

    public function __construct(UserRepositoryInterface $userRepository,
    BoxEventRepositoryInterface $boxEventRepository,
    BoxRepositoryInterface $boxRepository,
    BoxItemRepositoryInterface $boxItemRepository,
    BoxProductRepositoryInterface $boxProductRepository,
    ProductRepositoryInterface $productRepository,
    ImageRepositoryInterface $imageRepository,
    CartRepositoryInterface $cartRepository,
    TransactionRepositoryInterface $transactionRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->boxEventRepository = $boxEventRepository;
        $this->boxRepository = $boxRepository;
        $this->boxItemRepository = $boxItemRepository;
        $this->boxProductRepository = $boxProductRepository;
        $this->productRepository = $productRepository;
        $this->imageRepository = $imageRepository;
        $this->cartRepository = $cartRepository;
        $this->transactionRepository = $transactionRepository;
    }
    public function index()
    {
        $userRepository = $this->userRepository->all()->count();
        $boxEventRepository = $this->boxEventRepository->all()->count();
        $boxRepository = $this->boxRepository->all()->count();
        $productRepository = $this->productRepository->all()->count();
        $cartRepository = $this->cartRepository->all()->count();
        $transactionRepository = $this->transactionRepository->all()->count();
        // $userRepository = $this->userRepository->all()->count();
        // $userRepository = $this->userRepository->all()->count();
        // $userRepository = $this->userRepository->all()->count();
        return view('admin.dasboard', compact(['userRepository', 'boxEventRepository', 'boxRepository', 'productRepository', 'cartRepository', 'transactionRepository']));
    }
    public function docs()
    {
        return view('admin.docs');
    }

}
