<?php
namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;

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
        $user = User::find($idUser);

        if($status == 1){
            $trans->update(['status' => 1]);
        }else{
            if($status == 2){
                $trans->update(['status' => 2]);
                if($trans->type == 1){
                    $user->balance = $user->balance - $trans->total;
                    $user->save();
                }else{
                    if( $trans->type ==2 ){
                        $user->balance = $user->balance + $trans->total;
                        $user->save();
                    }
                }
            }else{
                $trans->update(['status' => 3]);
            }
        }
    }

}
