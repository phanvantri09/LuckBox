<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'id',
        'id_user',
        'id_admin_accept',
        'type',
        'total',
        'bank',
        'card_name',
        'card_number',
        'transaction_content',
        'status', 
        'id_cart'
    ];
    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
