<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Validator;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('id', 'DESC')->paginate(3);
        if (request()->search) {
            $search = request()->search;
            $products = Product::where('name', 'LIKE', "%$search%")->paginate(3);
        } else if(request()->sort){
            $sort = request()->sort;
            if($sort=='asc'){
                $products = Product::orderBy('price','ASC')->paginate(3);
            }else if($sort=='desc'){
                $products = Product::orderBy('price','DESC')->paginate(3);
            }else if($sort=='sale'){
                $products = Product::where('sale_price','>',0)->orderBy('sale_price','DESC')->paginate(3);
            }
        }
        return view('admin.product.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only('name','price','sale_price','image','images','category_id'),
        [
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'sale_price' => 'nullable|numeric|min:1|lt:price',
            'image' => 'required|image',
            'images' => 'required',
            'images.*' => 'image',
            'category_id' => 'required'
        ],
        [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm phải lớn hơn 0',
            'sale_price.numeric' => 'Giá khuyến mãi phải là số',
            'sale_price.min' => 'Giá khuyến mãi cần lớn hơn 0',
            'sale_price.lt' => 'Giá khuyến mãi không được lớn hơn giá gốc',
            'image.required' => 'Vui lòng chọn ảnh cho sản phẩm',
            'image.image' => 'Ảnh sản phẩm không đúng định dạng.',
            'category_id.required' =>  "Vui lòng chọn danh mục sản phẩm",
            'images.required' => "Vui lòng chọn ảnh mô tả",
            'images.*.image' => "Ảnh mô tả không đúng định dạng"
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            $errors = $validator->errors()->all();
            $html = "<ul class='list-group'>";
            foreach($errors as $err){
                $html .= "<li class='list-group-item' style='list-style: none;border:none'>$err</li>";
            }
            $html .= "</ul>";
            return response([
                'status' => false,
                'icon' => 'warning',
                'message' => $html
            ]);
        }
        if($validator->passes()){
            if($request->has('image')){
                $image = $request->image->getClientOriginalName();
                $data = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'image' => $image,
                    'description' => $request->description != '' ? $request->description : "SẢN PHẨM MỚI",
                    'category_id' => $request->category_id,
                    'status' => $request->status
                ];
                $product = Product::create($data);
                if($product){
                    $images = $request->images;
                    foreach($images as $img){
                        $img->move(public_path('upload'),$img->getClientOriginalName());
                        $img_pro = [
                            'image' => $img->getClientOriginalName(),
                            'product_id' => $product->id
                        ];
                        ProductImage::create($img_pro);
                    }
                }
            }
            Session::flash('success',"Thêm mới sản phẩm thành công");
            return response([
                'status' => true,
                'url' => route('product.index')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->only('name','price','sale_price','image','images','category_id'),
        [
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'sale_price' => 'nullable|numeric|min:1|lt:price',
            'image' => 'image',
            'images.*' => 'image',
            'category_id' => 'required'
        ],
        [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm phải lớn hơn 0',
            'sale_price.numeric' => 'Giá khuyến mãi phải là số',
            'sale_price.min' => 'Giá khuyến mãi cần lớn hơn 0',
            'sale_price.lt' => 'Giá khuyến mãi không được lớn hơn giá gốc',
            'image.image' => 'Ảnh sản phẩm không đúng định dạng.',
            'category_id.required' =>  "Vui lòng chọn danh mục sản phẩm",
            'images.*.image' => "Ảnh mô tả không đúng định dạng"
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            $html = "<ul class='list-group'>";
            foreach($errors as $err){
                $html .= "<li class='list-group-item' style='list-style: none;border:none'>$err</li>";
            }
            $html .= "</ul>";
            return response([
                'status' => false,
                'icon' => 'warning',
                'message' => $html
            ]);
        }
        if($validator->passes()){
            $image = $product->image;
            if($request->has('image')){
                $image = $request->image->getClientOriginalName();
                $request->image->move(public_path('upload'),$image);
            }
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'image' => $image,
                'description' => $request->description != '' ? $request->description : "SẢN PHẨM MỚI",
                'category_id' => $request->category_id,
                'status' => $request->status
            ];
            if($product->update($data)){
                if($request->has('images')){
                    $product->image_description->each->delete();
                    $images = $request->images;
                    foreach($images as $img){
                        $img->move(public_path('upload'),$img->getClientOriginalName());
                        $img_pro = [
                            'image' => $img->getClientOriginalName(),
                            'product_id' => $product->id
                        ];
                        ProductImage::create($img_pro);
                    }             
                }
                Session::flash('success','Cập nhật sản phẩm thành công');
                return response([
                'status' => true,
                'url' => route('product.index')
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function trash(Request $request)
    {
        $trashs = Product::onlyTrashed()->orderBy('id','DESC')->paginate(6);
        if ($request->search) {
            $search = $request->search;
            $trashs = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(6);
        }
        return view('admin.product.trash',compact('trashs'));
    }

    public function restoreTrash($id)
    {
        $trash = Product::withTrashed()->find($id);
        $trash->restore();
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);
        $product->image_description->each->delete();
        $product->forceDelete();
    }
}
