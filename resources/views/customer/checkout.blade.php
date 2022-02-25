@extends('layouts.main')
@section('title','Checkout')
@section('main')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Đặt hàng</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="{{route('cus.index')}}">Trang chủ</a>
                    <span>Đặt hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="" method="post" id="form-orders">
            @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Chi tiết đơn hàng</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>TÊN KHÁCH HÀNG<span>*</span></p>
                                    <input type="text" name="name" value="{{auth()->guard('cus')->user()->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>EMAIL KHÁCH HÀNG<span>*</span></p>
                                    <input type="text" name="email" value="{{auth()->guard('cus')->user()->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>SỐ ĐIỆN THOẠI<span>*</span></p>
                                    <input type="text" name="phone" value="{{auth()->guard('cus')->user()->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>ĐỊA CHỈ<span>*</span></p>
                                    <input type="text" name="address" value="{{auth()->guard('cus')->user()->address}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h6 class="order__title">Đơn đặt của bạn</h6>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                            <ul class="checkout__total__products">
                                @foreach($cart->carts as $item)
                                    <li><samp>{{$i++}}.</samp> {{$item['name']}} x {{$item['quantity']}}<span> {{number_format($item['quantity']*$item['price'])}} vnđ</span></li>
                                @endforeach
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Tổng tiền <span>{{number_format($cart->total_price)}} vnđ</span></li>
                            </ul>
                            <button type="submit" class="site-btn btn-orders">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection