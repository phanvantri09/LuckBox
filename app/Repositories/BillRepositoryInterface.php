<?php
namespace App\Repositories;

interface BillRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function getAllByType($type);
     public function showByIdCart($id_cart);
     public function updateByIDCart(array $data, $id_cart);
}
