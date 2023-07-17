<?php
namespace App\Repositories;

use App\Models\Box_product;

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
}
