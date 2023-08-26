<?php
namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Bill;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Helpers\ConstCommon;
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
    public function getByStatus($type)
    {
        return Transaction::with('User')->where('type', $type)->orderBy('id', 'desc')->get();
    }
    public function changeStatus($id,$idUser,$type,$status)
    {

        $trans = Transaction::find($id);
        $bill = Bill::where('id_transaction', $trans->id)->first();
        if (!empty($bill)) {
            $cart = Cart::find($bill->id_cart);
        }
        $user = User::find($idUser);
        DB::beginTransaction();
        try {
            if($status == 1){
                $trans->update(['status' => 1]);
                if (!empty($bill)) {
                $bill->update(['status' => 1]);
                $cart->update(['status' => 1]);
            }
            }else{
                if($status == 2){
                    $trans->update(['status' => 2]);
                    if (!empty($bill)) {
                        $bill->update(['status' => 2]);
                        $cart->update(['status' => 2]);
                    }
                    if($trans->type == 1 || $trans->type == 3 || $trans->type == 4){
                        $user->balance = $user->balance - $trans->total;
                        ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>'rút tiền','status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);

                    }else{
                        $user->balance = $user->balance + $trans->total;
                        ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>'nạp tiền','status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);

                    }
                }else{
                    $trans->update(['status' => 3]);
                    if (!empty($bill)) {
                        $bill->update(['status' => 6]);
                        $cart->update(['status' => 6]);
                    }
                }
            }
            $user->save();
            DB::commit();
        } catch (\Exception $e){
            // report($e);
            DB::rollBack();
            ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>'nạp/rút tiền','status'=> "Không thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
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
    public function listForUser($id_user){
        return Transaction::where('id_user',$id_user)->orderBy('created_at', 'desc')->get();
    }

    public function getByIDCart($id_cart, $id_user){
        return Transaction::whereIn('id_cart',$id_cart)->whereIn('type', [5])->where('id_user', $id_user)->orderBy('created_at','desc')->get();
    }
    public function getAll($id_user){
        return Transaction::where('id_user',$id_user)->whereIn('type', [5])->orderBy('created_at','desc')->get();
    }

}
