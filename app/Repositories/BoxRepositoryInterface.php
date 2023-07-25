<?php
namespace App\Repositories;

interface BoxRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function getAllByType($type);
     public function boxItemForEventRepository($id);

}
