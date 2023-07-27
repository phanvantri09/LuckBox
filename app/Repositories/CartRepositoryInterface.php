<?php
namespace App\Repositories;

interface CartRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);

     public function show($id);
     public function getAllByStatus($status);
     public function getAllByIDUser($id_user);
     public function getAllByIDUserAndStatus($id_user, $status);
     public function getSumAllByStatusNoCheckout();
     public function findAndUpdate(array $data);
     public function getAllDataByIDUserAndStatus($id_user, $status);
     public function getAllDataByIDCartIDUserAndStatus($id_cart, $id_user, $status);
     public function showAllData($id_cart);
     public function getAllByStatusmartket();

}
