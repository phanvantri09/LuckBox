<?php

namespace App\Http\Controllers;

use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;

use App\Repositories\TransactionRepositoryInterface;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\CardRepositoryInterface;
use App\Repositories\InfoUserBillRepositoryInterface;
use App\Repositories\BillRepositoryInterface;
use Illuminate\Http\Request;
use App\Helpers\ConstCommon;

use App\Http\Requests\Card\CreateRequestCard;
use App\Http\Requests\TransactionRequest;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Http\Requests\InfoUserBill;
class PageController extends Controller
{
    protected $pageRepository;
    protected $boxRepository;
    protected $boxProductRepository;
    protected $boxEventRepository;
    protected $imageRepository;
    protected $transactionRepository;
    protected $cartRepository;
    protected $cardRepository;
    protected $infoUserBillRepository;
    protected $billRepository;
    public function __construct(BillRepositoryInterface $billRepository,CardRepositoryInterface $cardRepository, CartRepositoryInterface $cartRepository, PageRepositoryInterface $pageRepository, BoxRepositoryInterface $boxRepository, BoxProductRepositoryInterface $boxProductRepository, BoxEventRepositoryInterface $boxEventRepository,
    ImageRepositoryInterface $imageRepository, TransactionRepositoryInterface $transactionRepository, ProductRepositoryInterface $productRepository,
    InfoUserBillRepositoryInterface $infoUserBillRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->productRepository = $productRepository;
        $this->boxRepository = $boxRepository;
        $this->boxProductRepository = $boxProductRepository;
        $this->boxEventRepository = $boxEventRepository;
        $this->imageRepository = $imageRepository;
        $this->transactionRepository = $transactionRepository;
        $this->cartRepository = $cartRepository;
        $this->cardRepository = $cardRepository;
        $this->infoUserBillRepository = $infoUserBillRepository;
        $this->billRepository = $billRepository;
    }

    public function boxInfo($id)
    {
        $data = $this->boxRepository->show($id);
        $product = $this->boxProductRepository->getAllProduct($id);
        $getAllByIDProductMain = $this->imageRepository;
        return view('user.page.box.info', compact('data', 'product', 'getAllByIDProductMain'));
    }
    public function boxList($id)
    {
        $getEvent = $this->boxEventRepository->listBox($id)->boxItem;
        return view('user.page.box.list', compact('getEvent'));
    }
    public function treeData()
    {
        return view('user.page.box.treedata');
    }

