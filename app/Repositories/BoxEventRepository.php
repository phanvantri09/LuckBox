<?php
namespace App\Repositories;

use App\Models\Box_event;

class BoxEventRepository implements BoxEventRepositoryInterface
{
    public function all()
    {
        return Box_event::all();
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
        return Box_event::where('time_end', '>=', $time)->get();
    }
}
