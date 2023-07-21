<?php
namespace App\Repositories;

use App\Models\Box_item;
use Carbon\Carbon;
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
    public function getByIDBoxEvent($id){
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        $time = $currentTime->format('Y-m-d H:i:s');
        return Box_item::where('id_box_event', $id)->where('time_start', '<', $time)->where('time_end', '>', $time)->first();
    }
}
