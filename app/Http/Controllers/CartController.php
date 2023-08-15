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

        if ($type == 1) {
            if ($data->amount <= 1) {
                $this->cartRepository->delete($id_cart);
            } else {
                $data->amount = $data->amount - 1;
            }
        } else {
            $data->amount = $data->amount + 1;
        }
        $data->save();
        return redirect()->back()->with('success', "Thành công");
    }

    public function addToCart(Request $request){
        $user = Auth::user();
        // dd($request->all());
        $box = $this->boxRepository->show($request->id_box);
        $request->merge(['status' => 1, 'id_user_create' => $user->id, 'id_admin_update'=> $user->id, 'price_cart'=>$box->price, 'order_number'=>1]);
        // get box - item  để kiểm tra số lượng
        if ($this->cartRepository->findAndUpdate($request->all())) {
            return redirect()->route('cart')->with('success', "Thêm vào giỏ thành công");
        }
        $boxItem = $this->boxItemRepository->show($request->id_box_item);
        //check còn đủ 19 thì add, ngược lại thì thông báo là k thể đặt nhiều hơn
        $numberAmountOke = $boxItem->amount - $this->cartRepository->getSumAllByStatusNoCheckout();
        if ($boxItem->amount <= 0) {
            return redirect()->back()->with('error', "Hết hàng");
        }
        if ( $numberAmountOke > $request->amount) {
            // oke
            $this->cartRepository->create($request->all());
            return redirect()->route('cart')->with('success', "Thêm vào giỏ thành công");
        } else {
            //no oke
            return redirect()->back()->with('error', "Bạn nên đặt ít hơn ".$numberAmountOke." Hộp"  );
        }
    }
    public function addToCartOld($id_cart_old){
        $user = Auth::user();
        if ($id_cart_old == null) {
            return redirect()->back()->with('error', "Không thể thực hiện được");
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
        $user = Auth::user();

        $request->merge([
            'id_user' => $user->id,
            'id_user_create' => $user->id,
            'id_admin_update' => $user->id,
            'status' => 2
        ]);
        DB::beginTransaction();
        try {
            session(['transaction_bill' => $request->all()]);
            $cart = $this->cartRepository->show($request->id_cart);
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
                'id_cart' => $request->id_cart
            ];
            $transaction = $this->transactionRepository->create($dataTransaction);
            $request->merge(['id_transaction' => $transaction->id]);
            $bill = $this->billRepository->create($request->all());

            $this->boxItemRepository->updateAmount($request->id_box_item, $request->amount);

            if (!empty($cart->id_cart_old)) {
                // trừ amount cart của cart old
                $cartOld = $this->cartRepository->show($cart->id_cart_old);
                $cartOld->amount = $cartOld->amount - 1;
                $cartOld->save();
                $folowOld = $this->folowRepository->show($cart->id_folow);
                $dataFolow = [
                    'id_user' => $folowOld->id_user.','.$user->id,
                    'id_box_item' => $request->id_box_item,
                    'id_box_event' => $request->id_box_event,
                    'id_box' => $request->id_box,
                    'id_cart' => $request->id_cart,
                ];
                // cộng tiền khi user mua hàng từ maket
                 // x 1.8 trực tiếp cho người bán , O 0.22 gián tiếp cho tất cả
                $moneyX = ( $cart->price_cart * $request->amount ) * 1.8 / 100;
                $moneyO = ( $cart->price_cart * $request->amount ) * 0.22 / 100;
                // cộng tiền cho người bán
                $userPlusMoneyBox = $this->userRepository->find($cartOld->id_user_create);

                // $userPlusMoneyBoxTotal = $userPlusMoneyBox->balance + $moneyX + ConstCommon::priceUp(count(explode(',', $folowOld->id_user)), $request->price);

                $dataTransactionPlusUser = [
                    'id_user' => $cartOld->id_user_create,
                    'id_admin_accept' => null,
                    'type' => 4,
                    'total'=> $cartOld->price_cart,
                    'status'=> 2
                    , 'card_name'=> null
                    , 'bank'=> null
                    , 'card_number'=> null
                    , 'transaction_content'=> null,
                    'id_cart' => $request->id_cart
                ];

                $dataTransactionPlusUser2  = [
                    'id_user' => $cartOld->id_user_create,
                    'id_admin_accept' => null,
                    'type' => 5,
                    'total'=> $moneyX,
                    'status'=> 2
                    , 'card_name'=> null
                    , 'bank'=> null
                    , 'card_number'=> null
                    , 'transaction_content'=> null,
                    'id_cart' =>$request->id_cart
                ];
                //  tiền mua hàng
                $this->transactionRepository->create($dataTransactionPlusUser);

                $this->transactionRepository->create($dataTransactionPlusUser2);

                $userPlusMoneyBox->balance = $userPlusMoneyBox->balance + $cartOld->price_cart + $moneyX;
                $userPlusMoneyBox->save();

                foreach (explode(',', $folowOld->id_user) as $key => $id_us) {
                    // kiểm tra khác user bán
                    if ($id_us != $cartOld->id_user_create) {
                        $userPlusMoney = $this->userRepository->find($id_us);

                        $dataTransactionPlus = [
                            'id_user' => $id_us,
                            'id_admin_accept' => null,
                            'type' => 5,
                            'total'=> $moneyO,
                            'status'=> 2
                            , 'card_name'=> null
                            , 'bank'=> null
                            , 'card_number'=> null
                            , 'transaction_content'=> null,
                            'id_cart' =>$request->id_cart
                        ];

                        $this->transactionRepository->create($dataTransactionPlus);
                        $userPlusMoney->balance = $userPlusMoney->balance + $moneyO;
                        $userPlusMoney->save();
                    }
                }

            } else {
                $dataFolow = [
                    'id_user' => $user->id,
                    'id_box_item' => $request->id_box_item,
                    'id_box_event' => $request->id_box_event,
                    'id_box' => $request->id_box,
                    'id_cart' => $request->id_cart,
                ];
            }
            $folow = $this->folowRepository->create($dataFolow);
            if ($cart->order_number == 30) {
                $this->cartRepository->update(['id_folow' => $folow->id, 'status'=>11] ,$cart->id);
            } else {
                $this->cartRepository->update(['id_folow' => $folow->id, 'status' => 2 ], $request->id_cart);
            }
            $user->balance = $user->balance - $request->total;
            $user->save();
            if (!empty($user->id_user_referral)) {
                $userReferral = $this->userRepository->find($user->id_user_referral);
                $moneyUserReferral = $userReferral->balance + ($request->total * 0.2 / 100);
                $dataTransactionPlusUserreferral  = [
                    'id_user' => $user->id_user_referral,
                    'id_admin_accept' => null,
                    'type' => 6,
                    'total'=> $request->total * 0.2 / 100,
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
            DB::commit();
        } catch (\Exception $e){
            report($e);
            // dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
        // $infoCard = $this->cardRepository->choese();
        // $getCardDefault = $this->pageRepository->showCardDefault($user->id);
        // $total = $request->total;
        ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>'mua hàng','status'=> "Thành công", "balance"=>$request->total, 'link'=>route('listOrder')]);
        return redirect()->route('purchaseOrder')->with('success', 'Mua hàng thành công');
        // return view('user.page.infoCardPay', compact(['infoCard','getCardDefault','total']));
    }
    public function infoCardPayPost(Request $request){

        //  kiểm tra có id_cart_father mua từ 1 cart khác thì chia thành 2 hướng giải quyết
        $dataSessionBill = session('transaction_bill');
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $transaction = $this->transactionRepository->create([
                'id_user' => $user->id,
                'id_admin_accept' => null,
                'type' => 3,
                'total'=> $dataSessionBill['total'],
                'status'=> 2
                , 'card_name'=> $request->card_name
                , 'bank'=> $request->bank
                , 'card_number'=> $request->card_number
                , 'transaction_content'=> $request->transaction_content
                ]);
            // $transaction = $request->transaction;

            $dataBill = [
                'id_user_create' => $user->id,
                'id_admin_update' => null,
                'id_cart' => $dataSessionBill['id_cart'],
                'id_transaction'=> $transaction->id,
                'id_box_item' => $dataSessionBill['id_box_item'],
                'id_box_event' => $dataSessionBill['id_box_event'],
                'id_box' => $dataSessionBill['id_box'],
                'status' => 2 ,
                'amount' => $dataSessionBill['amount'],
                'total' => $dataSessionBill['total'],
                'name' => $dataSessionBill['name'],
                'number_phone' => $dataSessionBill['number_phone'],
                'address' => $dataSessionBill['address']
            ];
            $bill = $this->billRepository->create($dataBill);
            $this->boxItemRepository->updateAmount($dataSessionBill['id_box_item'], $dataSessionBill['amount']);
            // cập nhật folow ở đây nhá
            $id_user_list = $user->id;
            // dd($id_user_list);
            $dataFolow = [
                'id_user' => $user->id,
                'id_box_item' => $dataSessionBill['id_box_item'],
                'id_box_event' => $dataSessionBill['id_box_event'],
                'id_box' => $dataSessionBill['id_box'],
                'id_cart' => $dataSessionBill['id_cart'],
            ];
            $folow = $this->folowRepository->create($dataFolow);
            $this->cartRepository->update(['folow' => $folow->id, 'status' => 2], $dataSessionBill['id_cart']);
            $user->balance = $user->balance - $dataSessionBill['total'];
            $user->save();
            DB::commit();
        } catch (\Exception $e){
            report($e);
            dd($e);
            DB::rollBack();
            return redirect()->route('home')->with('error', 'Đã xảy ra lỗi');
        }
        session()->forget('transaction_bill');
        return redirect()->route('purchaseOrder')->with('success','Thành công đặt hàng');
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
        return view('user.page.showOrder', compact(['dataCart']));
    }
    public function stopMarket($id_cart){
        if ($this->cartRepository->update(['status' => 2], $id_cart)) {
            return redirect()->route('purchaseOrder')->with('message', "Thành công");
        } else {
            return redirect()->back()->with('error', "Không thành công, vui lòng thử lại.");
        }
    }

}
