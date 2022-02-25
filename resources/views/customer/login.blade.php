@extends('layouts.main')
@section('title','Sign in')
@section('main')
<style>
    #logreg-forms {
        width: 412px;
        margin: 10vh auto;
        background-color: #f7fafc;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    #logreg-forms form {
        width: 100%;
        max-width: 410px;
        padding: 15px;
        margin: auto;
    }

    #logreg-forms .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    #logreg-forms .form-control:focus {
        z-index: 2;
    }

    #logreg-forms .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    #logreg-forms .form-signin input[type="password"] {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    #logreg-forms .social-login {
        width: 390px;
        margin: 0 auto;
        margin-bottom: 14px;
    }

    #logreg-forms .social-btn {
        font-weight: 100;
        color: white;
        width: 190px;
        font-size: 0.9rem;
    }

    #logreg-forms a {
        display: block;
        padding-top: 10px;
        color: lightseagreen;
    }

    #logreg-form .lines {
        width: 200px;
        border: 1px solid red;
    }


    #logreg-forms button[type="submit"] {
        margin-top: 10px;
    }

    #logreg-forms .facebook-btn {
        background-color: #3C589C;
    }

    #logreg-forms .google-btn {
        background-color: #DF4B3B;
    }

    #logreg-forms .form-reset,
    #logreg-forms .form-signup {
        display: none;
    }

    #logreg-forms .form-signup .social-btn {
        width: 210px;
    }

    #logreg-forms .form-signup input {
        margin-bottom: 2px;
    }

    .form-signup .social-login {
        width: 210px !important;
        margin: 0 auto;
    }

    /* Mobile */

    @media screen and (max-width:500px) {
        #logreg-forms {
            width: 300px;
        }

        #logreg-forms .social-login {
            width: 200px;
            margin: 0 auto;
            margin-bottom: 10px;
        }

        #logreg-forms .social-btn {
            font-size: 1.3rem;
            font-weight: 100;
            color: white;
            width: 200px;
            height: 56px;

        }

        #logreg-forms .social-btn:nth-child(1) {
            margin-bottom: 5px;
        }

        #logreg-forms .social-btn span {
            display: none;
        }

        #logreg-forms .facebook-btn:after {
            content: 'Facebook';
        }

        #logreg-forms .google-btn:after {
            content: 'Google+';
        }

    }
</style>

<div id="logreg-forms">
    @if(Session::has('success'))
    <div class="alert alert-danger text-center" role="alert">
        {{Session::get('success')}}
    </div>
    @endif
    <form class="form-signin" method="post" action="">
        @csrf
        @if(Session::has('error'))
        <div class="alert alert-danger text-center" role="alert">
            {{Session::get('error')}}
        </div>
        @endif
        <h1 class="h3 mb-3 font-weight-bold" style="text-align: center;color:#fd7e14"> Đăng nhập</h1>
        <input type="text" name="email" class="form-control" placeholder="Địa chỉ Email" id="email" value="{{old('email')}}">
            @error('email')
            <small class="help-block text-danger" id="err_email">{{$message}}</small>
            @enderror
        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" id="password" value="{{old('password')}}">
            @error('password')
            <small class="help-block text-danger" id="err_pass">{{$message}}</small>
            @enderror
        <br>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input mr-2" type="checkbox" name="remember">
            </label>
            <h6>Ghi nhớ mật khẩu</h6>
        </div>
        <br>
        <br>
        <button class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
        <a href="{{route('password.reset')}}">Quên mật khẩu?</a>
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <a href="{{route('cus.register')}}" class="btn btn-info btn-block text-light"><i class="fa fa-user-plus"></i> Đăng ký tài khoản</a>
    </form>
</div>
<script src="{{url('public/main')}}/js/jquery-3.3.1.min.js"></script>
<script>
    $('#email').keyup(function(){
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        if(isEmail($('#email').val())==true){
            $(this).css('border-color','green');
        }else{
            $(this).css('border-color','red');
        }
    });
    $('#password').keyup(function(){
        $('#password').css('border-color','green');
        if($('#password').val()==''){
            $(this).css('border-color','red');
        }
    });
</script>
@error('email')
    <script>
        $('#email').css('border-color','red');
        $('#email').css('margin-bottom','5px');
        $('#email').keyup(function(){
            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
            if(isEmail($('#email').val())==true){
                $(this).css('border-color','green');
                $('#err_email').hide();
            }
        });
    </script>
@enderror
@error('password')
    <script>
        $('#password').css('border-color','red');
        $('#password').css('margin-top','5px');
        $('#password').css('margin-bottom','5px');
        $('#password').keyup(function(){
            $('#password').css('border-color','green');
            $('#err_pass').hide();
        });
    </script>
@enderror
@endsection