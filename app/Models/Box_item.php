<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box_item extends Model
{
    use HasFactory;
    protected $table = 'box_items';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'link_image',
        'status',
        'amount',
        'price',
        'order_number',
        'time_start', 
        'time_end'
    ];
}
