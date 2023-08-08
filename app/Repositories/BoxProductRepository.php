<?php
namespace App\Repositories;

use App\Models\Box;
use App\Models\Box_product;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class BoxProductRepository implements BoxProductRepositoryInterface
{
    public function all()
    {
        return Box_product::all();
    }

    public function create(array $data)
    {
        return Box_product::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Box_product::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Box_product::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Box_product::findOrFail($id);
    }
    public function getAllByType($type){
        return Box_product::where('type', $type)->get();
    }
    public function getAllByIdBoxChoese($id_box){
        return Box_product::where('id_box', $id_box)->where('status', 1)->get();
    }
    public function getAllProduct($id_box){
        return Box::with('boxProducts', 'boxProducts.product')->findOrFail($id_box);
    }
    public function getAllProductByBox($id_box){
        return Box_product::where('id_box',$id_box)->get();
    }

    public function getAllProductNotInBox($id_box){
        return Product::whereNotIn('id', function ($query) use ($id_box) {
            $query->select('id_product')
                ->from('box_products')
                ->where('id_box', $id_box);
        })->get();
    }

    public function getCountProductStatus($id_box){
        return Box::with(['boxProducts' => function ($query) {
            $query->where('status', 1);
        }])->findOrFail($id_box);
    }
}
