<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Routing\UrlGenerator;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendLinkMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Box_item;
use App\Models\Transaction;
class ConstCommon {
     const ListTypeUser = ['user'=>111, 'admin'=>222, 'super_admin'=>333];
     const TypeUser = 111;
     const TypeAdmin = 222;
     const TypeSuperAdmin = 333;
     const ListTypeCatogory = ['product'=>1, 'box' =>2, 'event'=>3];
     const TypeImgae = ['slide' =>1, 'fixed' =>2 ];
     const TypeCard = [ 'Không ưu tiên' =>0, 'Ưu tiên' =>1];
     // link https://wikiland.vn/ngan-hang-viet-nam/
     const BankVN= [
          'ACB'=>['name' => ' Ngân hàng ACB', 'image'=>'dist/img/bank/acb.jpg'],
          'MBBank'=>['name' => ' MBBank – Ngân hàng Quân Đội', 'image'=>'dist/img/bank/MBBank.png'],
          'Vietcombank'=>['name' => ' Vietcombank – Ngân hàng Ngoại thương', 'image'=>'dist/img/bank/Vietcombank.jpg'],
          'Agribank'=>['name' => ' Agribank – Ngân hàng Nông nghiệp và Phát triển Nông thôn', 'image'=>'dist/img/bank/Vietcombank.jpg'],
          'Sacombank'=>['name' => ' Sacombank – Ngân hàng TMCP Sài Gòn Thương Tín', 'image'=>'dist/img/bank/Sacombank.jpg'],
          'VPBank'=>['name' => ' VPBank – Ngân hàng Việt Nam Thịnh Vượng', 'image'=>'dist/img/bank/VPBank.jpg'],
          'Techcombank'=>['name' => ' Techcombank – Ngân hàng TMCP Kỹ Thương', 'image'=>'dist/img/bank/Techcombank.jpg'],
          'VIB'=>['name' => ' VIB Bank – Ngân hàng TMCP Quốc tế Việt Nam', 'image'=>'dist/img/bank/VIB.jpg'],
          'BIDV'=>['name' => ' BIDV – Ngân hàng Đầu tư và Phát triển Việt Nam', 'image'=>'dist/img/BIDV.jpeg'],
          'TPBank'=>['name' => ' TPBank – Ngân hàng Tiên Phong', 'image'=>'dist/img/bank/TPBank.jpg'],
          'VietinBank'=>['name' => ' VietinBank – Ngân hàng Công Thương', 'image'=>'dist/img/bank/VietinBank.jpg'],
          'OCB'=>['name' => ' OCB Bank – Ngân hàng Phương Đông', 'image'=>'dist/img/bank/OCB.jpg'],
          'Lienvietpostbank'=>['name' => ' Ngân hàng TMCP Bưu điện Liên Việt – Lienvietpostbank', 'image'=>'dist/img/bank/Lienvietpostbank.png'],
          'VietCapitalBank'=>['name' => ' Ngân hàng Bản Việt – Viet Capital Bank', 'image'=>'dist/img/bank/noimage.jpg'],
          'VietBank'=>['name' => ' VietBank – Ngân hàng Thương Tín', 'image'=>'dist/img/bank/noimage.jpg'],
          'HSBC'=>['name' => ' Ngân hàng HSBC', 'image'=>'dist/img/bank/HSBCKienlongbank.jpg'],
          'Kienlongbank'=>['name' => ' Kienlongbank – Ngân hàng TMCP Kiên Long', 'image'=>'dist/img/bank/Kienlongbank.jpg'],
          'VietA'=>['name' => ' Ngân hàng Việt Á – VietA Bank', 'image'=>'dist/img/bank/noimage.jpg'],
          'BaoVietBank'=>['name' => ' Bảo Việt Bank – Ngân hàng Bảo Việt', 'image'=>'dist/img/bank/noimage.jpg'],
          'BacABank'=>['name' => ' Bắc Á Bank – Ngân hàng Bắc Á', 'image'=>'dist/img/bank/noimage.jpg'],
          'SaigonBank'=>['name' => ' SaigonBank – Ngân hàng Sài Gòn Công Thương', 'image'=>'dist/img/bank/noimage.jpg'],
          'NCB'=>['name' => ' NCB Bank – Ngân hàng Quốc Dân', 'image'=>'dist/img/bank/noimage.jpg'],
          'PG'=>['name' => ' PG Bank – Ngân hàng Xăng dầu Petrolimex', 'image'=>'dist/img/bank/noimage.jpg'],
          'SeABank'=>['name' => ' SeABank – Ngân hàng Đông Nam Á', 'image'=>'dist/img/bank/noimage.jpg'],
          'PVcomBank'=>['name' => ' PVcomBank – Ngân hàng Đại Chúng', 'image'=>'dist/img/bank/noimage.jpg'],
          'MSB'=>['name' => ' MSB – Ngân hàng Hàng hải Việt Nam', 'image'=>'dist/img/bank/noimage.jpg'],
          'ABBank'=>['name' => ' ABBank – Ngân hàng An BìnhNgân hàng Citibank', 'image'=>'dist/img/bank/noimage.jpg'],
          'NamABank'=>['name' => ' Nam Á Bank – Ngân hàng Nam Á', 'image'=>'dist/img/bank/noimage.jpg'],
          'GPBank'=>['name' => ' GPBank – Ngân hàng Dầu khí Toàn cầu', 'image'=>'dist/img/bank/noimage.jpg'],
          'ĐongABank'=>['name' => ' Shinhan Bank – Ngân hàng Shinhan', 'image'=>'dist/img/bank/noimage.jpg'],
          'HDBankCB'=>['name' => ' Ngân hàng HDBankCB Bank – Ngân hàng Xây dựng', 'image'=>'dist/img/bank/noimage.jpg'],
          'Eximbank'=>['name' => ' Eximbank – Ngân hàng Xuất Nhập Khẩu', 'image'=>'dist/img/bank/noimage.jpg'],
          'SHB'=>['name' => ' SHB – Ngân hàng TMCP Sài Gòn – Hà Nội', 'image'=>'dist/img/bank/noimage.jpg'],
          'Oceanbank'=>['name' => ' Oceanbank – Ngân hàng Đại Dương', 'image'=>'dist/img/bank/noimage.jpg'],
          'VRB'=>['name' => ' Ngân hàng Liên doanh Việt – Nga (VRB)', 'image'=>'dist/img/bank/noimage.jpg'],
          'BIDC'=>['name' => ' BIDC – Ngân hàng Đầu tư và Phát triển Campuchia', 'image'=>'dist/img/bank/noimage.jpg'],
          'HongLeong'=>['name' => ' Hong Leong Bank – Ngân hàng TNHH MTV Hong Leong', 'image'=>'dist/img/bank/noimage.jpg'],
          'CIMB'=>['name' => ' CIMB Bank – Ngân hàng CIMB', 'image'=>'dist/img/bank/noimage.jpg'],
          'UOB'=>['name' => ' Ngân hàng UOB – United Overseas Bank', 'image'=>'dist/img/bank/noimage.jpg'],
          'StandardCharteredBank'=>['name' => ' Standard Chartered Bank – Thương hiệu ngân hàng đa quốc gia', 'image'=>'dist/img/bank/noimage.jpg'],
          'Indovina'=>['name' => ' Indovina Bank – Ngân hàng TNHH INDOVINA (IVB)', 'image'=>'dist/img/bank/noimage.jpg'],
          'PBVN'=>['name' => ' Ngân hàng Public Bank (PBVN)', 'image'=>'dist/img/bank/noimage.jpg'],
          'Woori'=>['name' => ' Woori Bank – Ngân hàng Woori', 'image'=>'dist/img/bank/noimage.jpg'],

     ] ;
    const TypeTransaction = [ 1 => 'Rút tiền', 2 => 'Nạp tiền', 3 => 'Thanh toán box', 4 => "Doanh thu bán box", 5 => 'Hoa hồng bán box', 6 => 'Giới thiệu'];


