<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folow extends Model
{
    use HasFactory;
    protected $table = 'folows';
    protected $fillable = [
        'id_user',
        'id_box_event',
        'id_box',
        'id_box_item',
        'id_cart',
    ];
}
