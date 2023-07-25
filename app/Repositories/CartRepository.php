<?php
namespace App\Repositories;

use App\Models\Cart;

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
        ->first();
        if (empty($cart)) {
            return false;
        } else {
            $cart->amount = $cart->amount + $data['amount'];
            $cart->save();
            return true;
        }
    }

}
