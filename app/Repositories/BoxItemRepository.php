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
    public function getByIDBoxEvent($id, $time){

        return Box_item::where('id_box_event', $id)->where('time_start', '<', $time)->where('time_end', '>', $time)->whereNotIn('status', [1,3])->orderBy('time_start', 'asc')->first();
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


    public function checkAndAutoUpdateStatus($id_event, $time){
        $data = Box_item::where('time_start', '<=', $time)->where('time_end', '>=', $time)->where('id_box_event', $id_event)->first();
        if(empty($data)){
            $data = Box_item::where('time_end', '<', $time)->where('id_box_event', $id_event)->first();
            if(!empty($data)){
                if($data->status != 3){
                    $data->status = 3;
                    $data->save();
                }
            }
        } else {
            if ($data->status != 2 ) {
                $data->status = 2;
                $data->save();
            }
        }
    }
    public function getFirstInCaseEventEmpty($id){

        return Box_item::where('id_box_event', $id)->whereNotIn('status', [2,3])->orderBy('time_start', 'asc')->first();
    }

}
