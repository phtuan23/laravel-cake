<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\OrderDetail;
use App\Rules\CheckPassword;
use Mail;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

Class CustomerController extends Controller{

    public function wishlist(){
        $customer_id = Auth::guard('cus')->user()->id;
        $wishlist =  Wishlist::where('customer_id',$customer_id)->join('product','product.id','=','wishlist.product_id')->get();
        return view('customer.wishlist',compact('wishlist'));
    }

    public function profile(){
        $customer = auth()->guard('cus')->user();
        $history = Order::where('customer_id',$customer->id)->orderBy('id','DESC')->paginate(6);
        $orderDetail = OrderDetail::all();
        return view('customer.profile',compact('customer','history','orderDetail'));
    }

    public function login(){
        return view('customer.login');
    }

    public function sign_in(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống!'
        ]);
        $customer = $request->only('email','password');
        $remember = $request->remember;
        $check = Auth::guard('cus')->attempt($customer, $remember);
        if($check){
            return redirect()->route('cus.index')->with('success','Xin chào '.$request->email);
        }
        return redirect()->back()->with('error','Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(){
        Auth::guard('cus')->logout();
        return redirect()->route('cus.index');
    }

    public function register(){
        return view('customer.register');
    }

    public function post_register(Request $request){
        $request->validate([
            'name' => 'required|string|between:3,100',
            'email' => 'required|email|max:200|unique:customer',
            'password' => 'required|min:6'
        ]);
        $customer = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender
        ];
        if(Customer::create($customer)){
            return redirect()->route('cus.login')->with('success','Register Success');
        }
        return redirect()->back()->with('error','Register Failed. Please try again');
    }
    
    public function update(Request $request, Customer $customer){
        $validator = Validator::make(
            $request->only('name','email','phone','address','gender'),
            [
                'name' => 'required|string|between:3,100',
                'email' => 'required|email|max:200|unique:customer,email,'.$customer->id,
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
                'message' => $html
            ]);
        }
        if($validator->passes()){
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender
            ];
            $customer->update($data);
            return response([
                'status' => true
            ]);
        }
    }

    public function update_password(Request $request, Customer $customer){
        $validator = Validator::make(
            $request->only('password','cr_password','cf_password'),
            [
                'password' => 'required|between:3,100',
                'cr_password' => ['required',new CheckPassword],
                'cf_password' => 'required|same:password'
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
                'message' => $html
            ]);
        }
        if($validator->passes()){
            $data = [
                'password' => bcrypt($request->password)
            ];
            $customer->update($data);
            Session::flash('success','Đổi mật khẩu thành công');
            return response([
                'status' => true,
                'url' => route('cus.profile')
            ]);
        }
    }

    public function upload_avatar(Request $request, Customer $customer)
    {
        $validator = Validator::make(
            $request->only('image'),
            [
                'image' => 'image'
            ],
            [
                'image.image' => 'Image is not a valid image'
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
                'message' => $html
            ]);
        }
        if($validator->passes()){
            $file = $request->image;
            $avatar = $file->getClientOriginalName();
            $file->move(public_path('upload'),$avatar);
            $data = [
                'avatar' => $avatar
            ];
            $customer->update($data);
            return response([
                'status' => true
            ]);
        }
    }

    public function form_password(){
        $customer = auth()->guard('cus')->user();
        return view('customer.password',compact('customer'));
    }

    public function form_check_email(){
        return view('customer.reset-password');
    }

    public function submit_form_check_email(Request $request){
        $email = $request->email;
        $customer = Customer::where('email',$email)->first();
        if($customer){
            $token = Str::random(30);
            $customer->update(['token' => $token]);
            $_token = $customer->token;
            Mail::send('mail.reset-password',compact('customer','_token'),function($mail) use($email){
                $mail->to($email);
                $mail->from('tuantuan230298@gmail.com');
                $mail->subject('Confirmation Required');
            });
            return redirect()->back()->with('success','Please check your email and confirm required');
        }
    }

    public function confirm_email($token){
        $customer = Customer::where('token',$token)->first();
        if($customer){
            return view('customer.form-reset-password');
        }else{
            return view('customer.reset-password')->with('error','Can not find email address.');
        }
    }

    public function submit_password(Request $request,$token){
        $customer = Customer::where('token',$token)->first();
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);
        $data = [
            'password' => bcrypt($request->password)
        ];
        if($customer->update($data)){
            $customer->update(['token' => null]);
            return redirect()->route('cus.login')->with('success','Change password successfully. Please login here!');
        }else{
            return redirect()->back()->with('error','Password change failed');
        }
    }

    public function pdf(Order $order){
        $mpdf = new \Mpdf\Mpdf();
        $style = file_get_contents(public_path('main/css/pdf.css'));
        $mpdf->WriteHTML($style,1);
        $mpdf->WriteHTML(view('mpdf.mpdf',compact('order'))->render());
        $mpdf->output();
    }
}
?>