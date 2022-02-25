<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->paginate(6);
        if(request()->search){
            $search = request()->search;
            $categories = Category::where('name','LIKE',"%$search%")->paginate(6);
        }
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only('name'),
            [
                'name' => 'required|unique:category'
            ],
            [
                'name.required' => 'Vui lòng nhập tên danh mục.',
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]
        );
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
                'message' => $html,
                'errors' =>  $errors
            ]);
        }
        if($validator->passes()){
            $data = [
                'name' => $request->name,
                'status' => $request->status            
            ];
            Category::create($data);
            Session::flash('success','Thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->only('name'),
            [
                'name' => 'required|unique:category,name,'.$category->id
            ],
            [
                'name.required' => 'Vui lòng nhập tên danh mục.',
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]
        );
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
                'message' => $html,
                'errors' =>  $errors
            ]);
        }
        if($validator->passes()){
            $data = [
                'name' => $request->name,
                'status' => $request->status            
            ];
            $category->update($data);
            Session::flash('success','Cập nhật thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->products()->count() > 0){
            return response(['status' => false]);
        }else{
            $category->delete();
            return response(['status' => true]);
        }
    }

    public function trash(Request $request)
    {
        $trashs = Category::onlyTrashed()->orderBy('id','DESC')->paginate(6);
        return view('admin.category.trash',compact('trashs'));
    }

    public function restoreTrash($id)
    {
        $trash = Category::withTrashed()->find($id);
        if($trash->restore()){
            return redirect()->back()->with('success','Restored success!');
        };
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->find($id);
        if($category->forceDelete()){
            return redirect()->back()->with('success','Deleted success!');
        }
    }
}
