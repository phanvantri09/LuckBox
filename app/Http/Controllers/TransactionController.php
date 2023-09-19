<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
class TransactionController extends Controller
{
    protected $transactionRepository;
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index(Request $request)
    {
        if ($request->has('type')) {
            $getAllTrans = $this->transactionRepository->getByStatus($request->type);
        } else {
            $getAllTrans = $this->transactionRepository->all();
        }
        return view('admin.transaction.list', compact('getAllTrans'));
    }
    public function changeStatus($id, $idUser,$type, Request $request)
    {
        if ($request->type == 1) {
            $trans = Transaction::findOrFail($id);
            $user = User::findOrFail($idUser);
            if (!empty($trans)) {
                if ($trans->total > $user->balance) {
                    if($this->transactionRepository->update(['status'=>3], $id)){
                        ConstCommon::sendMail(
                            $user->email, 
                            ['email' => $user->email,'type'=>'Rút tiền','status'=> "Bị từ chối, vì số tiền hiện tại trong Ví ". number_format($user->balance). " là không đủ.", "balance"=>$trans->total, 'link'=>route('walet')]
                        );
                        return back()->with('error', 'Đã chuyển sang trạng thái bị từ chối vì số tiền hiện tại trong Ví của khách hàng không đủ');
                    }
                }
            }

        }
        if ($this->transactionRepository->changeStatus($id, $idUser,$type,$request->status)) {
            return back()->with('message', 'Thành Công');
        } else {
            return back()->with('error', 'Lỗi tiến trình');
        }

    }
}
