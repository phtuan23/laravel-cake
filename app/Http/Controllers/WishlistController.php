<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Auth;
class WishlistController extends Controller
{
    public function add(Request $request,Product $product){
        $customer_id = Auth::guard('cus')->user()->id;
        $check_product = Wishlist::where('customer_id',$customer_id)->where('product_id',$product->id)->get();
        if(count($check_product)==0){
            $data = [
                'product_id' => $product->id,
                'customer_id' => $customer_id
            ];
            if(Wishlist::create($data)){
                return redirect()->back()->with('success','Đã thêm vào yêu thích');
            }
        }else{
            return redirect()->back()->with('success','Sản phẩm đã tồn tại trong danh sách yêu thích');
        }
    }

    public function remove($product){
        $customer_id = Auth::guard('cus')->user()->id;
        $wishlist = Wishlist::where('product_id',$product)->where('customer_id',$customer_id)->get();
        if($wishlist->each->delete()){
            return redirect()->back()->with('success','Đã xóa khỏi danh sách yêu thích');
        }
    }
}
