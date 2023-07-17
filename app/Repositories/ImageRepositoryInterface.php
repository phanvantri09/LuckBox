<?php
namespace App\Repositories;

interface ImageRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function getAllByIDProductItem($id_product);
     public function getAllByIDProductMain($id_product);
     public function getAllByIDProductSlide($id_product);
}
