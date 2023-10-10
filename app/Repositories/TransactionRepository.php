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
        $user = User::where('id',$idUser)->lockForUpdate()->first();
        DB::beginTransaction();
        try {
            // Vừa tạo :
                // Th1: trạng thái trước đó là thành công => trừ tiền trong ví
                // Th2: trạng thái trước đó là từ chối => chỉ đổi trạng thái và không cập nhật tiền gì cả
            // Thành công : tiền sẽ dc chuyển vào ví
                // TH1: trạng thái trước đó là vừa tạo => + tiền vào ví
                // TH2: trại thái trước đó là Từ chối => + tiền vào ví
            // Từ chối :
                // TH 1: trạng thái trước đó là vừa tạo => chỉ đổi trạng thái và không cập nhật tiền gì cả
                // Th2: trạng thái trước đó là thành công => - tiền trong ví hiện tại

            if ($trans->status != $status) {
                if ($trans->status == 1) {
                    if ($status == 2) {
                        if($trans->type == 1 || $trans->type == 3 || $trans->type == 4){
                            $user->balance = $user->balance - $trans->total;
                            // if (!empty($user->email)) {
                            //     ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>ConstCommon::TypeTransaction[$trans->type],'status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
                            // }
                        }else{
                            $user->balance = $user->balance + $trans->total;
                            // if (!empty($user->email)) {
                            //     ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>ConstCommon::TypeTransaction[$trans->type],'status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
                            // }
                        }
                    } else {
                        // if (!empty($user->email)) {
                        //     ConstCommon::sendMail(
                        //         $user->email,
                        //         ['email' => $user->email,'type'=> ConstCommon::TypeTransaction[$trans->type],'status'=> "Bị từ chối" , "balance"=>$trans->total, 'link'=>route('walet')]
                        //     );
                        // }
                    }
                }

                if ($trans->status == 2) {
                    if($trans->type == 1 || $trans->type == 3 || $trans->type == 4){
                        $user->balance = $user->balance + $trans->total;
                        // if (!empty($user->email)) {
                        //     ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>ConstCommon::TypeTransaction[$trans->type],'status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
                        // }
                    } else {
                        $user->balance = $user->balance - $trans->total;
                        // if (!empty($user->email)) {
                        //     ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>ConstCommon::TypeTransaction[$trans->type],'status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
                        // }
                    }
                }

                if ($trans->status == 3) {
                    // từ chối sang  chấp nhận thì cộng tiền
                    if ($status == 2) {
                        if($trans->type == 1 || $trans->type == 3 || $trans->type == 4){
                            $user->balance = $user->balance - $trans->total;
                            // if (!empty($user->email)) {
                            //     ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>ConstCommon::TypeTransaction[$trans->type],'status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
                            // }
                        } else {
                            $user->balance = $user->balance + $trans->total;
                            // if (!empty($user->email)) {
                            //     ConstCommon::sendMail($user->email, ['email' => $user->email,'type'=>ConstCommon::TypeTransaction[$trans->type],'status'=> "Thành công", "balance"=>$trans->total, 'link'=>route('walet')]);
                            // }
                        }
                    }
                }

                $trans->update(['status' => $status]);
                $user->save();

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
        return Transaction::select('transactions.*', 'carts.order_number as folow', 'carts.id_cart_old as id_cart_old')
        ->leftJoin('carts', 'transactions.id_cart', '=', 'carts.id')->where('id_user',$id_user)->orderBy('created_at', 'desc')->get();
    }

    public function listForUserAdmin($id_user){
        return Transaction::select('transactions.*', 'carts.order_number as folow', 'carts.id_cart_old as id_cart_old')
        ->leftJoin('carts', 'transactions.id_cart', '=', 'carts.id')->where('id_user',$id_user)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function getByIDCart($id_cart, $id_user){
        return Transaction::whereIn('id_cart',$id_cart)->whereIn('type', [5])->where('id_user', $id_user)->orderBy('created_at','desc')->get();
    }
    public function getAll($id_user){
        return Transaction::select('transactions.*', 'carts.order_number as folow')
        ->leftJoin('carts', 'transactions.id_cart', '=', 'carts.id')->
        where('id_user',$id_user)->whereIn('type', [5])->orderBy('updated_at','desc')->get();
    }
    public function delete($id)
    {
        $user = Transaction::findOrFail($id);
        return $user->delete();
    }
    public function checkCashOUT($id)
    {
        $user = Transaction::where('id_user',$id)->where('type', 1)->where('status', 1)->get()->count();
        if ($user >=1 ) {
            return true;
        } else {
            return false;
        }
    }

}
