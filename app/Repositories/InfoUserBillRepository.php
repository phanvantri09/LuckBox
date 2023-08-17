<?php
namespace App\Repositories;

use App\Models\infoUserBill;

class InfoUserBillRepository implements InfoUserBillRepositoryInterface
{
    public function all()
    {
        return infoUserBill::all();
    }

    public function create(array $data)
    {
        return infoUserBill::create($data);
    }

    public function update(array $data, $id)
    {
        $user = infoUserBill::findOrFail($id);
        $user->update($data);
        return true;
    }

    public function delete($id)
    {
        $user = infoUserBill::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return infoUserBill::findOrFail($id);
    }

    public function getByIdUser($id_user)
    {
        return infoUserBill::where('id_user', $id_user)->get();
    }

    public function updateByIdUser($id_user)
    {
        return infoUserBill::where('id_user', $id_user)->update(['status'=> 0]);
    }
    // public function getAllByType($type){
    //     return infoUserBill::where('type', $type)->get();
    // }
}
