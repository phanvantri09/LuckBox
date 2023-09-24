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
    public function showByIdCartInfo($id_cart){
        return Bill::leftJoin('info_user_bills', 'info_user_bills.id', 'bills.id_info_user_bill')
        ->select('bills.*', 'info_user_bills.name', 'info_user_bills.number_phone', 'info_user_bills.address')
        ->where('id_cart', $id_cart)
        ->first();
    }
    public function updateByIDCart(array $data, $id_cart)
    {
        $user = Bill::where('id_cart', $id_cart)->first();
        $user->update($data);
        return $user;
    }

    public function listBillFail()
    {
        $user = Bill::where('amount', '<=', 0)->get();
        return $user;
    }
    public function deleteBillfail()
    {
        // Bill::where('amount', '<=', 0)->delete()
        return Bill::where('amount', '<=', 0)->update(['status' => 6]);
    }
}
