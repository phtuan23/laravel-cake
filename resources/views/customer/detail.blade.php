@extends('layouts.main')
@section('title','Detail')
@section('main')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>{{$product->name}}</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="{{route('cus.index')}}">Trang chủ</a>
                    <a href="{{route('cus.shop')}}">Cửa hàng</a>
                    <span>{{$product->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__img">
                    <div class="product__details__big__img">
                        <img class="big_img" src="{{url('public/upload')}}/{{$product->image}}" alt="" id="mainImg">
                    </div>
                    <div class="product__details__thumb">
                        @foreach($product->image_description as $img_dsc)
                        <div class="pt__item">
                            <img src="{{url('public/upload')}}/{{$img_dsc->image}}" class="img" id="img-{{$img_dsc->id}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <div class="product__label">{{$product->category->name}}</div>
                    <h4>{{$product->name}}</h4>
                    <h5>{{$product->sale_price>0?number_format($product->sale_price):number_format($product->price)}} đ</h5>
                    <p>{!!$product->description!!}</p>
                    <ul>
                        <li>Danh mục: <span>{{$product->category->name}}</span></li>
                    </ul>
                    <div class="product__details__option">
                        <form action="{{route('cart.add',$product->id)}}" id="form-quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" value="1" id="quantity">
                                </div>
                            </div>
                            <button href="{{route('cart.add',$product->id)}}" class="primary-btn btn btn-sm ml-3 btn-add-cart">Thêm vào giỏ hàng</button>
                            @if(auth()->guard('cus')->check())
                            <a href="{{route('wishlist.add',$product->id)}}" class="heart__btn btn btn-sm"><span class="icon_heart_alt"></span></a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__tab">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Bình luận sản phẩm({{count($comment)}})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                            <br>
                            @if(auth()->guard('cus')->check())
                            <form action="" method="post">
                            @csrf
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{url('public/upload')}}/{{auth()->guard('cus')->user()->avatar}}" width="40">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="comment" id="comment" placeholder="Comment">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @else
                                <h5 class="text-center">Đăng nhập để bình luận!</h5>
                            @endif
                            <br>
                            @foreach($comment as $cmt)
                                <div class="media">
                                    <img class="mr-3" src="{{url('public/upload')}}/{{$cmt->avatar}}" alt="Generic placeholder image" width="40">
                                    <div class="media-body">
                                    <span class="float-right"><i class="fas fa-clock"></i>{{$cmt->created_at}}</span>
                                        <h5 class="mt-0">{{$cmt->name}}</h5>
                                        {{$cmt->content}}
                                    </div>
                                </div>
                                <br>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Products Section Begin -->
<section class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="related__products__slider owl-carousel">
                @foreach($relate_product as $item)
                <div class="col-lg-3">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/upload')}}/{{$item->image}}">
                            <div class="product__label">
                                <span>{{$item->category->name}}</span>
                            </div>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{route('cus.detail',$item->id)}}">{{$item->name}}</a></h6>
                            <div class="product__item__price">{{$item->sale_price>0?number_format($product->sale_price):number_format($product->price)}} đ</div>
                            <div class="cart_add">
                                <a href="{{route('cart.add',$item->id)}}" class="btn-add-cart">Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<script src="{{url('public/main')}}/js/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.img').click(function(){
            var id = $(this).attr('id');
            var img = document.getElementById(id);
            var src = $(img).attr('src');
            $('#mainImg').attr('src',src);    
        });

        
        $(".btn-add-cart").click(function(e){
            e.preventDefault();
            var quantity = parseInt($("#quantity").val());
            var href = $(this).attr("href");
            if(quantity == 0){
                Swal.fire({
                    icon : 'warning',
                    html : 'Số lượng phải lớn hơn 0'
                });
                $("#quantity").val(1);
            }else if(isNaN(quantity)){
                Swal.fire({
                    icon : 'warning',
                    html : 'Số lượng phải là số'
                });
                $("#quantity").val(1);
            }else{
                $.ajax({
                    url : href + "?quantity=" + quantity,
                    type : 'GET',
                    success : function(res){
                        console.log(res);
                        if(res.status==false){
                            Swal.fire({
                                icon : res.icon,
                                html : res.message
                            });
                            $("#quantity").val(1);
                        }else{
                            $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                            Swal.fire({
                                icon : 'success',
                                html : 'Đã thêm vào giỏ hàng'
                            });
                        }
                    }
                })
            }
        });
    });
    
</script>
@stop()