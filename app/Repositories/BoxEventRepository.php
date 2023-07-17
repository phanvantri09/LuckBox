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
        $user = Box_event::findOrFail($id);
        $user->update($data);
        return $user;
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
}
