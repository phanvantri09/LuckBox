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
    public function getByIDBoxEvent($event){
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        $time = $currentTime->format('Y-m-d H:i:s');
        // $time = '2023-07-28 23:05:45';
        return Box_item::where('id_box_event', $event->id)->where('time_start', '<', $time)->where('time_end', '>', $time)->whereNotIn('status', [2,3])->orderBy('time_start', 'asc')->first();
        // return Box_item::where('id_box_event', $event->id)->where('time_start', '>=', $event->time_start)->where('time_end', '<=', $event->time_end)->orderBy('time_start', 'asc')->get();
    }

    public function getByIDBoxEventTimeThan($event, $time){
        return Box_item::where('id_box_event', $event->id)->where('time_start', '>', $time)->whereNotIn('status', [2,3])->orderBy('time_start', 'asc')->first();
    }

    // khi nó nằm trong thời gian thì chuyển trạng thái lên sàn để bán
    public function checkItemBoxUpMaket($id_event, $time){
        Box_item::where('status', 1)
        ->where('id_box_event', $id_event)
        ->where('time_start', '<=' , $time)
        ->where('time_end', '>=' , $time)
        ->update(['status' => 2]);
    }

    // hết thời gian thì chuyển qua 3
    public function checkItemBoxExpired($id_event, $time){
        Box_item::where('status', 1)
        ->where('id_box_event', $id_event)
        ->where('time_end', '<' , $time)
        ->update(['status' => 3]);
    }
}
