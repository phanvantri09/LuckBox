<?php
namespace App\Repositories;

interface TransactionRepositoryInterface
{
     public function create(array $data);
     public function all();

     public function changeStatus($id,$idUser,$type, $status);
     public function update(array $data, $id);
     public function listForUser($id_user);
     public function getByStatus($type);
     public function getByIDCart($id_cart, $id_user);
     public function getAll($id_cart);
     public function delete($id);
}
