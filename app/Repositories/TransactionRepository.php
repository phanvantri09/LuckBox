<?php
namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Bill;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(array $data)
    {
        return Transaction::create($data);
    }
    public function all()
    {
        return Transaction::with('User')->orderBy('id', 'desc')->get();
    }
    public function changeStatus($id,$idUser,$type,$status)
    {

        $trans = Transaction::find($id);
        $bill = Bill::where('id_transaction', $trans->id)->first();
        $cart = Cart::find($bill->id_cart);
        $user = User::find($idUser);
        DB::beginTransaction();
        try {
            if($status == 1){
                $trans->update(['status' => 1]);
                $bill->update(['status' => 1]);
                $cart->update(['status' => 1]);
            }else{
                if($status == 2){
                    $trans->update(['status' => 2]);
                    $bill->update(['status' => 2]);
                    $cart->update(['status' => 2]);
                    if($trans->type == 1 || $trans->type == 3 || $trans->type == 4){
                        $user->balance = $user->balance - $trans->total;
                        $user->save();
                    }else{
                        $user->balance = $user->balance + $trans->total;
                        $user->save();
                    }
                }else{
                    $trans->update(['status' => 3]);
                    $bill->update(['status' => 6]);
                    $cart->update(['status' => 6]);
                }
            }
            DB::commit();
        } catch (\Exception $e){
            // report($e);
            DB::rollBack();
            return false;
        }
        return true;
    }
    public function update(array $data, $id)
    {
        $user = Transaction::findOrFail($id);
        $user->update($data);
        return $user;
    }

}
