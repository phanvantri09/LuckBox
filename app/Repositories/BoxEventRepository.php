<?php
namespace App\Repositories;

use App\Models\Box_event;

class BoxEventRepository implements BoxEventRepositoryInterface
{
    public function all()
    {
        return Box_event::with('boxItem')->get();
    }

    public function create(array $data)
    {

        return Box_event::create($data);
    }

    public function update(array $data, $id)
    {
        $event = Box_event::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id)
    {
        $user = Box_event::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Box_event::findOrFail($id);
    }
    public function getAllByType($type){
        return Box_event::where('type', $type)->get();
    }
    public function changeStatus($status, $id){
        $getEvent = Box_event::find($id);

        if ($status->input('status') == 1) {
            $getEvent->status = $status->input('status');
            $getEvent->save();

            return response()->json(['status' => 1]);
        } else {
            $getEvent->status = $status->input('status');
            $getEvent->save();
            return response()->json(['status' => 2]);
        }
    }
    public function getInTime($time){
        return Box_event::where('time_start', '<', $time)->where('time_end', '>', $time)->first();
    }

    public function getInTimeThan($time){
        return Box_event::where('time_start', '>=', $time)->whereNotIn('status', [2,3])->orderBy('time_start', 'asc')->first();
    }

    public function checkAndAutoUpdateStatus($time){
        // dd($time);
        $data = Box_event::where('time_start', '<=', $time)->where('time_end', '>=', $time)->first();
        if(empty($data)){
            $data = Box_event::where('time_end', '<', $time)->first();
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

    public function listBox($id)
    {
        return Box_event::with('boxItem')->findOrFail($id);
    }

}
