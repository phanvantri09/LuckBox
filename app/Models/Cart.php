<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'id_user_create',
        'id_admin_update',
        'id_box_event',
        'id_folow',
        'id_cart_old',
        'id_box',
        'id_box_item',
        'status',
        'amount',
        'price_cart',
        'order_number',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_create', 'id');
    }
}
