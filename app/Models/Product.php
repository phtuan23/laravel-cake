<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'product';
    protected $dates = ['delete_at'];
    protected $fillable = ['name','price','image','sale_price','description','category_id','status'];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function image_description(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
