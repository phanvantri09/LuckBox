<?php
namespace App\Repositories;

use App\Helpers\ConstCommon;
use App\Models\Card;

class CardRepository implements CardRepositoryInterface
{
    public function allAdmin()
    {
        return Card::where('type', '<>', ConstCommon::TypeUser)
            ->orderBy('status', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function allUser()
    {
        return Card::where('type', ConstCommon::TypeUser)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function create(array $data)
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
        return $user->delete();
    }

    public function show($id)
    {
        return Card::findOrFail($id);
    }
    public function choese(){
        return Card::whereIn('type', [222, 333])->where('status',1)->first();
    }
}
