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
    public function getAllByIdEvent($id){
        return Box_item::where('id_box_event', $id)->get();
    }
    public function changeStatus($id, $status ){
        $boxItem = Box_item::findOrFail($id);
        
        if($status == 1){
            $boxItem->update(['status' =>  1]);
        }else{
            if($status == 2){
                $boxItem->update(['status' =>  2]);
            }else{
                $boxItem->update(['status' =>  3]);
            }
        }
        
    }
}
