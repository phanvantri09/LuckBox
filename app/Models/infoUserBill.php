<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoUserBill extends Model
{
    use HasFactory;

    protected $table = 'info_user_bills';

    protected $fillable = [
        'id_user',
        'status',
        'name',
        'number_phone',
        'address',
    ];
}
