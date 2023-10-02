<?php
namespace App\Repositories;

interface BoxItemRepositoryInterface
{
     public function all();
     public function create(array $data);
     public function update(array $data, $id);
     public function delete($id);
     public function show($id);
     public function showInCart($id);
     // public function getAllByType($type);
     public function getByIDBoxEvent($id, $time);
     public function getAllByIdEvent($id);
     public function changeStatus($id, $status);
     public function getByIDBoxEventTimeThan($event, $time);
     public function checkAndAutoUpdateStatus($id_event, $time);
     public function getFirstInCaseEventEmpty($id);
     public function getFirstInCaseEventHasData($id);
     public function updateAmount($id, $amount);
     public function getAllBox_itemBYIDEvent($id);

}
