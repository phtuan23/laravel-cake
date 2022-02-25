<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Anh Tuấn" />
    <!-- Favicon icon -->

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{url('public/admin')}}/assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{url('public/admin')}}/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{url('public/admin')}}/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{url('public/admin')}}/assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{url('public/admin')}}/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{url('public/admin')}}/assets/css/style.css">
    <style>
        .spinner-border{
            width:20px;
            height:20px;
        }
    </style>
</head>

<body themebg-pattern="theme1">

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material" method="post">
                        @csrf
                        <div class="text-center">
                            <img src="{{url('public/admin')}}/assets/images/logo.png" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Đăng nhập</h3>
                                        
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="name" class="form-control" value="admin" placeholder="Tên tài khoản" autocomplete="off">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" value="123456" placeholder="Mật khẩu" autocomplete="off">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" name="remember">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Ghi nhớ tài khoản</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" id="btn-submit">ĐĂNG NHẬP</button>
                                    </div>
                                    <h6>Tài khoản đăng nhập : admin</h6> <br/>
                                    <h6>Mật khẩu : 123456</h6>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" href="{{url('public/admin')}}/assets/js/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" href="{{url('public/admin')}}/assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" href="{{url('public/admin')}}/assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" href="{{url('public/admin')}}/assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            $(".form-material").submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var spinner = '<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>';
                $("#btn-submit").html(spinner);
                $.ajax({
                    url : location.href,
                    type : "POST",
                    data : data,
                    success : function(res){
                        if(res.status==false){
                            Swal.fire({
                                icon: res.icon,
                                title: res.title,
                                html: res.message
                            });
                        }else{
                            window.location = res.url
                        }
                        $("#btn-submit").text("ĐĂNG NHẬP");
                    }
                })
            })
        });
    </script>
</body>
</html>