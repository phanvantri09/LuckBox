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
    public function showByIdCart($id_cart){
        return Bill::where('id_cart', $id_cart)->first();
    }
    public function updateByIDCart(array $data, $id_cart)
    {
        $user = Bill::where('id_cart', $id_cart)->first();
        $user->update($data);
        return $user;
    }
    
}
