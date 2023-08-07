<?php
namespace App\Repositories;

use App\Models\Cart;
use App\Models\Folow;
use Illuminate\Support\Facades\DB;
class CartRepository implements CartRepositoryInterface
{
    public function all()
    {
        return Cart::all();
    }
    public function show($id){
          return Cart::find($id);
    }
    public function getAllByStatus($status)
    {
        return Cart::where('status', $status)->get();
    }
    public function getAllByIDUser($id_user)
    {
        return Cart::where('id_user_create', $id_user)->get();
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
        $user->save();
    }
    public function update(array $data, $id)
    {
        $user = Cart::findOrFail($id);
        $user->update($data);
        return $user;
    }
    public function delete($id)
    {
          $user = Cart::findOrFail($id);
          $user->delete();
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
    public function getAllDataByIDUserAndArrayStatus($id_user, array $status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->where('carts.id_user_create','=', $id_user)
                ->whereIn('status', $status)->get();
    }
    public function getInforOder($status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
                'bills.amount as bills_amount', 'bills.total as bills_total', 'bills.name', 'bills.number_phone', 'bills.address', 'users.email')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
                ->where('carts.status', $status)->get();
    }
    public function getInforOderUser($id_user, $status){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
                'bills.amount as bills_amount', 'bills.total as bills_total', 'bills.name', 'bills.number_phone', 'bills.address', 'users.email')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
                ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
                ->where('carts.id_user_create', $id_user)
                ->whereIn('carts.status', $status)
                ->orderBy('carts.status', 'desc')
                ->get();
    }
    public function getInforBillOderUser($id_user, $id_cart){
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price',
            'bills.amount as bills_amount', 'bills.total as bills_total', 'bills.name',
            'bills.number_phone', 'bills.address', 'users.email',
            'products.title' , 'products.id as id_product'  , 'images.link_image as product_link_image' )
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')
            ->leftJoin('bills', 'carts.id', '=', 'bills.id_cart')
            ->leftJoin('users', 'carts.id_user_create', '=', 'users.id')
            ->leftJoin('products', 'carts.id_product_choese', '=', 'products.id')
            ->leftJoin('images', 'carts.id_product_choese', '=', 'images.id_product')
            ->where('carts.id', $id_cart)
            ->where('carts.id_user_create', $id_user)
            ->where('images.type','=', 1)
            ->first();
    }

    public function getAllDataByIDUserAndStatus($id_user, $status)
    {
        if ($status == null && $id_user != null) {
            // DB::table('products')
            // ->leftJoin('images', 'products.id', '=', 'images.id_product')
            // ->select('products.*', 'images.link_image')
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('carts.id_user_create', $id_user)->get();
        }
        if ($id_user == null && $status != null) {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('status', $status)->get();
        }
        if ($id_user != null && $status != null) {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->where('carts.id_user_create','=', $id_user)->where('status', $status)->get();
        }
        // dnahf choa admin
        if ($id_user == null && $status == null) {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')->get();
        }
        return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price')
        ->leftJoin('box', 'carts.id_box', '=', 'box.id')->get();
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
                return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
                ->where('carts.amount', '>', 0)
                ->where('carts.status', 10)
                ->orderBy('carts.created_at', 'desc')
                ->paginate(20);
            }
            if ($type == 2) {
                return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
                ->where('carts.amount', '>', 0)
                ->where('carts.status', 10)
                ->orderBy('carts.price_cart', 'desc')
                ->paginate(20);
            }
            if ($type == 3) {
                return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow')
                ->leftJoin('box', 'carts.id_box', '=', 'box.id')
                ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
                ->where('carts.amount', '>', 0)
                ->where('carts.status', 10)
                ->orderBy('carts.price_cart', 'asc')
                ->paginate(20);
            }
        } else {
            return DB::table('carts')->select('carts.*', 'box.title', 'box.link_image', 'box.price', 'folows.id_user as id_user_folow')
            ->leftJoin('box', 'carts.id_box', '=', 'box.id')
            ->leftJoin('folows', 'carts.id_folow', '=', 'folows.id')
            ->where('carts.amount', '>', 0)
            ->where('carts.status', 10)
            ->paginate(20);
        }

    }
    public function getamountboxItemcartDone($id_event, $id_box_item){
        return Cart::where('id_box_event', $id_event)->where('id_box_item',$id_box_item)->whereNotIn('status', [1, 6])->sum('amount');
    }
    public function treedataCart($id, $id_box_item, $id_box_event, $id_box){
        return Folow::where('id_user', 'REGEXP', '^['.$id.']')->where('id_box_event', $id_box_event)->where('id_box_item',$id_box_item)->where('id_box',$id_box)->get();
    }

}
