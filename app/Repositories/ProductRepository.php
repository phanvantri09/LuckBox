<?php
namespace App\Repositories;

use App\Models\Product;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::with('category')->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Product::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Product::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }
    public function getByArrayID($array){
        return DB::table('products')
            ->leftJoin('images', 'products.id', '=', 'images.id_product')
            ->select('products.*', 'images.link_image')
            ->whereIn('products.id', $array)
            ->where('type', 1)
            ->get();
        // return DB::table('products')->select('products.*', 'images.link_image')->leftJoin('images', 'images.id_product', '=', 'products.id')->whereIn('id', $array)->where('type', 1)->get();
    }
    public function getImageSlide($array){
        // dd($array);
        return Image::whereIn('id_product', $array)
            ->where('is_slide', 1)
            ->get();
    }
}
