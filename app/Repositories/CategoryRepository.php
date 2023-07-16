<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Category::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Category::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }
    public function getAllByType($type){
        return Category::where('type', $type)->get();
    }
}
