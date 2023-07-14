<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box_event extends Model
{
    use HasFactory;
    protected $table = 'box_events';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'description',
        'link_image',
        'status',
        'time_start', 
        'time_end',
        'title',
    ];
}
