<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function createInfo(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function edit($id);
     public function getUserByType(int $type);
     public function checkInfoUser($id);
     public function updateInfoUser(array $data, $id);
     public function find($id);
     public function findUserByCode($code);
     public function listGT($id);
     public function getUserByTypeGT();
     public function checkByEmail($email);
     public function checkByNumberPhone($numberPhone);
     public function showUpdate($id);
}

