<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'id_user',
        'id_user_create',
        'id_user_update',
        'bank',
        'card_name',
        'card_number',
        'card_branch',
        'status',
        'image_ql_code',
        'type'
    ];
}
