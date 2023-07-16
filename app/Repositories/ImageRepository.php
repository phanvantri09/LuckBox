<?php
namespace App\Repositories;

use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
    public function all()
    {
        return Image::with('category')->get();
    }

    public function create(array $data)
    {
        return Image::create($data);
    }

    public function update(array $data, $id)
    {
        $user = Image::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = Image::findOrFail($id);
        $user->delete();
    }

    public function show($id)
    {
        return Image::findOrFail($id);
    }
}
