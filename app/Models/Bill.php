<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = [
        'id_user_create',
        'id_admin_update',
        'id_cart',
        'id_transaction',
        'id_box_item',
        'id_box_event',
        'id_box',
        'status',
        'amount',
        'total',
        'name',
        'number_phone',
        'address',
        'id_info_user_bill'
    ];
}
