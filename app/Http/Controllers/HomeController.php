<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index(){
        $cats = Category::all();
        $news = Product::limit(8)->orderBy('id','DESC')->get();
        return view('customer.index',compact('cats','news'));
    }

    public function shop(Request $request){
        $cats = Category::all();
        $products = Product::paginate(8);
        if($request->search){
            $search = $request->search;
            $products = Product::where('name','LIKE','%'.$search.'%')->paginate(8);
        }else if($request->category){
            $category = $request->category;
            $products = Product::where('category_id',$category)->paginate(8);
        }else if($request->sort){
            $sort = $request->sort;
            if($sort=='desc'){
                $products = Product::orderBy('price','DESC')->paginate(8);
            }else if($sort=='asc'){
                $products = Product::orderBy('price','ASC')->paginate(8);
            }else if($sort=='sale'){
                $products = Product::where('sale_price','>' , 0)->paginate(8);
            }
        }
        return view('customer.shop',compact('cats','products'));
    }

    public function contact(){
        return view('customer.contact');
    }

    public function about(){
        return view('customer.about');
    }

    public function blog(){
        return view('customer.blog');
    }

    public function cart(){
        return view('customer.cart');
    }

    public function detail(Product $product){
        $cat_id = $product->category_id;
        $relate_product = Product::where('category_id',$cat_id)->get();
        $comment = Comment::where('product_id',$product->id)->join('customer','.customer.id','=','comment.customer_id')->get();
        return view('customer.detail',compact('product','relate_product','comment'));
    }

    public function comment(Request $request , Product $product){
        $data = [
            'customer_id' => Auth::guard('cus')->user()->id,
            'product_id' => $product->id,
            'content' => $request->comment
        ];
        if(Comment::create($data)){
            return redirect()->back();        
        }
    }


    
    public function search(){
        $search = request()->search;
        $products = Product::where('name','LIKE',"%$search%")->get();
        $row = [];
        if(count($products)>0){
            foreach($products as $prod){
                $href = "http://localhost/cake/detail/$prod->id";
                $src = "http://localhost/cake/public/upload/$prod->image";
                $row[] = "<a href='$href' class='list-group-item list-group-item-action border-1 item-result'><img src='$src' width='40'>".' '.' '.$prod->name."</a>";
            }
            return $row;
        }
    }
}
