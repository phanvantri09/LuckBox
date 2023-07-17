<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'id_category',
        'id_user_create',
        'id_user_update',
        'title',
        'amount',
        'price',
        'description',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'id_category');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'id_product');
    }
}
