<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'image_product';
    protected $fillable = ['product_id','image'];

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
