@extends('layouts.main')
@section('title','Cửa hàng')
@section('main')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Cửa hàng</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="{{route('cus.index')}}">Trang chủ</a>
                    <span>Cửa hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="shop__option">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="shop__option__search">
                        <form action="#">
                            <input type="text" placeholder="Tìm kiếm..." name="search" value="{{request()->search}}" autocomplete="off">
                            <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="shop__option__right">
                        <select id="category">
                            <option href="{{route('cus.shop')}}">Danh mục</option>
                            @foreach($cats as $cat)
                                <option value="{{$cat->id}}" class="category" href="{{route('cus.category',['id'=>$cat->id,'slug'=>$cat->name])}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <select id="sort">
                            <option value="">Sắp xếp</option>
                            <option value="desc">Giá từ cao đến thấp</option>
                            <option value="asc">Giá từ thấp đến cao</option>
                            <option value="sale">Đang giảm giá</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="products">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product__item">
                        <div class="product__item__pic set-bg">
                            <img src="{{url('public/upload')}}/{{$product->image}}">
                            <div class="product__label">
                                <span>{{$product->category->name}}</span>
                            </div>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{route('cus.detail',$product->id)}}">{{$product->name}}</a></h6>
                            <div class="product__item__price">
                                @if($product->sale_price > 0)
                                {{number_format($product->sale_price)}} đ
                                <del class="ml-2 text-secondary">{{number_format($product->price)}} đ</del>
                                @else
                                    {{number_format($product->price)}} đ
                                @endif
                            </div>
                            <div class="cart_add">
                                <a href="{{route('cart.add',$product->id)}}" id="add-to-cart">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="m-auto">
                {{$products->appends(request()->all())->links()}}
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#category").change(function(){
                var category = $(this).val();
                var url = location.href + '?category=' + category;
                $.ajax({
                    url : url,
                    type : "GET",
                    success : function(res){
                        $("#products").load(url + " #products>*");
                    }
                });
            });

            $(document).on("click","#add-to-cart",function(e){
                e.preventDefault();
                var href = $(this).attr("href");
                $.ajax({
                    url : href,
                    type : "GET",
                    success : function(res){
                        if(res.status==true){
                            Swal.fire({
                                icon : 'success',
                                html : "Đã thêm vào giỏ hàng"
                            });
                            $(".header__top__right__cart").load(location.href + " .header__top__right__cart>*");
                        }
                    }
                });
            });

            $("#sort").change(function(){
                var sort = $(this).val();
                var url = location.href + '?sort=' + sort;
                $.ajax({
                    url : url,
                    type : "GET",
                    success : function(res){
                        $("#products").load(url + " #products>*");
                    }
                });
            });

            $(document).on('click','.pagination a',function(e){
                e.preventDefault();
                var href = $(this).attr('href');
                $.ajax({
                    url : href,
                    type : "GET",
                    success : function(res){
                        $("#products").load(href + " #products>*");
                        $("html, body").animate({scrollTop : 300},800);
                    }
                });
            });

            $(".btn-search").click(function(e){
                e.preventDefault();
                var search = $("input[name='search']").val();
                var url = location.href + "?search=" + search;
                console.log(url);
                $.ajax({
                    url : url,
                    type : "GET",
                    success : function(res){
                        $("#products").load(url + " #products>*");
                    }
                });
            });
        });
    </script>
@endsection