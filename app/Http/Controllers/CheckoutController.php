<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use Mail;
use Validator;
class CheckoutController extends Controller
{
    public function index(){
        $i = 1;
        return view('customer.checkout',compact('i'));
    }

    public function checkout(Request $request,Cart $cart){
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'customer_id' => Auth::guard('cus')->user()->id
        ]);
        if($order){
            $order_id = $order->id;
            foreach($cart->carts as $item){
                $order_detail = OrderDetail::create([
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
            if($order_detail){
                Mail::send('mail.order',
                [
                    'order' => $order
                ],
                function($email) use($order){
                    // create pdf file
                    $mpdf = new \Mpdf\Mpdf(['utf-8']);
                    $style = file_get_contents(public_path('main/css/pdf.css'));
                    $mpdf->WriteHTML($style,1);
                    $mpdf->WriteHTML(view('mpdf.mpdf',compact('order'))->render());
                    $mpdf->output(public_path('pdf/mypdf.pdf'),'F');
                    // send mail
                    $email->to($order->email);
                    $email->from('tuantuan230298@gmail.com');
                    $email->subject('Order Details');
                    $email->attach(public_path('pdf/mypdf.pdf'));
                });
                session(['cart'=>[]]);
                return redirect()->route('cus.index')->with('success','Đặt hàng thành công.');
            }else{
                return redirect()->back()->with('error','Đặt hàng thất bại. Vui lòng thử lại.');
            }
        }
    }
}
?>