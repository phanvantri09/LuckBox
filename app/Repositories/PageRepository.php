<?php
namespace App\Repositories;

use App\Helpers\ConstCommon;
use App\Models\Card;

class PageRepository implements PageRepositoryInterface
{
    public function createCard(array $data)
    {
        return Card::create($data);
    }

    public function update(array $data, $id)
    {
        $card = Card::findOrFail($id);
        $card->update($data);
        return $card;
    }

    public function delete($id)
    {
        $user = Card::findOrFail($id);
        $user->delete();
    }
    public function checkCard($id)
    {   
        return Card::where('id_user', $id)->first();
    }
    public function showCardDefault($id)
    {   
        return Card::where('id_user', $id)->where('status','=','1')->first();
    }
    public function getAllCardNotIn($id)
    {
        return Card::whereNotIn('id',$id)->get();
    }
    public function changeStatus($idUser, $idCard)
    { 
        $getCard = Card::where('id_user', $idUser)->where('status','=','1')->get();
        foreach ($getCard as $card) {
            $card->status = 0;
            $card->save();
        }
        $getCardUpdateStatus = Card::find($idCard);
        if($getCardUpdateStatus){
            $getCardUpdateStatus->status = 1;
            $getCardUpdateStatus->save();
        }  
    }
}
