<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Box_event;
use App\Models\Box;
class Box_item extends Model
{
    use HasFactory;
    protected $table = 'box_items';
    protected $fillable = [
        'id_user_create',
        'id_user_update',
        'id_box_event',
        'id_box',
        'link_image',
        'status',
        'amount',
        'order_number',
        'time_start',
        'time_end'
    ];
    public function boxEvent()
    {
        return $this->hasMany(Box_event::class, 'id', 'id_box_event');
    }
    public function box()
    {
        return $this->hasOne(Box::class, 'id', 'id_box');
    }
    public function boxInfo()
    {
        return $this->belongsTo(Box::class, 'id_box');
    }
}
