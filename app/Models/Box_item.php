<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Box_event;
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
        'price',
        'order_number',
        'time_start',
        'time_end'
    ];
    public function boxEvent()
    {
        return $this->belongsTo(Box_event::class, 'id_box_event');
    }
}
