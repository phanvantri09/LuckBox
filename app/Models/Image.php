<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Image extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $fillable = [
        'id_product',
        'link_image',
        'description',
        'type',
        'is_slide',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
