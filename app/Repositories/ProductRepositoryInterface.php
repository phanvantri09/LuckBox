<?php
namespace App\Repositories;

interface ProductRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function getByArrayID($array);
     public function getImageSlide($array);
}
