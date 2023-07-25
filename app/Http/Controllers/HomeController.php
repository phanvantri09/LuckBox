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
        $timeEventInCase = $timeEventNotInCase = null;
        // $time = $currentTime->format('m/d/Y H:i:s');
        // $event = $this->boxEventRepository->getInTime($currentTime->format('Y-m-d H:i:s'));

        // kiểm tra và đổi trạng thái
        $time = $currentTime->format('Y-m-d H:i:s');
        $this->boxEventRepository->checkAndAutoUpdateStatus($time);

        $event = $this->boxEventRepository->getInTime($time);

        if (empty($event)) {

            // nếu rỗng láy event gần nhất và láy time của box_item time_start gần nhất
            // check trước khi chyển qua event mới thì chuyển trạng thái cho các event đã hết thời gian
            $event = $this->boxEventRepository->getInTimeThan($time);
            // dd($event);
            $cacheBoxItem = $this->boxItemRepository->getFirstInCaseEventEmpty($event->id);
            $cachebox = empty($cacheBoxItem) ? null :  $cacheBoxItem->box()->first();
            $cacheProduct = empty($cachebox) ? null : $cachebox->boxProducts()->get();
            $timeEventNotInCase = Carbon::parse($cacheBoxItem->time_start)->format('m/d/Y H:i:s');

        } else {
            // kiểm tra và chuyển status box
            // nếu nằm trong tg này thì chuyển trạng thài về 2 và đưa lên bán
            $this->boxItemRepository->checkAndAutoUpdateStatus($event->id, $time);
            // nếu qua thòi gian thì chuyển thành 3
            // sau khi load 2 cái trên thì còn case check status 2 nếu kho có 2 thì get 1
            // láy item trong thời gian đó
            // case 1 status = 2 và trong tg bán
            // case 2  if case 1 k có thì get status = 1 và time_start nhỏ nhất
            $cacheBoxItem = $this->boxItemRepository->getByIDBoxEvent($event->id, $time);
            if (empty($cacheBoxItem)) {
                $cacheBoxItem = $this->boxItemRepository->getFirstInCaseEventEmpty($event->id, $time);
                $timeEventNotInCase = Carbon::parse($cacheBoxItem->time_start)->format('m/d/Y H:i:s');
            } else {
                $timeEventInCase = Carbon::parse($cacheBoxItem->time_end)->format('m/d/Y H:i:s');
            }
            $cachebox = empty($cacheBoxItem) ? null :  $cacheBoxItem->box()->first();
            $cacheProduct = empty($cachebox) ? null : $cachebox->boxProducts()->get();
            $products = $this->productRepository->getByArrayID($cacheProduct->pluck('id')->toArray());
        }
        return view('user.page.home', compact(['event','cacheBoxItem', 'cachebox', 'cacheProduct','time','timeEventInCase','timeEventNotInCase','products']));
    }

    public function chatbox()
    {
        return view('user.layout.chatbox', compact([]));
    }
}
