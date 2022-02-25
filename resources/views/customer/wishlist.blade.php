@extends('layouts.main')
@section('title','Wishlist')
@section('main')

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Sản phẩm yêu thích</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="{{route('customer.index')}}">Trang chủ</a>
                    <span>Yêu thích</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Wishlist Section Begin -->
@if(count($wishlist)>0)
<section class="wishlist spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="wishlist__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($wishlist as $item)
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="{{url('public/upload')}}/{{$item->image}}" width="100">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$item->name}}</h6>
                                    </div>
                                </td>
                                <td class="cart__price">{{$item->sale_price > 0 ? number_format($item->sale_price) : number_format($item->price)}}</td>
                                <td class="cart__btn"><a href="{{route('cart.add',$item->id)}}" class="primary-btn">Thêm vào giỏ hàng</a></td>
                                <td class="cart__close">
                                    <a href="{{route('wishlist.remove',$item->id)}}"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@else
    <div class="container" style="padding:40px 0">
        <div class="col-md-6 m-auto text-center">
            <h4 class="font-weight-bold">Your wishlist is empty!</h4>
            <br>
            <a href="{{route('cus.index')}}" class="btn btn-sm bg-dark text-light">Back to home!</a>
        </div>
    </div>
@endif
@endsection