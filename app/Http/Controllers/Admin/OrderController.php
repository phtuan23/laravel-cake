<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('id','DESC')->paginate(4);
        if($request->from and $request->to){
            $orders = Order::whereBetween('created_at', [$request->from, $request->to])->paginate(4);
            if($request->status){
                $orders = Order::whereBetween('created_at', [$request->from, $request->to])->where('status', "=" , $request->status)->paginate(4);
            }
        }else if($request->status){
            $orders = Order::where('status', "=" , $request->status)->paginate(4);
        }else if($request->search){
            $orders = Order::where('name', "LIKE" , "%$request->search%")->orWhere('id',$request->search)->paginate(4);
        }
        return view('admin.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function trash()
    {
        return view('admin.order.trash');
    }

    public function restoreTrash()
    {
        
    }

    public function forceDelete()
    {
        
    }

    public function status(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return response(['ok']);
    }

}
