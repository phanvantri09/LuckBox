<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\BoxItemRepositoryInterface;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    // protected $userRepository;
    // protected $boxEventRepository;
    protected $boxItemRepository;
    // protected $boxProductRepository;
    // protected $boxRepository;
    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository, BoxItemRepositoryInterface $boxItemRepository)
    {
        // $this->userRepository = $userRepository;
        // $this->boxEventRepository = $boxEventRepository;
        // $this->boxRepository = $boxRepository;
        $this->boxItemRepository = $boxItemRepository;
        // $this->boxProductRepository = $boxProductRepository;
        $this->cartRepository = $cartRepository;
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
}
