<?php

namespace App\Http\Controllers;

use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Helpers\ConstCommon;
use App\Http\Requests\Card\CreateRequestCard;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    protected $pageRepository;
    protected $boxRepository;
    protected $boxProductRepository;
    protected $boxEventRepository;
    protected $imageRepository;
    protected $productRepository;

    public function __construct(PageRepositoryInterface $pageRepository, BoxRepositoryInterface $boxRepository, BoxProductRepositoryInterface $boxProductRepository, BoxEventRepositoryInterface $boxEventRepository, ImageRepositoryInterface $imageRepository, ProductRepositoryInterface $productRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->productRepository = $productRepository;
        $this->boxRepository = $boxRepository;
        $this->boxProductRepository = $boxProductRepository;
        $this->boxEventRepository = $boxEventRepository;
        $this->imageRepository = $imageRepository;

    }

    public function boxInfo($id)
    {
        $data = $this->boxRepository->show($id);
        $product = $this->boxProductRepository->getAllProduct($id);
        $getAllByIDProductMain = $this->imageRepository;
        return view('user.page.box.info', compact('data', 'product', 'getAllByIDProductMain'));
    }
    public function boxList($id)
    {
        $getEvent = $this->boxEventRepository->listBox($id)->boxItem;
        return view('user.page.box.list',compact('getEvent'));
    }
    public function treeData()
    {
        return view('user.page.box.treedata');
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
    public function historyTransaction()
    {
        return view('user.page.historyTransaction');
    }
    public function productDetails($id)
    {
        $data = $this->productRepository->show($id);
        $getAllByIDProductMain = $this->imageRepository->getAllByIDProductMain($id);
        $getAllByIDProductSlide = $this->imageRepository->getAllByIDProductSlide($id);
        $getAllByIDProductItem = $this->imageRepository->getAllByIDProductItem($id);
        return view('user.page.productDetails', compact('data', 'getAllByIDProductMain', 'getAllByIDProductSlide', 'getAllByIDProductItem'));
    }
    public function statusOrder()
    {
        return view('user.page.statusOrder');
    }
}
