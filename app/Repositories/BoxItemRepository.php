<?php
namespace App\Repositories;

use App\Models\Box_item;

class BoxItemRepository implements BoxItemRepositoryInterface
{
    public function all()
    {
        return Box_item::all();
    }

    public function create(array $data)
    {
        return Box_item::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Box_item::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Box_item::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Box_item::findOrFail($id);
    }
    public function getAllByType($type){
        return Box_item::where('type', $type)->get();
    }
}
