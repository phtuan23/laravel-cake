<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'password' => 'required'
            ],
            [
                'name.required' => 'Vui lòng nhập tên tài khoản',
                'password.required' => 'vui lòng nhập mật khẩu'
            ]
        );
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
            $admin = [
                'name' => $request->name,
                'password' => $request->password
            ];
            $remember = $request->has('remember');
            $check = Auth::attempt($admin,$remember);
            if($check){
                Session::flash('login_success','xin chào '.$request->name);
                return response([
                    'status' => true,
                    'url' => route('admin.index')
                ]);
            }else{
                return response([
                    'status' => false,
                    'title' => 'Đăng nhập thất bại',
                    'icon' => 'warning',
                    'message' => 'Tài khoản hoặc mật khẩu không đúng'
                ]);
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
