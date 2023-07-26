<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $table = 'user_infos';

    protected $fillable = [
        'id_user',
        'name',
        'content',
        'birthdate',
        'number_phone',
        'house_number_street',
        'neighborhood_village',
        'district',
        'province_city',
        'country',
        'link_image',
    ];
    public function User(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
