<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box_product extends Model
{
    use HasFactory;
    protected $table = 'box_products';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'id_box',
        'id_product',
        'status',
        'time_start',
        'time_end'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function box()
    {
        return $this->belongsTo(Box::class, 'id_box');
    }
}
