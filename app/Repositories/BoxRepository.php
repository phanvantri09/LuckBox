<?php
namespace App\Repositories;

use App\Models\Box;

class BoxRepository implements BoxRepositoryInterface
{
    public function all()
    {
        return Box::with('category')->get();
    }

    public function create(array $data)
    {
        return Box::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Box::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Box::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Box::with('category', 'userCreated', 'userUpdated')->findOrFail($id);
    }
    public function getAllByType($type){
        return Box::where('type', $type)->get();
    }
}
