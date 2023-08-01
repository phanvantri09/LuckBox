<?php
namespace App\Repositories;

interface BoxProductRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function getAllByType($type);
     public function getAllProduct($id_box);
     public function getAllProductNotInBox($id_box);
     public function getCountProductStatus($id_box);
     public function getAllByIdBoxChoese($id_box);
}
