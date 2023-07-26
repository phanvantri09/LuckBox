<?php
namespace App\Repositories;

interface PageRepositoryInterface
{
     public function createCard(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function checkCard($id);
     public function changeStatus($idUser, $idCard);
     public function showCardDefault($id);
     public function getAllCardNotIn($id, $idUser);
}
