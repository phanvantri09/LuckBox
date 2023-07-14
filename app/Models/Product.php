<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
