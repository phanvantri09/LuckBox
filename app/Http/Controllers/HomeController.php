<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        $events = $this->boxEventRepository->getInTime($currentTime->format('Y-m-d H:i:s'));
        $boxItem = [];
        foreach ($events as $key => $event) {
            // láy item trong thời gian đó
            $cacheBoxItem = $this->boxItemRepository->getByIDBoxEvent($event->id);
            $boxItem[$event->id] =  [$cacheBoxItem, empty($cacheBoxItem) ? null : $cacheBoxItem->box()];
        }

        $userId = Auth::user()->id;
        $dataToEncode = [
            $userId
        ];

        $hashids = new Hashids('share');
        $encodedData = $hashids->encode($dataToEncode);
        $sharedLink =  url('shared/'.$encodedData);

        return view('user.page.home', compact(['boxItem', 'sharedLink']));
    }

    public function chatbox()
    {
        return view('user.layout.chatbox', compact([]));
    }
}
