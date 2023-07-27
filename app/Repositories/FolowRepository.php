<?php
namespace App\Repositories;

use App\Models\Folow;

class FolowRepository implements FolowRepositoryInterface
{
    public function all()
    {
        return Folow::all();
    }

    public function create(array $data)
    {
        return Folow::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Folow::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Folow::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Folow::findOrFail($id);
    }

}
