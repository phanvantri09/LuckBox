<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\BillRepositoryInterface;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // protected $userRepository;
    // protected $boxEventRepository;
    protected $boxItemRepository;
    // protected $boxProductRepository;
    protected $boxRepository;
    protected $cartRepository;
    protected $billRepository;

    public function __construct(BillRepositoryInterface $billRepository , CartRepositoryInterface $cartRepository, BoxItemRepositoryInterface $boxItemRepository, BoxRepositoryInterface $boxRepository)
    {
        // $this->userRepository = $userRepository;
        // $this->boxEventRepository = $boxEventRepository;
        $this->boxRepository = $boxRepository;
        $this->boxItemRepository = $boxItemRepository;
        // $this->boxProductRepository = $boxProductRepository;
        $this->cartRepository = $cartRepository;
        $this->billRepository = $billRepository;
    }
    public function addToCart(Request $request){
        $user = Auth::user();

        $request->merge(['status' => 1, 'id_user_create' => $user->id, 'id_admin_update'=> $user->id]);
        // get box - item  để kiểm tra số lượng
        if ($this->cartRepository->findAndUpdate($request->all())) {
            return redirect()->back()->with('success', "Thêm vào giỏ thành công");
        }
        $boxItem = $this->boxItemRepository->show($request->id_box_item);
        //check còn đủ 19 thì add, ngược lại thì thông báo là k thể đặt nhiều hơn
        $numberAmountOke = $boxItem->amount - $this->cartRepository->getSumAllByStatusNoCheckout();
        if ( $numberAmountOke > $request->amount) {
            // oke
            $this->cartRepository->create($request->all());
            return redirect()->back()->with('success', "Thêm vào giỏ thành công");
        } else {
            //no oke
            return redirect()->back()->with('error', "Bạn nên đặt ít hơn ".$numberAmountOke." họp"  );
        }
    }
    public function cart()
    {
        $user = Auth::user();
        
        $dataCart = $this->cartRepository->getAllDataByIDUserAndStatus($user->id, 1);
        return view('user.page.cart', compact(['dataCart']));

    }
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->UserInfo()->first();

        if ($request->has('id_cart')) {
            $dataCart = $this->cartRepository->getAllDataByIDCartIDUserAndStatus($user->id, $request->id_cart, 1);
        } else {
            $dataCart = $this->cartRepository->getAllDataByIDUserAndStatus($user->id, 1);
        }
        if (empty($dataCart)) {
            return redirect()->route('home')->with('info', 'Hiện tại chưa có đơn hàng nào để thanh toán');
        }
        // dd( $dataCart);
        return view('user.page.checkout', compact(['dataCart', 'userInfo']));
        
    }
    public function checkoutPost(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $request->merge(['id_user_create' => $user->id, 'id_admin_update' => $user->id, $user->id, 'id_transaction' => 1, $user->id, 'id_admin_update' => $user->id,]);
        DB::beginTransaction();
        try {
            $bill = $this->billRepository->create($request->all());
            DB::commit();
        } catch (\Exception $e){
            report($e);
            $this->info("Error!: ".$e->getMessage());
            DB::rollBack();
        }
    }

}
