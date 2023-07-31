<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepositoryInterface;
class CartAdminController extends Controller
{
    protected $cartRepository;
    public function __construct(CartRepositoryInterface $cartRepository )
    {
        $this->cartRepository = $cartRepository;
    }
            //  1 vừa thêm vào và chưa thanh toán, 2 đã thanh toán chưa mở họp,
            // 10 đăng bán lại
            // 11 f 30
            // 3 đã mở họp,
            // 4 admin duyệt đơn để giao hàng, 5 đã giao thành công. 6 bị từ chối
    public function index(Request $request){
        if ($request->type == 2) {
            $title = "Đơn chưa mở box";
        }
        if ($request->type == 3) {
            $title = "Đơn đã mở box chờ giao hàng";
        }
        if ($request->type == 4) {
            $title = "Đơn hàng đang giao";
        }
        if ($request->type == 5) {
            $title = "Đơn hàng đã giao thành công";
        }
        
        $data = $this->cartRepository->getAllDataByIDUserAndStatus(null, $request->type);
        return view('admin.cart.list', compact(['title', 'data']));
    }
    public function changeStatus($id_cart, $status){
        if ($this->cartRepository->update(['status' => $status], $id_cart)) {
            return redirect()->back()->with('message',"Thành công");
        } else {
            return redirect()->back()->with('error',"Đã có lỗi xảy ra");
        }
    }
}
