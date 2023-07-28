<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepositoryInterface;

class TransactionController extends Controller
{
    protected $transactionRepository;
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        $getAllTrans = $this->transactionRepository->all();

        return view('admin.transaction.list', compact('getAllTrans'));
    }
    public function changeStatus($id, $idUser,$type, Request $request)
    {
        if ($this->transactionRepository->changeStatus($id, $idUser,$type,$request->status)) {
            return back()->with('message', 'Thành Công');
        } else {
            return back()->with('error', 'Lỗi tiến trình');
        }

    }
}
