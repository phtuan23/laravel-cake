<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cake</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{url('public/main')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link rel="stylesheet" href="{{url('public/main')}}/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/main')}}/css/style.css" type="text/css">
    <style>
        .pagination {
            width: 300px;
            margin: 0 auto;
        }

        .pagination li {
            margin-right: 5px;
        }

        .pagination .page-item.active .page-link {
            background-color: #dfa974;
            border-color: #dfa974;
        }

        .pagination .page-link {
            color: #dfa974;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__cart">
            <div class="offcanvas__cart__links">
                <a href="#" class="search-switch"><img src="{{url('public/main')}}/img/icon/search.png"></a>
                @if(auth()->guard('cus')->check())
                <a href="{{route('cus.wishlist')}}"><img src="{{url('public/main')}}/img/icon/heart.png"></a>
                @endif
            </div>
            <div class="offcanvas__cart__item">
                <a href="{{route('cart.index')}}"><img src="{{url('public/main')}}/img/icon/cart.png"> <span id="total_item">{{count($cart->carts)}}</span></a>
                <div class="cart__price"><span>{{number_format($cart->total_price)}} đ</span></div>
            </div>
        </div>
        <div class="offcanvas__logo">
            <a href="{{route('cus.index')}}"><img id="logo" src="{{url('public/main')}}/img/logo.png"></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__option">
            <ul>
                @if(auth()->guard('cus')->check())
                <li>
                    <a href="{{route('cus.profile',['slug'=>Str::slug(auth()->guard('cus')->user()->name)])}}">{{auth()->guard('cus')->user()->name}}</a>
                    <ul>
                        <li><a href="{{route('cus.logout')}}" style="color:#fff">Đăng xuất</a></li>
                    </ul>
                </li>
                @else
                <li>
                    <a href="{{route('cus.login')}}" style="color:#fd7e14;font-weight:bold">Đăng nhập</a>
                    <a href="{{route('cus.register')}}" style="color:#fd7e14;font-weight:bold">Đăng ký</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__top__left">
                                <ul>
                                    @if(auth()->guard('cus')->check())
                                    <li>
                                        <a href="{{route('cus.profile',['slug'=>Str::slug(auth()->guard('cus')->user()->name)])}}">{{auth()->guard('cus')->user()->name}}</a>
                                        <ul>
                                            <li><a href="{{route('cus.logout')}}" style="color:#fff">Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{route('cus.login')}}" style="color:#fd7e14;font-weight:bold">Đăng nhập - </a>
                                        <a href="{{route('cus.register')}}" style="color:#fd7e14;font-weight:bold">Đăng ký</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="header__logo">
                                <a href="{{route('cus.index')}}"><img id="logo" src="{{url('public/main')}}/img/logo.png"></a>
                            </div>
                            <div class="header__top__right">
                                <div class="header__top__right__links">
                                    <a href="#" class="search-switch"><img src="{{url('public/main')}}/img/icon/search.png"></a>
                                    @if(auth()->guard('cus')->check())
                                    <a href="{{route('cus.wishlist')}}"><img src="{{url('public/main')}}/img/icon/heart.png"></a>
                                    @endif
                                </div>
                                <div class="header__top__right__cart">
                                    <a href="{{route('cart.index')}}"><img src="{{url('public/main')}}/img/icon/cart.png"> <span id="total_item">{{count($cart->carts)}}</span></a>
                                    <div class="cart__price"><span>{{number_format($cart->total_price)}} đ</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ Request::routeIs('cus.index') ? 'active' : '' }}"><a href="{{route('cus.index')}}">Trang chủ</a></li>
                            <li class="{{ Request::routeIs('cus.shop') ? 'active' : '' }}"><a href="{{route('cus.shop')}}">Cửa hàng</a></li>
                            <li class="{{ Request::routeIs('cus.about') ? 'active' : '' }}"> <a href="{{route('cus.about')}}">Về chúng tôi</a></li>
                            <li class="{{ Request::routeIs('cus.contact') ? 'active' : '' }}"><a href="{{route('cus.contact')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


    @yield('main')
    <!-- Instagram Section End -->

    <!-- Map End -->

    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="{{url('public/main')}}/img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Giờ làm việc</h6>
                        <ul>
                            <li>Thứ 2 - Thứ 6: 08:00 am – 08:30 pm</li>
                            <li>Thứ 7: 10:00 am – 16:30 pm</li>
                            <li>Chủ nhật: 10:00 am – 16:30 pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{url('public/main')}}/img/footer-logo.png"></a>
                        </div>
                        <p>Đăng ký để theo dõi những sản phẩm mới nhất</p>
                        <div class="footer__social">
                            <a><i class="fa fa-facebook"></i></a>
                            <a><i class="fa fa-twitter"></i></a>
                            <a><i class="fa fa-instagram"></i></a>
                            <a><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__newslatter">
                        <h6>Đăng ký</h6>
                        <p>Nhận những thông báo mới nhất</p>
                        <form action="#">
                            <input type="text" placeholder="Địa chỉ Email">
                            <button type="submit"><i class="fa fa-send-o"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Tìm kiếm....." name="search" autocomplete="off">
                <div class="list-group" id="result">

                </div>
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{url('public/main')}}/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{url('public/main')}}/js/bootstrap.min.js"></script>
    <script src="{{url('public/main')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{url('public/main')}}/js/jquery.barfiller.js"></script>
    <script src="{{url('public/main')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{url('public/main')}}/js/jquery.slicknav.js"></script>
    <script src="{{url('public/main')}}/js/owl.carousel.min.js"></script>
    <script src="{{url('public/main')}}/js/jquery.nicescroll.min.js"></script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{url('public/main')}}/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var _search = $(this).val();
                if (_search != '') {
                    $.ajax({
                        url: "{{route('cus.search')}}",
                        type: 'POST',
                        data: {
                            search: _search,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(res) {
                            $('#result').html(res);
                        }
                    });
                }
                if (_search == '') {
                    $('.item-result').hide();
                }
            });
        });
    </script>
    @if(Session::has('error'))
    <script>
        toastr.error("{{Session::get('error')}}", {
            timeOut: 3000
        });
    </script>
    @endif
    @if(Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            html: "{{Session::get('success')}}"
        });
    </script>
    @endif
    @yield('js')
</body>

</html>