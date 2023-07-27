<?php
namespace App\Repositories;

interface TransactionRepositoryInterface
{
     public function create(array $data);
     public function all();

     public function changeStatus($id,$idUser,$type, $status);
     public function update(array $data, $id);
}
