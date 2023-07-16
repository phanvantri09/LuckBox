<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Routing\UrlGenerator;
use App\Models\Category;
use Carbon\Carbon;
class ConstCommon {
     const ListTypeUser = ['user'=>111, 'admin'=>222, 'super_admin'=>333];
     const TypeUser = 111;
     const TypeAdmin = 222;
     const TypeSuperAdmin = 333;
     const ListTypeCatogory = ['product'=>1, 'box' =>2, 'event'=>3];
     const TypeImgae = ['slide' =>1, 'fixed' =>2 ];
    public static function getnameByTypeCategory($key){
        return array_search($key, ConstCommon::ListTypeCatogory);
    }
     public static function getAllCategory(){
          return Category::all();
     }
     public static function addImageToStorage($file, $name ){
          $file->storeAs('images', $filename, 'public');
     }
     public static function getLinkImageToStorage($name){
          return url('storage/images/'.$name);
     }
     public static function getCurrentTime(){
        $now = Carbon::now();
        $now->setTimezone('Asia/Ho_Chi_Minh');
        return $now->format('Y-m-d').'-'. $now->format('h-s-i');
     }
}
