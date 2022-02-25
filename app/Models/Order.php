<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['name','email','status','phone','address','customer_id'];

    public function order_detail(){
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
