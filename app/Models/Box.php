<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    
    protected $table = 'box';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'id_category',
        'title',
        'description',
        'link_image',
    ];
}
