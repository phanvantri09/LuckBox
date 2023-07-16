<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'description',
        'type',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_category', 'id');
    }
}
