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
        $time = $currentTime->format('m/d/Y H:i:s');
        // 07/20/2023 22:34:15
        // $time = '07/25/2023 14:11:50';
        // $time = '2023-07-20 14:11:50';
        // dd($time)  ;
        // $event = $this->boxEventRepository->getInTime($currentTime->format('Y-m-d H:i:s'));
        
        // kiểm tra và đổi trạng thái

        $this->boxEventRepository->changeStatusUpMaket($time);
        $this->boxEventRepository->changeStatusExpried($time);

        $event = $this->boxEventRepository->getInTime($time);
        
        $typeEvent = 1; // 1 là trong thời gian, 2 là trước khi event bắt đầu
        $typeItemBox = 1;

        if (empty($event)) {
            // nếu rỗng láy event gần nhất và láy time của box_item time_start gần nhất
            // check trước khi chyển qua event mới thì chuyển trạng thái cho các event đã hết thời gian
            $event = $this->boxEventRepository->getInTimeThan($time);
            $cacheBoxItem = $this->boxItemRepository->getByIDBoxEventTimeThan($event, $time);
            $typeItemBox = 2;
            $typeEvent = 2;
            // dd(1, $event);
        } else {
            // kiểm tra và chuyển status box
            // nếu nằm trong tg này thì chuyển trạng thài về 2 và đưa lên bán
            $this->boxItemRepository->checkItemBoxUpMaket($event, $time);
            // nếu qua thòi gian thì chuyển thành 3
            // sau khi load 2 cái trên thì còn case check status 2 nếu kho có 2 thì get 1
            $this->boxItemRepository->checkItemBoxExpired($event, $time);
            // láy item trong thời gian đó
            // case 1 status = 2 và trong tg bán
            // case 2  if case 1 k có thì get status = 1 và time_start nhỏ nhất
            $cacheBoxItem = $this->boxItemRepository->getByIDBoxEvent($event);

            $cachebox = empty($cacheBoxItem) ? null :  $cacheBoxItem->box()->first();

            $cacheProduct = empty($cachebox) ? null : $cachebox->boxProducts()->get();
            
        }
        
        // dd(2, empty($event));
        
        
        
        return view('user.page.home', compact(['event','cacheBoxItem', 'cachebox', 'cacheProduct','time']));
    }

    public function chatbox()
    {
        return view('user.layout.chatbox', compact([]));
    }
}
