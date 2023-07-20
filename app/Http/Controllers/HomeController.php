<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

use Carbon\Carbon;

class HomeController extends Controller
{
    //
    protected $userRepository;
    protected $boxEventRepository;
    protected $boxItemRepository;
    protected $boxProductRepository;
    protected $boxRepository;
    protected $productRepository;

    public function __construct(UserRepositoryInterface $userRepository,
    BoxEventRepositoryInterface $boxEventRepository,
    BoxRepositoryInterface $boxRepository,
    BoxItemRepositoryInterface $boxItemRepository,
    BoxProductRepositoryInterface $boxProductRepository,
    ProductRepositoryInterface $productRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->boxEventRepository = $boxEventRepository;
        $this->boxRepository = $boxRepository;
        $this->boxItemRepository = $boxItemRepository;
        $this->boxProductRepository = $boxProductRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        $events = $this->boxEventRepository->getInTime($currentTime->format('Y/m/d H:i:s'));
        foreach ($events as $key => $event) {
            dd($event->boxItem());
        }
        return view('user.page.home', compact(['events']));
    }

    public function chatbox()
    {

        return view('user.layout.chatbox', compact([]));
    }
}
