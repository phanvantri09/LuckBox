<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\BillRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\CardRepositoryInterface;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\FolowRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\InfoUserBillRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    protected $boxItemRepository;
    protected $boxRepository;
    protected $cartRepository;
    protected $billRepository;
    protected $transactionRepository;
    protected $cardRepository;
    protected $pageRepository;
    protected $folowRepository;
    protected $userRepository;
    protected $infoUserBillRepository;
    public function __construct(InfoUserBillRepositoryInterface $infoUserBillRepository, UserRepositoryInterface $userRepository, FolowRepositoryInterface $folowRepository, PageRepositoryInterface $pageRepository, CardRepositoryInterface $cardRepository, TransactionRepositoryInterface $transactionRepository, BillRepositoryInterface $billRepository , CartRepositoryInterface $cartRepository, BoxItemRepositoryInterface $boxItemRepository, BoxRepositoryInterface $boxRepository)
    {
        $this->boxRepository = $boxRepository;
        $this->boxItemRepository = $boxItemRepository;
        $this->cartRepository = $cartRepository;
        $this->billRepository = $billRepository;
        $this->transactionRepository = $transactionRepository;
        $this->cardRepository = $cardRepository;
        $this->pageRepository = $pageRepository;
        $this->folowRepository = $folowRepository;
        $this->userRepository = $userRepository;
        $this->infoUserBillRepository = $infoUserBillRepository;
    }
    public function cartUpdateAmount($id_cart, $type){

        $data = $this->cartRepository->show($id_cart);
        $boxItem = $this->boxItemRepository->show($data->id_box_item);

        if ($type == 1) {
            if ($data->amount <= 1) {
                $this->cartRepository->delete($id_cart);
            } else {
                $data->amount = $data->amount - 1;
            }
        } else {
            if ($boxItem->amount < ($data->amount + 1)) {
                return redirect()->back()->with('error', "vượt quá số lượng hiện có");
            }
            $data->amount = $data->amount + 1;
        }
        $data->save();
        return redirect()->back()->with('success', "Thành công");
    }

    public function addToCart(Request $request){
        $user = Auth::user();
        $box = $this->boxRepository->show($request->id_box);
        $request->merge(['status' => 1, 'id_user_create' => $user->id, 'id_admin_update'=> $user->id, 'price_cart'=>$box->price, 'order_number'=>0]);
        // get box - item  để kiểm tra số lượng
        if ($this->cartRepository->findAndUpdate($request->all())) {
            return redirect()->route('cart')->with('success', "Thêm vào giỏ thành công");
        }
        $boxItem = $this->boxItemRepository->show($request->id_box_item);
        //check còn đủ 19 thì add, ngược lại thì thông báo là k thể đặt nhiều hơn
        // $numberAmountOke = $boxItem->amount - $this->cartRepository->getSumAllByStatusNoCheckout();
        // $numberAmountOke = $boxItem->amount - $request->amount;
        if ($boxItem->amount <= 0) {
            return redirect()->back()->with('error', "Hết hàng");
        }
        if ( $boxItem->amount > $request->amount) {
            // oke
            $this->cartRepository->create($request->all());
            return redirect()->route('cart')->with('success', "Thêm vào giỏ thành công");
        } else {
            //no oke
            return redirect()->back()->with('error', "Bạn nên đặt ít hơn ".$request->amount - $boxItem->amount ." Hộp"  );
        }
    }
    public function addToCartOld($id_cart_old){
        $user = Auth::user();
        if ($id_cart_old == null) {
            return redirect()->back()->with('error', "Không thể thực hiện được");
        }

        $data = $this->cartRepository->checkAddToCart($user->id, $id_cart_old);
        if (!empty($data)) {
            if( $this->cartRepository->update(['amount' => $data->amount + 1 ], $data->id) ){
                return redirect()->route('cart')->with('success',"Thêm vào giỏ thành công");
            }
        }
        $cartOld = $this->cartRepository->show($id_cart_old);

        if ($cartOld == null) {
            return redirect()->back()->with('error', "Không thể thực hiện được");
        }
        $data = [
            'id_user_create' => $user->id,
            'id_admin_update' => null,
            'id_box_event' => $cartOld->id_box_event ,
            'id_folow' => $cartOld->id_folow , // sau khi checkout mới cập nhật cái này
            'id_cart_old' => $id_cart_old ,
            'id_box' => $cartOld->id_box,
            'id_box_item' => $cartOld->id_box_item ,
            'status' => 1 ,
            'amount' => 1,
            // 'price_cart' => $cartOld->price_cart ,
            // 'order_number' => $cartOld->order_number,
            'price_cart' => $cartOld->price_cart + ( 6 *($cartOld->price_cart / 100)),
            'order_number' => $cartOld->order_number + 1,
        ];
        $this->cartRepository->create($data);
        return redirect()->route('cart')->with('success',"Thêm vào giỏ thành công");
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
        $dataCart = null;
        $inforUserBills = $this->infoUserBillRepository->getByIdUser($user->id);
        if (count($inforUserBills) <= 0) {
            return redirect()->route('infoUserBill')->with('info', 'Chưa có thông tin nhận hàng vui lòng thêm ở đây !');
        }
        if ($request->has('id_cart')) {
            $dataCart = $this->cartRepository->getAllDataByIDCartIDUserAndStatus( $request->id_cart, $user->id, 1);
        } else {
            $dataCart = $this->cartRepository->getAllDataByIDUserAndStatus($user->id, 1);
        }
        if (empty($dataCart)) {
            return redirect()->route('home')->with('info', 'Hiện tại chưa có đơn hàng nào để thanh toán');
        }
        if ($user->balance < ($dataCart->amount * $dataCart->price)){
            return redirect()->route('infoCardPay')->with('error', 'Số tài khoản trong ví không đủ để thực hiện, vui lòng nạp thêm tiền để thực hiện giao dịch này.');
        }
        $userInfo = $user->UserInfo()->first();

        return view('user.page.checkout', compact(['dataCart', 'userInfo', 'inforUserBills']));

    }
    public function checkoutPost(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();

            // case ở market thanh toán lun
            if($request->has('market_pay')){
                $cartOLD = $this->cartRepository->show($request->id_cart);
                $data = [
                    'id_user_create' => $user->id,
                    'id_admin_update' => null,
                    'id_box_event' => $cartOLD->id_box_event ,
                    'id_folow' => $cartOLD->id_folow , // sau khi checkout mới cập nhật cái này
                    'id_cart_old' => $cartOLD->id ,
                    'id_box' => $cartOLD->id_box,
                    'id_box_item' => $cartOLD->id_box_item ,
                    'status' => 3 ,
                    'amount' => $request->amount,
                    'price_cart' => $cartOLD->price_cart + ( 6 *($cartOLD->price_cart / 100)),
                    'order_number' => $cartOLD->order_number + 1,
                ];
                $cartNew = $this->cartRepository->create($data);
                $cart = $cartNew;
            } else {
                $cart = $this->cartRepository->show($request->id_cart);
            }

            $request->merge([
                'id_user' => $user->id,
                'id_user_create' => $user->id,
                'id_admin_update' => $user->id,
                'status' => 2,
                'id_cart' => $cart->id,
                'amount' => $cart->amount,
                'id_box_item' => $cart->id_box_item,
                'id_box_event' => $cart->id_box_event,
                'id_box' => $cart->id_box,
                'total' => $cart->amount * $cart->price_cart,
                'id_info_user_bill'=> $request->id_info_user_bill
            ]);

            // kiểm tra không đủ tiền thì chuyển qua nạp tiền
            if ($cart->amount * $cart->price_cart > $user->balance) {
                return redirect()->route('infoCardPay')->with('error', 'Số tài khoản trong ví không đủ để thực hiện, vui lòng nạp thêm tiền để thực hiện giao dịch này.');
            }

            $dataTransaction = [
                'id_user' => $user->id,
                'id_admin_accept' => null,
                'type' => 3,
                'total'=> $cart->amount * $cart->price_cart,
                'status'=> 2
                , 'card_name'=> null
                , 'bank'=> null
                , 'card_number'=> null
                , 'transaction_content'=> null,
                'id_cart' => $cart->id
            ];
            $transaction = $this->transactionRepository->create($dataTransaction);
            $this->userRepository->update(['balance' => $user->balance - ($cart->price_cart * $cart->amount)], $user->id);

            $request->merge(['id_transaction' => $transaction->id]);
            $bill = $this->billRepository->create($request->all());

            $this->boxItemRepository->updateAmount($cart->id_box_item, $cart->amount);

            if (!empty($cart->id_cart_old)) {
                // trừ amount cart của cart old
                $cartOld = $this->cartRepository->show($cart->id_cart_old);
                // Trừ số lượng đã đã mua
                $this->cartRepository->update(['amount' => $cartOld->amount - $cart->amount], $cart->id_cart_old);

                // folow
                $folowOld = $this->folowRepository->show($cart->id_folow);
                $dataFolow = [
                    'id_user' => $folowOld->id_user.','.$user->id,
                    'id_box_item' => $cart->id_box_item,
                    'id_box_event' => $cart->id_box_event,
                    'id_box' => $cart->id_box,
                    'id_cart' => $cart->id,
                ];
                // cộng tiền khi user mua hàng từ maket
                // x 1.8 trực tiếp cho người bán , O 0.22 gián tiếp cho tất cả
                $moneyX = ( $cart->price_cart * $cart->amount ) * 1.8 / 100;
                $moneyO = ( $cart->price_cart * $cart->amount ) * 0.22 / 100;
                // cộng tiền cho người bán
                $userPlusMoneyBox = $this->userRepository->find($cartOld->id_user_create);

                // $userPlusMoneyBoxTotal = $userPlusMoneyBox->balance + $moneyX + ConstCommon::priceUp(count(explode(',', $folowOld->id_user)), $request->price);

                $dataTransactionPlusUser = [
                    'id_user' => $cartOld->id_user_create,
                    'id_admin_accept' => null,
                    'type' => 4,
                    'total'=> $cartOld->price_cart * $cart->amount,
                    'status'=> 2
                    , 'card_name'=> null
                    , 'bank'=> null
                    , 'card_number'=> null
                    , 'transaction_content'=> null,
                    'id_cart' => $cart->id
                ];

                $dataTransactionPlusUser2  = [
                    'id_user' => $cartOld->id_user_create,
                    'id_admin_accept' => null,
                    'type' => 5,
                    'total'=> $moneyX * $cart->amount,
                    'status'=> 2
                    , 'card_name'=> null
                    , 'bank'=> null
                    , 'card_number'=> null
                    , 'transaction_content'=> null,
                    'id_cart' =>$cart->id
                ];
                //  tiền mua hàng
                $this->transactionRepository->create($dataTransactionPlusUser);

                $this->transactionRepository->create($dataTransactionPlusUser2);

                $userPlusMoneyBox->balance = $userPlusMoneyBox->balance + (($cartOld->price_cart + $moneyX) * $cart->amount);
                $userPlusMoneyBox->save();
                $arrayFolow = explode(',', $folowOld->id_user);
                $arrayFolowConut = count($arrayFolow);
                foreach (explode(',', $folowOld->id_user) as $key => $id_us) {
                    // kiểm tra khác user bán
                    // if ($id_us != $cartOld->id_user_create) {
                    if ( ( $key+1 ) < ($arrayFolowConut) ) {
                        $userPlusMoney = $this->userRepository->find($id_us);

                        $dataTransactionPlus = [
                            'id_user' => $id_us,
                            'id_admin_accept' => null,
                            'type' => 5,
                            'total'=> $moneyO * $cart->amount,
                            'status'=> 2
                            , 'card_name'=> null
                            , 'bank'=> null
                            , 'card_number'=> null
                            , 'transaction_content'=> null,
                            'id_cart' =>$cart->id
                        ];

                        $this->transactionRepository->create($dataTransactionPlus);
                        $this->userRepository->update(['balance' => $userPlusMoney->balance + ($moneyO * $cart->amount)], $userPlusMoney->id);
                    }
                }

            } else {
                $dataFolow = [
                    'id_user' => $user->id,
                    'id_box_item' => $cart->id_box_item,
                    'id_box_event' => $cart->id_box_event,
                    'id_box' => $cart->id_box,
                    'id_cart' => $cart->id,
                ];
            }
            $folow = $this->folowRepository->create($dataFolow);
            if ($cart->order_number == 29) {
                $this->cartRepository->update(['id_folow' => $folow->id, 'status'=>11] ,$cart->id);
            } else {
                $this->cartRepository->update(['id_folow' => $folow->id, 'status' => 2 ], $cart->id);
            }

            // Tạo giao dịch trừ tiền người mua
            // $dataTransactionTruTienNguoiMua  = [
            //     'id_user' => $user->id,
            //     'id_admin_accept' => null,
            //     'type' => 3,
            //     'total'=> $cart->price_cart * $cart->amount,
            //     'status'=> 2
            //     , 'card_name'=> null
            //     , 'bank'=> null
            //     , 'card_number'=> null
            //     , 'transaction_content'=> null,
            //     'id_cart' =>$request->id_cart
            // ];
            // $this->transactionRepository->create($dataTransactionTruTienNguoiMua);
            // $this->userRepository->update(['balance' => $user->balance - ($cart->price_cart * $cart->amount)], $user->id);
            // $user->balance = $user->balance - ($cart->price_cart * $cart->amount);
            // $user->save();

            // cộng tiền cho người gt tạo tk
            if (!empty($user->id_user_referral)) {
                $userReferral = $this->userRepository->find($user->id_user_referral);
                $moneyUserReferral = $userReferral->balance + (($cart->price_cart * $cart->amount) * 0.2 / 100);
                $dataTransactionPlusUserreferral  = [
                    'id_user' => $user->id_user_referral,
                    'id_admin_accept' => null,
                    'type' => 6,
                    'total'=> ($cart->price_cart * $cart->amount) * 0.2 / 100,
                    'status'=> 2
                    , 'card_name'=> null
                    , 'bank'=> null
                    , 'card_number'=> null
                    , 'transaction_content'=> null,
                    'id_cart' =>$request->id_cart
                ];
                $this->transactionRepository->create($dataTransactionPlusUserreferral);
                $this->userRepository->update(['balance' => $moneyUserReferral], $user->id_user_referral);
            }
            // $infoCard = $this->cardRepository->choese();
            // $getCardDefault = $this->pageRepository->showCardDefault($user->id);
            // $total = $request->total;
            // ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>'mua hàng','status'=> "Thành công", "balance"=>$request->total, 'link'=>route('listOrder')]);
            DB::commit();
            // return view('user.page.infoCardPay', compact(['infoCard','getCardDefault','total']));
        } catch (\Exception $e){
            report($e);
            // dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
        return redirect()->route('purchaseOrder')->with('success', 'Mua hàng thành công');

    }

    public function purchaseOrder(){
        $user = Auth::user();
        $carts = $this->cartRepository->getAllDataByIDUserAndArrayStatus($user->id, [2, 11]);
        // dd($carts);
        return view('user.page.box.purchaseOrder', compact(['carts']));
    }
    public function boxUserMarket(){
        $user = Auth::user();
        $carts = $this->cartRepository->getAllDataByIDUserAndStatusTreeData($user->id, 10);
        return view('user.page.box.purchaseOrder', compact(['carts']));
    }
    public function treeData($id){
        // return back()->with("error", ' Chức năng này chưa được cập nhật!');

        $dataCart = $this->cartRepository->show($id);
        $folows = $this->cartRepository->treedataCart($dataCart->id_user_create, $dataCart->id_box_item, $dataCart->id_box_event, $dataCart->id_box);
        // dựa vào id cart để phân biệt
        // từ last cart láy được idcarr chhuaws numberorder
        // dd($folows->pluck('id_cart')->toArray());
        // dd($folows);
        $arrayCart = $folows->pluck('id_cart')->toArray();
        // dd($arrayCart);
        $transactions = $this->transactionRepository->getByIDCart($arrayCart ,$dataCart->id_user_create);
        // dd($transactions);
        if(empty($folows->last()->id_cart)){
            return redirect()->back()->with('warning','Chưa có giao dịch nào diễn ra ở Hộp gửi bán này');
        }
        $dataCartLast = $this->cartRepository->show($folows->last()->id_cart);
        $number_order = $dataCartLast->order_number;
        $box = $this->boxRepository->show($dataCart->id_box);

        // dd($dataCartLast);
        // dd($dataCart);
        // $this->folowRepository
        return view('user.page.box.treedata', compact(['box', 'number_order', 'dataCart', 'folows', 'transactions']));
    }
    public function sendToMarket($id_cart){
        $dataCart =  $this->cartRepository->showAllData($id_cart);
        return view('user.page.resell', compact(['dataCart']));

    }
    public function sendToMarketPost(Request $request){
        $user = Auth::user();
        $cart = $this->cartRepository->show($request->id_cart);
        if ($cart->amount == $request->amount) {
            $this->cartRepository->changeStatus(10, $request->id_cart);
            return redirect()->route('home')->with('success', 'Đăng bán thành công nhé');
        }
        if ($cart->amount < $request->amount) {
            return redirect()->back()->with('error', "Số lượng yêu cầu lớn hơn số lượng hiện có");
        }
        DB::beginTransaction();
        try {

            $amountUpdate = $cart->amount - $request->amount;
            $this->cartRepository->update(['amount'=>$amountUpdate], $cart->id);

            $data = [
                'id_user_create' => $user->id,
                'id_admin_update' => null,
                'id_box_event' => $cart->id_box_event ,
                'id_folow' => $cart->id_folow , // sau khi checkout mới cập nhật cái này
                'id_cart_old' => $cart->id ,
                'id_box' => $cart->id_box,
                'id_box_item' => $cart->id_box_item ,
                'status' => 10 ,
                'amount' => $request->amount,
                'price_cart' => $cart->price_cart ,
                'order_number' => $cart->order_number,
            ];
            $this->cartRepository->create($data);
            $this->billRepository->updateByIDCart(['amount'=> $amountUpdate, 'total'=> $amountUpdate * $cart->price_cart], $cart->id);
            // $phiguiban = 100000;
            // $user->balance = $user->balance - $phiguiban;
            // $user->save();
            // $transaction = $this->transactionRepository->create([
            //     'id_user' => $user->id,
            //     'id_admin_accept' => null,
            //     'type' => 4,
            //     'total'=> $phiguiban,
            //     'status'=> 2
            //     , 'card_name'=> null
            //     , 'bank'=> null
            //     , 'card_number'=> null
            //     , 'transaction_content'=> null
            //     ]);
            DB::commit();
        } catch (\Exception $e){
            report($e);
            DB::rollBack();
            return redirect()->route('home')->with('error', 'Đã xảy ra lỗi');
        }
        return redirect()->route('home')->with('success', 'Đăng bán thành công');
    }
    public function listOrder(){
        $user = Auth::user();
        $dataCart = $this->cartRepository->getInforOderUser($user->id, [3, 4, 5]);
        return view('user.page.listOrder', compact(['dataCart']));
    }
    public function showOrder($id_cart){
        $user = Auth::user();
        $dataCart = $this->cartRepository->getInforBillOderUser($user->id, $id_cart);
        // dd($dataCart);
        // id_info_user_bill
        // dd($dataCart);
        $inforUserBills = $this->infoUserBillRepository->getByIdUser($user->id);

        return view('user.page.showOrder', compact(['dataCart', 'inforUserBills']));
    }
    public function stopMarket($id_cart){
        if ($this->cartRepository->update(['status' => 2], $id_cart)) {
            // $cart = $this->cartRepository->show($id_cart);
            // $bill = $this->billRepository->showByIdCart($id_cart);
            // $this->billRepository->updateByIDCart(['amount'=>$bill->amount + $cart->amount, 'total'=> ($bill->amount + $cart->amount) * $cart->price_cart], $cart->id);
            return redirect()->route('purchaseOrder')->with('message', "Thành công");
        } else {
            return redirect()->back()->with('error', "Không thành công, vui lòng thử lại.");
        }
    }

    public function stopcart($id_cart){
        if ($this->cartRepository->delete($id_cart)) {
            return redirect()->back()->with('message', "Hủy đơn thành công");
        } else {
            return redirect()->back()->with('error', "Không thành công, vui lòng thử lại.");
        }
    }
    public function changeinfoUserBillUpdate(Request $request){

        if ($this->billRepository->update(['id_info_user_bill' => $request->value], $request->id_bill)) {
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
