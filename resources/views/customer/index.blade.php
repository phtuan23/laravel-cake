@extends('layouts.main')
@section('title','Home')
@section('main')
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__item set-bg" data-setbg="{{url('public/main')}}/img/hero/hero-1.jpg">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="hero__text">
                            <h2>Làm cho cuộc sống của bạn ngọt ngào hơn.</h2>
                            <a href="{{route('cus.shop')}}" class="primary-btn">Sản phẩm của chúng tôi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($cats as $cat)
                <div class="categories__item">
                    <div class="categories__item__icon">
                        <span class="flaticon-029-cupcake-3"></span>
                        <h5><a href="{{route('cus.shop')}}?category={{$cat->id}}" style="color:#f08632">{{$cat->name}}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="about__text text-center">
            <div class="section-title">
                <span class="font-weight-bold">Sản phẩm mới</span>
            </div>
        </div>
        <div class="row">
            @foreach($news as $new)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{url('public/upload')}}/{{$new->image}}">
                        <div class="product__label">
                            <span>{{$new->category->name}}</span>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{route('cus.detail',$new->id)}}">{{$new->name}}</a></h6>
                        <div class="product__item__price">{{$new->sale_price > 0 ? number_format($new->sale_price)  : number_format($new->price)}} đ</div>
                        <div class="cart_add">
                            <a href="{{route('cart.add',$new->id)}}" id="add-to-cart">Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 p-0">
                <div class="instagram__text">
                    <div class="section-title">
                        <span>THEO DÕI CHÚNG TÔI TRÊN INSTAGRAM</span>
                        <h2>Những khoảnh khắc ngọt ngào được lưu lại thành kỉ niệm.</h2>
                    </div>
                    <h5><i class="fa fa-instagram"></i> @sweetcake</h5>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="instagram__pic">
                            <img src="{{url('public/main')}}/img/instagram/instagram-1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="instagram__pic middle__pic">
                            <img src="{{url('public/main')}}/img/instagram/instagram-2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="instagram__pic">
                            <img src="{{url('public/main')}}/img/instagram/instagram-3.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="instagram__pic">
                            <img src="{{url('public/main')}}/img/instagram/instagram-4.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="instagram__pic middle__pic">
                            <img src="{{url('public/main')}}/img/instagram/instagram-5.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="instagram__pic">
                            <img src="{{url('public/main')}}/img/instagram/instagram-3.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop()

@section('js')
<script>
    $(document).ready(function() {
        $(document).on("click", "#add-to-cart", function(e) {
            e.preventDefault();
            var href = $(this).attr("href");
            $.ajax({
                url: href,
                type: "GET",
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            icon: 'success',
                            html: "Đã thêm vào giỏ hàng"
                        });
                        $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                    }
                }
            });
        });
    });
</script>
@endsection