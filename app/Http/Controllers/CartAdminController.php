<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\BillRepositoryInterface;
class CartAdminController extends Controller
{
    protected $cartRepository;
    protected $boxpPoductRepository;
    protected $productRepository;
    protected $billRepository;
    public function __construct(BillRepositoryInterface $billRepository, CartRepositoryInterface $cartRepository, BoxProductRepositoryInterface $boxpPoductRepository, ProductRepositoryInterface $productRepository )
    {
        $this->cartRepository = $cartRepository;
        $this->boxpPoductRepository = $boxpPoductRepository;
        $this->productRepository = $productRepository;
        $this->billRepository = $billRepository;
    }
            //  1 vừa thêm vào và chưa thanh toán, 2 đã thanh toán chưa mở Hộp,
            // 10 đăng bán lại
            // 11 f 30
            // 3 đã mở Hộp,
            // 4 admin duyệt đơn để giao hàng, 5 đã giao thành công. 6 bị từ chối
    public function index(Request $request){
        $title = "Đơn hàng";
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
        if ($request->type == 6) {
            $title = "Đơn đã bị tời chối hoặc phát sinh lỗi";
        }
        $data = $this->cartRepository->getInforOder($request->type);
        if ($request->type == null) {
            $data = $this->cartRepository->all();
        }
        return view('admin.cart.list', compact(['title', 'data']));
    }
    public function changeStatus($id_cart, $status){
        if ($this->cartRepository->update(['status' => $status], $id_cart)) {
            return redirect()->back()->with('message',"Thành công");
        } else {
            return redirect()->back()->with('error',"Đã có lỗi xảy ra");
        }
    }
    public function productOrder($id_cart){
        $cart = $this->cartRepository->show($id_cart);
        $arrayBoxpPoduct = $this->boxpPoductRepository->getAllByIdBoxChoese($cart->id_box)->pluck('id_product')->toArray();
        $products = $this->productRepository->getByArrayID($arrayBoxpPoduct);
        return view('admin.cart.productOrder', compact(['products']));
    }
    public function productChoeseOrder($id_cart){
        $cart = $this->cartRepository->show($id_cart);
        $products = $this->productRepository->showOrder($cart->id_product_choese);
        if (empty($cart->id_cart_old)) {
            $bill = $this->billRepository->showByIdCartInfo($id_cart);
        } else {
            $bill = $this->billRepository->showByIdCartInfo($cart->id_cart_old);
        }
        
        // dd($bill);
        return view('admin.cart.infoOrder', compact(['cart','products', 'bill']));
    }
}
