<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ConstCommon;
use App\Http\Requests\Card\CreateRequestCard;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    protected $pageRepository;
    public function __construct(PageRepositoryInterface $pageRepository )
    {
        $this->pageRepository = $pageRepository;
    }

    public function boxInfo()
    {
        return view('user.page.box.info');
    }
    public function boxList()
    {
        return view('user.page.box.list');
    }
    public function treeData()
    {
        return view('user.page.box.treedata');
    }
    public function cart()
    {
        return view('user.page.cart');
    }
    public function chekout()
    {

        return view('user.page.checkout');
    }
    public function purchaseOrder()
    {
        return view('user.page.box.purchaseOrder');
    }
    public function resell()
    {
        return view('user.page.resell');
    }
    public function market()
    {
        return view('user.page.market');
    }
    public function infoCardPay()
    {
        return view('user.page.infoCardPay');
    }
    public function createCard()
    {
        $dataBank = ConstCommon::BankVN;
        return view('user.page.createCard', compact(['dataBank']));
    }
    public function createCardPost(CreateRequestCard $request)
    {
            $currentUser = Auth::user();
            $request->merge([
            'id_user' => $currentUser->id,
            'id_user_create' => $currentUser->id, 
            'id_user_update' => $currentUser->id, 
            'type' => $currentUser->type, 
        ]);
        $data = $request->all();
        $this->pageRepository->createCard($data);
        return redirect()->route('walet')->with('message', 'Thêm thành công');
    }
    public function walet()
    {
        $currentUser = Auth::user();
        $checkCard = $this->pageRepository->checkCard($currentUser->id);
        if(empty($checkCard)){
            return redirect()->route('createCard');
        };
        $showCardDefault = $this->pageRepository->showCardDefault($currentUser->id);//lấy card ưu tiên
        $getAllCard = $this->pageRepository->getAllCardNotIn([$showCardDefault->id]);//lấy ra tất cả card của khác user này
        
        
        return view('user.page.walet',compact('showCardDefault','currentUser','getAllCard'));
    }
    public function changeStatus($id)
    {
        $currentUser = Auth::user();
        $idCard  = $id;
        $this->pageRepository->changeStatus($currentUser->id, $idCard);
        return back()->with('message', ' Thành Công');
        
    }
    public function cashOut()
    {
        return view('user.page.cashOut');
    }
}
