@extends('layouts.main')
@section('title','Giỏ hàng')
@section('main')


<div id="main-cart">
    @if(count($cart->carts) > 0)
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{route('customer.index')}}">Trang chủ</a>
                        <span><i class="fa fa-shopping-cart"></i> Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row" >
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table >
                            <thead>
                                <tr>
                                    <th>SẢN PHẨM</th>
                                    <th width="250" class="">SỐ LƯỢNG</th>
                                    <th>TỔNG</th>
                                    <th><a href="{{route('cart.clear')}}" class="btn btn-sm btn-dark btn-clear">X</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart->carts as $item)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{url('public/upload')}}/{{$item['image']}}" width="100">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$item['name']}}</h6>
                                            <h5>{{number_format($item['price'])}}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <form action="{{route('cart.update',$item['id'])}}" id="formUpdate-{{$item['id']}}">
                                        @csrf
                                            <button type="button" class="btn btn-sm text-white btn-down" style="background:#f08632;border-color:#f08632">-</button>
                                            <input type="text" name="quantity[]" id="{{$item['id']}}" class="quantity text-center" value="{{$item['quantity']}}" style="width:70px;border-color:#fff">
                                            <button type="button" class="btn btn-sm text-white btn-up" style="background:#f08632;border-color:#f08632">+</button>
                                            <input type="hidden" name="id[]" value="{{$item['id']}}" class="qty">
                                            <button class="btn btn-sm btn-success btn-update" style="background:#f08632;border-color:#f08632"><i class="fa fa-check"></i></button>
                                        </form>
                                    </td>
                                    <td class="cart__price">{{number_format($item['quantity']*$item['price'])}}</td>
                                    <td class="cart__close"><a href="{{route('cart.delete',$item['id'])}}" class="btn-delete"><span class="icon_close" style="background-color:#fff"></span></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{route('cus.shop')}}" id="shop">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a class="btn" id='update_all'><i class="fa fa-spinner"></i>Cập nhật giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Tổng tiền</h6>
                        <ul>
                            <li>Tổng tiền <span>{{number_format($cart->total_price)}} đ</span></li>
                            <li>Thanh toán <span>{{number_format($cart->total_price)}} đ</span></li>
                        </ul>
                        <a href="{{route('cus.checkout')}}" class="primary-btn">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <div class="text-center p-5">
        <h4>Giỏ hàng của bạn đang trống!!</h4>
        <br>
        <a href="{{route('cus.shop')}}" class="mt-4" style="color:#f08632">Mua hàng</a>
    </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function(){
        // update all
        $(document).on('click','#update_all' ,function(e){
            var id = [];
            var quantity = [];

            $('input[name="id[]"]').each(function() {
                id.push(($(this).val()));
            });

            $('input[name="quantity[]"]').each(function() {
                quantity.push(($(this).val()));
            });

            $.ajax({
                url : "{{route('cart.updateAjax')}}",
                type : 'post',
                data : {
                    id : id,
                    quantity : quantity,
                    _token : "{{csrf_token()}}"
                },
                success : function(res){
                    $('#main-cart').load(location.href + ' #main-cart>*');
                    $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                }
            });
        });

        // GIẢM SỐ LƯỢNG
        $(document).on('click',".btn-down",function(e){
            e.preventDefault();
            var quantity = $(this).closest('form').find('.quantity').val();
            $(this).closest('form').find('.quantity').val(quantity-1);
            if(quantity==1){
                $(this).closest('form').find('.quantity').val(1);
            }
            var data = $(this).closest('form').serialize();
            var url = $(this).closest('form').attr('action');
            $.ajax({
                url : url + "?" + data,
                type : 'GET',
                success : function(res){
                    $('#main-cart').load(location.href + ' #main-cart>*');
                    $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                }
            })
        });

        // TĂNG SỐ LƯỢNG
        $(document).on('click',".btn-up",function(e){
            e.preventDefault();
            var quantity = parseInt($(this).closest('form').find('.quantity').val());
            $(this).closest('form').find('.quantity').val(quantity+1);
            var data = $(this).closest('form').serialize();
            var url = $(this).closest('form').attr('action');
            $.ajax({
                url : url + "?" + data,
                type : 'GET',
                success : function(res){
                    $('#main-cart').load(location.href + ' #main-cart>*');
                    $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                }
            })
        });

        // cập nhật số lượng
        $(document).on('click','.btn-update', function(e){
            e.preventDefault();
            var quantity = $(this).closest('form').find('.quantity').val();
            var url = $(this).closest('form').attr('action');
            var data = $(this).closest('form').serialize();
            if(quantity==0){
                Swal.fire({
                    icon : 'warning',
                    html : 'Số lượng phải lớn hơn 0'
                })
                $(this).closest('form').find('.quantity').val(1);
            }else{
                $.ajax({
                    url : url + "?" + data,
                    type : 'GET',
                    success: function(res){
                        if(res.status==false){
                            Swal.fire({
                                icon : res.icon,
                                html : res.message
                            });
                        }
                        $('#main-cart').load(location.href + ' #main-cart>*');
                        $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                    }
                });
            }
            
            
        });

        // xóa sản phẩm trong giỏ hàng
        $(document).on('click','.btn-delete',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url : href,
                type : 'GET',
                success : function(res){
                    $('#main-cart').load(location.href + ' #main-cart>*');
                    $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                }
            });
        });

        // xóa tất cả
        $(document).on('click','.btn-clear',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url : href,
                type : 'GET',
                success : function(res){
                    $('#main-cart').load(location.href + ' #main-cart>*');
                    $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                }
            })
        })
    })

</script>
@stop()