<?php

namespace App\Http\Controllers;

use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Http\Request;
use App\Helpers\ConstCommon;
class PageController extends Controller
{
    protected $boxRepository;
    protected $boxProductRepository;
    protected $boxEventRepository;
    protected $imageRepository;

    public function __construct(BoxRepositoryInterface $boxRepository, BoxProductRepositoryInterface $boxProductRepository, BoxEventRepositoryInterface $boxEventRepository, ImageRepositoryInterface $imageRepository)
    {
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
    public function walet()
    {
        return view('user.page.walet');
    }
    public function cashOut()
    {
        return view('user.page.cashOut');
    }
    public function historyTransaction()
    {
        return view('user.page.historyTransaction');
    }
    public function productDetails()
    {
        return view('user.page.productDetails');
    }
    public function statusOrder()
    {
        return view('user.page.statusOrder');
    }
}
