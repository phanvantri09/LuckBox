<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ConstCommon;
class PageController extends Controller
{
    public function __construct()
    {
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
    public function walet()
    {
        return view('user.page.walet');
    }
}
