<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = ['order_id','product_id','quantity','price'];

    public function products(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
