<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $table = 'box';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'id_category',
        'title',
        'description',
        'link_image',
        'amount',
        'price',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'id_category');
    }

    public function userCreated()
    {
        return $this->belongsTo(User::class, 'id_user_create');
    }

    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'id_user_update');
    }

    public function boxProducts()
    {
        return $this->hasMany(Box_product::class, 'id_box');
    }
    public function boxItem()
    {
        return $this->belongsTo(Box_item::class, 'id');
    }
}
