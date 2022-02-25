<?php

namespace App\Http\Controllers;
use App\Helper\Cart;
use App\Models\Product;
use App\Models\Wishlist;
class CartController extends Controller
{
    public function index(){
        return view('customer.cart');
    }

    public function add(Cart $cart, Product $product){
        $cart->add($product);
        $wishlist = Wishlist::where('product_id', $product->id)->get();
        if($wishlist){
            $wishlist->each->delete();
        }
        if(request()->quantity){
            $quantity = request()->quantity;
            if(is_numeric($quantity)){
                if($quantity < 0){
                    return response([
                        'status' => false,
                        'message' => 'Số lượng phải lớn hơn 0',
                        'icon' => 'warning'
                    ]);
                }
                $cart->add($product,$quantity-1);
            }else{
                return response([
                    'status' => false,
                    'message' => 'Số lượng phải là số',
                    'icon' => 'warning'
                ]);
            }
        }
        return response([
            'status' => true
        ]);
    }

    public function delete(Cart $cart,$id){
        $cart->delete($id);
    }

    public function clear(Cart $cart){
        $cart->clear();
    }

    public function update(Cart $cart,$id){
        $quantity = request()->quantity[0] ? request()->quantity[0] : 1;
        if(is_numeric($quantity)){
            if($quantity < 0){
                return response([
                    'status' => false,
                    'message' => 'Số lượng phải lớn hơn 0',
                    'icon' => 'warning'
                ]);
            }
            $cart->updateOne($id,$quantity);
            return response([
                'status' => true
            ]);
        }else{
            return response([
                'status' => false,
                'icon' => 'warning',
                'message' => 'Số lượng phải là số'
            ]);
        }
    }

    public function updateAjax(Cart $cart){
        $quantity = request()->quantity ? request()->quantity : 1;
        $cart->update(request()->id,request()->quantity);
    }
}
