<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepositoryInterface;
use App\Models\Transaction;

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
            if (!empty($trans)) {
                if ($request->total > Auth::user()->balance) {
                    // lỗi ửo đây
                    // return back()->with('error', 'Lỗi tiến trình');
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
