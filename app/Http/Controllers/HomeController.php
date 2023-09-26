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
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
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
    protected $imageRepository;
    protected $cartRepository;

    public function __construct(UserRepositoryInterface $userRepository,
    BoxEventRepositoryInterface $boxEventRepository,
    BoxRepositoryInterface $boxRepository,
    BoxItemRepositoryInterface $boxItemRepository,
    BoxProductRepositoryInterface $boxProductRepository,
    ProductRepositoryInterface $productRepository,
    ImageRepositoryInterface $imageRepository,
    CartRepositoryInterface $cartRepository
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $dataToEncode = [
                $userId
            ];

            $hashids = new Hashids('share');
            $encodedData = $hashids->encode($dataToEncode);
            $sharedLink =  url('shared/'.$encodedData);
        } else {
            $sharedLink = '';
        }
        $boxItem = $event = $cacheBoxItem = $cachebox = $cacheProduct = $products = $imageSlide = $boxItem = null;
        $countSale = 0;
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        $timeEventInCase = $timeEventNotInCase = $timeEventStart = $timeEventEnd = null;
        // $time = $currentTime->format('m/d/Y H:i:s');
        // $event = $this->boxEventRepository->getInTime($currentTime->format('Y-m-d H:i:s'));

        // kiểm tra và đổi trạng thái
        $time = $currentTime->format('Y-m-d H:i:s');
        $this->boxEventRepository->checkAndAutoUpdateStatus($time);
        // láy statyus 2 thời điểm hiện tại
        $eventStatus = $this->boxEventRepository->statusNow();
        if (!empty($eventStatus)) {
            $event = $eventStatus;
        } else {
            $event = $this->boxEventRepository->getInTime($time);
        }

        if (empty($event)) {

            // nếu rỗng láy event gần nhất và láy time của box_item time_start gần nhất
            // check trước khi chyển qua event mới thì chuyển trạng thái cho các event đã hết thời gian
            $event = $this->boxEventRepository->getInTimeThan($time);
            // kiểm tra ở cả 2 trường hợp đều k có
            if (empty($event)) {
                return view('user.page.home', compact(['event','cacheBoxItem', 'cachebox',
                                               'cacheProduct','time','timeEventInCase',
                                               'timeEventNotInCase','products','imageSlide',
                                               'boxItem', 'sharedLink', 'countSale', 
                                               'timeEventStart', 'timeEventEnd']));
            }

            $timeEventStart = Carbon::parse($event->time_start)->format('m/d/Y H:i:s');

            $cacheBoxItem = $this->boxItemRepository->getFirstInCaseEventEmpty($event->id);
            $cachebox = empty($cacheBoxItem) ? null :  $cacheBoxItem->box()->first();
            $cacheProduct = empty($cachebox) ? null : $cachebox->boxProducts()->get();

            if (!empty($cacheBoxItem)) {
                $timeEventNotInCase = Carbon::parse($cacheBoxItem->time_start)->format('m/d/Y H:i:s');
            } else {
                $timeEventNotInCase = 1000;
            }
            if (empty($cacheProduct)) {

                $products = null;
                $imageSlide = null;
            } else {
                $products = $this->productRepository->getByArrayID($cacheProduct->pluck('id_product')->toArray());
                $imageSlide = $this->productRepository->getImageSlide($products->pluck('id')->toArray())->pluck('link_image');
            }
            $countSale = empty($cacheBoxItem) ? 0 : $this->cartRepository->getamountboxItemcartDone($event->id, $cacheBoxItem->id);

            if (empty($event)) {
                return view('user.page.home', compact(['event','cacheBoxItem', 'cachebox',
                                               'cacheProduct','time','timeEventInCase',
                                               'timeEventNotInCase','products','imageSlide',
                                               'boxItem', 'sharedLink', 'countSale', 
                                               'timeEventStart', 'timeEventEnd']));
            }

        } else {
            $timeEventEnd = Carbon::parse($event->time_end)->format('m/d/Y H:i:s');
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
                if (empty($cacheBoxItem)) {
                    $timeEventNotInCase = 1000;
                } else {
                    $timeEventNotInCase = Carbon::parse($cacheBoxItem->time_start)->format('m/d/Y H:i:s');
                }
            } else {
                $timeEventInCase = Carbon::parse($cacheBoxItem->time_end)->format('m/d/Y H:i:s');
            }
            $cachebox = empty($cacheBoxItem) ? null :  $cacheBoxItem->box()->first();
            // CACHE boxx product
            $cacheProduct = empty($cachebox) ? null : $cachebox->boxProducts()->get();
            if (empty($cacheProduct)) {

                $products = null;
                $imageSlide = null;
            } else {
                $products = $this->productRepository->getByArrayID($cacheProduct->pluck('id_product')->toArray());
                $imageSlide = $this->productRepository->getImageSlide($products->pluck('id')->toArray())->pluck('link_image');
            }
            $countSale = empty($cacheBoxItem) ? 0 : $this->cartRepository->getamountboxItemcartDone($event->id, $cacheBoxItem->id);
        }

        return view('user.page.home', compact(['event','cacheBoxItem', 'cachebox',
                                               'cacheProduct','time','timeEventInCase',
                                               'timeEventNotInCase','products','imageSlide',
                                               'boxItem', 'sharedLink', 'countSale',
                                               'timeEventStart', 'timeEventEnd']));
    }

    public function chatbox()
    {
        return view('user.layout.chatbox', compact([]));
    }
}
