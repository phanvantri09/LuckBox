<?php
namespace App\Repositories;

use App\Models\Bill;

class BillRepository implements BillRepositoryInterface
{
    public function all()
    {
        return Bill::all();
    }

    public function create(array $data)
    {
        return Bill::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Bill::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Bill::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Bill::findOrFail($id);
    }
    public function getAllByType($type){
        return Bill::where('type', $type)->get();
    }
}
