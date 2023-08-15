<?php
namespace App\Repositories;

interface InfoUserBillRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function getByIdUser($id_user);
    //  public function getAllByType($type);
}
