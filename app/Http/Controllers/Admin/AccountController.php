<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $accounts = Account::orderBy('id','DESC')->paginate(3);
        if(request()->search){
            $search = request()->search;
            $accounts = Account::where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->paginate(3);
        }
        return view('admin.account.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->only('name', 'email', 'password','cf_password'),
            [
                'name' => 'required|min:5|unique:account',
                'email' => 'required|email|unique:account',
                'password' => 'required|min:6',
                'cf_password' => 'required|same:password'
            ],
            [
                'name.required' => 'Vui lòng nhập tên tài khoản',
                'name.min' => 'Tên tài khoản tối thiểu 6 ký tự',
                'name.unique' => 'Tên tài khoản đã tồn tại',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Địa chỉ email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'cf_password.required' => 'Vui lòng xác nhận mật khẩu',
                'cf_password.same' => 'Mật khẩu xác nhận không đúng'
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
                'title' => 'Thêm mới thất bại',
                'icon' => 'warning',
                'message' => $html
            ]);
        }
        if($validator->passes()){
            $account = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ];
            Account::create($account);
            Session::flash('success','Thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('admin.account.edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $validator = Validator::make(
            $request->only('name', 'email', 'password','cf_password'),
            [
                'name' => 'required|min:5|unique:account,name,'.$account->id,
                'email' => 'required|email|unique:account,email,'.$account->id,
                'password' => 'required|min:6',
                'cf_password' => 'required|same:password'
            ],
            [
                'name.required' => 'Vui lòng nhập tên tài khoản',
                'name.min' => 'Tên tài khoản tối thiểu 6 ký tự',
                'name.unique' => 'Tên tài khoản đã tồn tại',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Địa chỉ email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'cf_password.required' => 'Vui lòng xác nhận mật khẩu',
                'cf_password.same' => 'Mật khẩu xác nhận không đúng'
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
                'title' => 'Cập nhật thất bại',
                'icon' => 'warning',
                'message' => $html
            ]);
        }
        if($validator->passes()){
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ];
            $account->update($data);
            Session::flash('success','Cập nhật thành công');
        }
    }

    public function remove(Account $account){
        $account->delete();
        return response([
            'status' => true
        ]);
    }
}