    public static function getnameByTypeCategory($key){
        return array_search($key, ConstCommon::ListTypeCatogory);
    }
     public static function getAllCategory(){
          return Category::all();
     }
     public static function addImageToStorage($file, $name ){
          $file->storeAs('images', $name, 'public');
     }
     public static function getLinkImageToStorage($name){
          return url('storage/images/'.$name);
     }
     public static function delImageToStorage($name){
          return Storage::delete('images/'.$name);
     }
     public static function getCurrentTime(){
        $now = Carbon::now();
        $now->setTimezone('Asia/Ho_Chi_Minh');
        return $now->format('Y-m-d').'-'. $now->format('h-s-i');
     }
     public static function priceUp($count, $price){
        $totalShow = $price;
        for ($i=0; $i < $count; $i++) {
            $totalShow = $totalShow + ($totalShow * 6/100);
        }
        return $totalShow;
     }
     public static function sendMail($email, $content){
        $mail = new SendMail($content);
        return Mail::to($email)->queue($mail);
    }
    public static function sendMailLinkPass($email, $content){
        $mail = new SendLinkMail($content);
        return Mail::to($email)->queue($mail);
    }
    public static function getCartCurent(){
        $user = Auth::user();
        return Cart::where('id_user_create', $user->id)->where('status', 1)->get()->count();
    }
    public static function getBoxCurent(){
        $user = Auth::user();
        return Cart::where('id_user_create', $user->id)->where('status', 2)->get()->count();
    }
    public static function getBoxMarket(){
     $user = Auth::user();
     return Cart::where('id_user_create', $user->id)->where('status', 10)->where('amount', '>', 0)->get()->count();
    }
    public static function getAmountBoxItem($id){
        return Box_item::find($id)->amount;
    }
    public static function getTotalTransaction($id_transaction, $balance){
        $transaction =  Transaction::find($id_transaction);
        if ($transaction->type == 5) {
            $listAffter  = Transaction::where('id_user', $transaction->id_user)
            ->where('status', 2)
            ->where('updated_at', '>=', $transaction->created_at)
            ->get();
        } else {
            $listAffter  = Transaction::where('id_user', $transaction->id_user)
            ->where('status', 2)
            ->where('updated_at', '>', $transaction->created_at)
            ->get();
        }

        $total = 0;
        foreach ($listAffter as $key => $listA) {
            if ($listA->id != $id_transaction ) {
                if ($listA->type == 1 || ($listA->type == 3 && $listA->id_cart != null)) {
                    $moeny = - $listA->total;
                } else {
                    $moeny = $listA->total;
                }
                $total = $total + $moeny;
            }
        }
        return number_format($balance - $total);
    }
    public static function cartByID($id){
        return Cart::find($id);
    }
}
