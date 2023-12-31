<?php
namespace App\Repositories;

use App\Models\Cart;
use App\Models\Folow;
use Illuminate\Support\Facades\DB;
class CartRepository implements CartRepositoryInterface
{
    public function all()
    {
        return Cart::orderByDesc('created_at')->get();
    }
    public function show($id){
          return Cart::lockForUpdate()->find($id);
    }
    public function getAllByStatus($status)
    {
        return Cart::where('status', $status)->get();
    }
    public function getAllByIDUser($id_user)
    {
        return Cart::where('id_user_create', $id_user)->orderByDesc('created_at')->get();
    }
    public function getAllByIDUserAndStatus($id_user, $status)
    {
        return Cart::where('id_user_create', $id_user)->where('status', $status)->get();
    }
    public function create(array $data)
    {
        return Cart::create($data);
    }
    public function changeStatus($status, $id)
    {
        $user = Cart::findOrFail($id);
        $user->status = $status;
        return $user->save();
    }
    public function update(array $data, $id)
    {
        $user = Cart::findOrFail($id);
        return $user->update($data);
    }
    public function delete($id)
    {
          $user = Cart::findOrFail($id);
          $user->delete();
          return true;
    }
    public function getSumAllByStatusNoCheckout(){
        return Cart::whereNotIn('status', [1])->sum('amount');
    }
    public function findAndUpdate(array $data){
        $cart = Cart::where('id_user_create', $data['id_user_create'])
        ->where('status', 1)
        ->where('id_box', $data['id_box'])
        ->where('id_box_item', $data['id_box_item'])
        ->where('id_box_event', $data['id_box_event'])
        ->where('id_cart_old', null)
        ->first();
        if (empty($cart)) {
            return false;
        } else {
            $cart->amount = $cart->amount + $data['amount'];
            $cart->save();
            return true;
        }
    }
    public function findCart(array $data){
        return Cart::where('id_user_create', $data['id_user_create'])
        ->where('status', 1)
        ->where('id_box', $data['id_box'])
        ->where('id_box_item', $data['id_box_item'])
        ->where('id_box_event', $data['id_box_event'])
        ->where('id_cart_old', null)
        ->first();
    }
    public function getAllDataByIDUserAndArrayStatus($id_user, array $status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->where('carts.id_user_create','=', $id_user)
                ->whereIn('status', $status)->orderBy('created_at', 'desc')->get();
    }
    public function getInforOder($status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
                'bills.amount as bills_amount', 'bills.total as bills_total', 'info_user_bills.name', 'info_user_bills.number_phone', 'info_user_bills.address', 'users.email')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
                ->leftJoin('info_user_bills', 'bills.id_info_user_bill', '=', 'info_user_bills.id')
                ->orderBy('carts.created_at', 'desc')
                ->where('carts.status', $status)
                ->where('carts.amount', '>', 0)
                ->get();
    }
    public function listFail(array $status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
                'bills.id as bill_id','bills.amount as bills_amount', 'bills.total as bills_total', 'info_user_bills.name',
                'info_user_bills.number_phone as info_number_phone', 'info_user_bills.address as info_address',
                'users.email as user_email', 'users.name as user_name', 'users.number_phone as user_number_phone')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
                ->leftJoin('info_user_bills', 'bills.id_info_user_bill', '=', 'info_user_bills.id')
                ->orderBy('carts.created_at', 'desc')
                ->where('carts.amount', '<=', 0)
                ->whereIn('carts.status', $status)
                ->get();
    }
    public function deletecartfail(array $status){
        return Cart::where('.amount', '<=', 0)
                ->whereIn('status', $status)
                ->update(['status' => 6]);
    }
    public function getInforOderUser($id_user, $status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
                'bills.amount as bills_amount', 'bills.total as bills_total', 'info_user_bills.name', 'info_user_bills.number_phone', 'info_user_bills.address', 'users.email',
                'images.link_image as link_image_product')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
                ->leftJoin('images', 'carts.id_product_choese', '=', 'images.id_product')
                ->leftJoin('info_user_bills', 'bills.id_info_user_bill', '=', 'info_user_bills.id')
                ->where('carts.id_user_create', $id_user)
                ->where('carts.amount', '>', 0)
                ->where('bills.amount', '>', 0)
                ->where('images.type', 1)
                ->whereIn('carts.status', $status)
                ->orderBy('carts.created_at', 'desc')
                ->get();
    }
    public function getInforBillOderUser($id_user, $id_cart){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
            'bills.id as id_bill', 'bills.id_info_user_bill as id_info_user_bill','bills.amount as bills_amount',
            'bills.total as bills_total', 'info_user_bills.name',
            'info_user_bills.number_phone', 'info_user_bills.address', 'users.email',
            'products.title as product_title' , 'products.id as id_product'  , 'images.link_image as product_link_image', 'products.price as price_product' )
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')
            ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
            ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
            ->leftJoin('products', 'carts.id_product_choese', '=', 'products.id')
            ->leftJoin('images', 'carts.id_product_choese', '=', 'images.id_product')
            ->leftJoin('info_user_bills', 'bills.id_info_user_bill', '=', 'info_user_bills.id')
            ->where('carts.id', $id_cart)
            ->where('carts.id_user_create', $id_user)
            ->where('images.type','=', 1)
            ->first();
    }
    public function getAllDataByIDUserAndStatusTreeData($id_user, $status)
    {
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')
            ->where('carts.id_user_create','=', $id_user)
            ->where('status', $status)
            ->where('carts.amount','>', 0)
            ->orderBy('created_at','desc')->get();
    }
    public function getAllDataByIDUserAndStatusTreeDataAdmin($id_user, $status)
    {
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')
            ->where('carts.id_user_create','=', $id_user)
            ->where('status', $status)
            ->orderBy('created_at','desc')->get();
    }
    public function getAllDataByIDUserAndStatus($id_user, $status)
    {
        if ($status == null && $id_user != null) {
            // DB::table('products')
            // ->leftJoin('images', 'products.id', '=', 'images.id_product')
            // ->select('products.*', 'images.link_image')
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('carts.id_user_create', $id_user)->orderBy('updated_at','desc')->get();
        }
        if ($id_user == null && $status != null) {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('status', $status)->orderBy('updated_at','desc')->get();
        }
        if ($id_user != null && $status != null) {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('carts.id_user_create','=', $id_user)->where('status', $status)->orderBy('updated_at','desc')->get();
        }
        // dnahf choa admin
        if ($id_user == null && $status == null) {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->orderBy('updated_at','desc')->get();
        }
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
        ->leftJoin('box', 'carts.id_box', '=', 'box.id')->orderBy('updated_at','desc')->get();
    }
    public function getAllDataByIDCartIDUserAndStatus($id_cart, $id_user, $status){
        // dd($id_cart, $id_user, $status);
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
        ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('carts.id', $id_cart)
        ->where('carts.id_user_create','=', $id_user)

        ->where('status', $status)->first();
    }
    public function showAllData($id_cart){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price as box_price', 'bills.total')
        ->leftJoin('box', 'carts.id_box', '=', 'box.id')->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')->where('carts.id', $id_cart)->first();
    }
    public function getAllByStatusmartket($type = null){
        if ($type != null) {
            if ($type == 1) {
                return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow', 'users.email', 'users.name', 'users.number_phone')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->where('carts.amount', '>', 0)
                ->where('carts.status', 10)
                ->orderBy('carts.updated_at', 'desc')
                ->paginate(20);
            }
            if ($type == 2) {
                return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow', 'users.email', 'users.name', 'users.number_phone')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->where('carts.amount', '>', 0)
                ->where('carts.status', 10)
                ->orderBy('carts.price_cart', 'asc')
                ->paginate(20);
            }
            if ($type == 3) {
                return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow', 'users.email', 'users.name', 'users.number_phone')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->where('carts.amount', '>', 0)
                ->where('carts.status', 10)
                ->orderBy('carts.price_cart', 'desc')
                ->paginate(20);
            }
        } else {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow', 'users.email', 'users.name', 'users.number_phone')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')
            ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
            ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
            ->where('carts.amount', '>', 0)
            ->where('carts.status', 10)
            ->orderBy('carts.updated_at', 'desc')
            ->paginate(20);
        }

    }
    public function getamountboxItemcartDone($id_event, $id_box_item){
        return Cart::where('id_box_event', $id_event)->where('id_box_item',$id_box_item)->whereNotIn('status', [1, 6])->sum('amount');
    }
    public function treedataCart($id, $id_box_item, $id_box_event, $id_box){
        return Folow::where('id_user', 'LIKE','%'.$id.',%')->where('id_box_event', $id_box_event)->where('id_box_item',$id_box_item)->where('id_box',$id_box)->get();

        // return Folow::where('id_user', 'REGEXP', '^['.$id.']')->where('id_box_event', $id_box_event)->where('id_box_item',$id_box_item)->where('id_box',$id_box)->get();
    }

    public function checkAddToCart($id_user, $id_cart_old){
        return  Cart::where('id_user_create', $id_user)
        ->where('status', 1)
        ->where('id_cart_old', $id_cart_old)
        ->first();
    }

}