    public function chekout()
    {

        return view('user.page.checkout');
    }
    public function purchaseOrder()
    {
        return view('user.page.box.purchaseOrder');
    }
    public function resell()
    {
        return view('user.page.resell');
    }
    public function Marketnew()
    {
        return view('user.page.market_new');
    }
    public function Contact()
    {
        return view('user.page.contact');
    }
    public function market(Request $request)
    {
        $user = Auth::user();
        $inforUserBills = '';
        if ($user) {
            $inforUserBills = $this->infoUserBillRepository->getByIdUser($user->id);
            if (count($inforUserBills) <= 0) {
                return redirect()->route('infoUserBill')->with('info', 'Chưa có thông tin nhận hàng vui lòng thêm ở đây !');
            }
        }
        if ($request->has('type')) {
            $dataCarts = $this->cartRepository->getAllByStatusmartket($request->type);
        } else {
            $dataCarts = $this->cartRepository->getAllByStatusmartket();
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDateTime = Carbon::now();
        $currentDateTime3 = Carbon::now();
        $currentDateTime2 = Carbon::now();
        $threeDaysAgo = $currentDateTime2->subDays(3);
        $sevenDaysAgo = $currentDateTime3->subDays(7);
        return view('user.page.market', compact(['dataCarts','currentDateTime','threeDaysAgo', 'sevenDaysAgo','inforUserBills']));
    }
    public function infoCardPay()
    {
        $currentUser =  Auth::user();
        $getCardDefault = $this->pageRepository->showCardDefault($currentUser->id);
        $getCardAdmin = $this->cardRepository->choese();
        // dd($getCardAdmin);
        if (empty($getCardDefault)) {
            return redirect()->route('createCard')->with('error','Bạn cần có 1 tài khoản mặt định');
        }
        return view('user.page.infoCardPay', compact(['getCardAdmin', 'getCardDefault', 'currentUser']));
    }
    public function infoCardPayPost(TransactionRequest $request)
    {
        $currentUser =  Auth::user();
        $request->merge([
            'id_user' => $currentUser->id,
            'type' => 2,
        ]);
        $data = $request->all();
        $this->transactionRepository->create($data);
        return redirect()->route('walet')->with('message','Gửi yêu cầu thành công');
    }
    public function createCard()
    {
        $dataBank = ConstCommon::BankVN;
        return view('user.page.createCard', compact(['dataBank']));
    }
    public function createCardPost(CreateRequestCard $request)
    {

        $currentUser = Auth::user();
        $request->merge([
            'id_user' => $currentUser->id,
            'id_user_create' => $currentUser->id,
            'id_user_update' => $currentUser->id,
            'type' => $currentUser->type,
        ]);
        $data = $request->all();

        $this->pageRepository->createCard($data);
        return redirect()->route('walet')->with('message', 'Thêm thành công');
    }
    public function walet()
    {
        $currentUser = Auth::user();
        $checkCard = $this->pageRepository->checkCard($currentUser->id);
        if (empty($checkCard)) {
            return redirect()->route('createCard');
        };

        $showCardDefault = $this->pageRepository->showCardDefault($currentUser->id); //lấy card ưu tiên
        $getAllCard = $this->pageRepository->getAllCardNotIn([$showCardDefault->id], $currentUser->id); //lấy ra tất cả card của khác user này


        return view('user.page.walet', compact('showCardDefault', 'currentUser', 'getAllCard'));

    }
    public function changeStatus($id)
    {
        $currentUser = Auth::user();
        $idCard  = $id;
        $this->pageRepository->changeStatus($currentUser->id, $idCard);
        return back()->with('message', ' Thành Công');
    }
    public function cashOut()
    {
        $currentUser =  Auth::user();
        $getCardDefault = $this->pageRepository->showCardDefault($currentUser->id);

        return view('user.page.cashOut', compact('getCardDefault'));
    }
    public function cashOutPost(Request $request)
    {
        $currentUser =  Auth::user();
        if($request->total > $currentUser->balance ){
            return back()->with('error', 'Số dư ví không đủ để rút.');
        }
        $request->merge([
            'id_user' => $currentUser->id,
            'type' => 1,
        ]);
        $data = $request->all();
        $this->transactionRepository->create($data);
        return redirect()->route('walet')->with('message','Gửi yêu cầu thành công');
    }
    public function historyTransaction()
    {
        $user = Auth::user();
        $datas = $this->transactionRepository->listForUser($user->id);
        return view('user.page.historyTransaction', compact(['datas']));
    }
    public function productDetails($id)
    {
        $data = $this->productRepository->show($id);
        $getAllByIDProductMain = $this->imageRepository->getAllByIDProductMain($id);
        $getAllByIDProductSlide = $this->imageRepository->getAllByIDProductSlide($id);
        $getAllByIDProductItem = $this->imageRepository->getAllByIDProductItem($id);
        return view('user.page.productDetails', compact('data', 'getAllByIDProductMain', 'getAllByIDProductSlide', 'getAllByIDProductItem'));
    }
    public function statusOrder()
    {
        return view('user.page.statusOrder');
    }
    public function openBox($id_cart)
    {
        $user = Auth::user();
        $cart = $this->cartRepository->show($id_cart);
        $allProductItem = $this->boxProductRepository->getAllProductByBox($cart->id_box)->pluck('id_product');
        $allProduct = $this->productRepository->getByArrayID($allProductItem);

        $arrayBoxpPoduct = $this->boxProductRepository->getAllByIdBoxChoese($cart->id_box)->pluck('id_product')->toArray();

        $productChoese = $this->productRepository->show($arrayBoxpPoduct[Array_rand($arrayBoxpPoduct)]);
        $productChoeseImage = $this->imageRepository->getAllByIDProductMain($productChoese->id);
        if ($cart->status == 2 || $cart->status == 11) {
            return view('user.page.box.opennew', compact(['cart', 'allProduct', 'productChoese', 'productChoeseImage']));
        } else {
            return redirect()->route('home')->with('error',"Hộp này không thể mở");
        }
    }
    public function openBoxPost($id_cart, $id_product){
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $cart = $this->cartRepository->show($id_cart);
            $bill = $this->billRepository->showByIdCart($cart->id);
            if ($cart->status == 2 || $cart->status == 11) {

                if ($cart->amount > 1 ) {
                    // nếu nhỏ hơn thì tạo cart mới để giao hàng vì mỗi lần chỉ mở 1 Hộp
                    $data = [
                        'id_user_create' => $user->id,
                        'id_admin_update' => null,
                        'id_box_event' => $cart->id_box_event ,
                        'id_folow' => $cart->id_folow , // sau khi checkout mới cập nhật cái này
                        'id_cart_old' => $cart->id ,
                        'id_box' => $cart->id_box,
                        'id_box_item' => $cart->id_box_item ,
                        'status' => 3 ,
                        'amount' => 1,
                        'price_cart' => $cart->price_cart ,
                        'order_number' => $cart->order_number,
                        'id_product_choese' => $id_product,
                    ];

                    $cartNew = $this->cartRepository->create($data);

                    $dataBill = [
                        'id_info_user_bill'=> $bill->id_info_user_bill,
                        'id_user_create' => $user->id,
                        'id_admin_update' => null,
                        'id_cart' => $cartNew->id,
                        'id_transaction' => $bill->id_transaction,
                        'id_box_event' => $cart->id_box_event ,
                        'id_box' => $cart->id_box,
                        'id_box_item' => $cart->id_box_item ,
                        'status' => 3,
                        'amount' => 1,
                        'price_cart' => $cart->price_cart ,
                        'total' => $cart->price_cart,
                    ];
                    $billNew = $this->billRepository->create($dataBill);
                    $id_cart = $cartNew->id;
                    $this->cartRepository->update(['amount'=> $cart->amount - 1], $cart->id);
                    $this->billRepository->update(['amount' => $bill->amount - 1, 'total' => $cart->price_cart * ($bill->amount - 1)], $bill->id);
                } else {
                    // nếu = 1 thì chuyển trạng thái thôi
                    $this->cartRepository->update(['status'=> 3, 'id_product_choese' => $id_product], $cart->id);
                    $this->billRepository->update(['status'=> 3, 'amount' => 1, 'total' => $cart->price_cart * $cart->amount], $bill->id);
                }
            } else {
                return response()->json([
                            'success' => false,
                            'message' => 'CSRF token mismatch. Please refresh the page and try again.'
                        ], 400);
            }
            DB::commit();
        } catch (\Exception $e){
            report($e);
            DB::rollBack();
            // dd($e);
            return response()->json([
                        'success' => false,
                        'message' => 'CSRF token mismatch. Please refresh the page and try again.'
                    ], 400);
        }
        // Chuyển trạng thái xác nhận đơn hàng là đã mở Hộp
        return response()->json(['success' => true, 'routeShowOrder' => route('showOrder', ['id_cart'=>$id_cart])], 200);
    }
    public function infoUserBill(){
        $user = Auth::user();
        return view('user.page.infoUserBill', compact(['user']));
    }

    public function infoUserBillPost(InfoUserBill $request){
        $user = Auth::user();
        $this->infoUserBillRepository->updateByIdUser($user->id);
        $request->merge(['id_user' => $user->id, 'status' => 1]);
        if ($this->infoUserBillRepository->create($request->all())) {
            return redirect()->route('cart')->with('success', 'Thêm thông tin thành công');
        } else {
            return back()->with('error', 'Đã xảy ra lỗi vui lòng thử lại');
        }
    }

    public function infoUserBillUpdate(Request $request){
        $user = Auth::user();
        $this->infoUserBillRepository->updateByIdUser($user->id);
        if ($this->infoUserBillRepository->update(['status' => 1], $request->id)) {
            return response()->json([
                'success' => true,
                'message' => 'CSRF token mismatch. Please refresh the page and try again.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'CSRF token mismatch. Please refresh the page and try again.'
            ], 400);
        }
    }
}
