<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Box_item;
use App\Models\Product;
class Box_event extends Model
{
    use HasFactory;
    protected $table = 'box_events';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'id_category',
        'description',
        'link_image',
        'status',
        'time_start',
        'time_end',
        'title',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'id_category');
    }
    public function boxItem()
    {
        return $this->hasMany(Box_item::class, 'id_box_event', 'id');
    }
}
