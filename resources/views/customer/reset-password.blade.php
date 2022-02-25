@extends('layouts.main')
@section('title','Forgot Password')
@section('main')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<style>
.fa-check-circle{
    font-size:60px;
    color: #5cb85c;
}
</style>
<div class="container" style="padding:60px 0 40px 0">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                    @if(Session::has('success'))
                    <div class="text-center text-success">
                        <strong>{{Session::get('success')}}</strong>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="text-center text-error">
                        <strong>{{Session::get('error')}}</strong>
                    </div>
                    @endif
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Quên mật khẩu?</h2>
                    <p>Bạn có thể lấy lại mật khẩu ở đây.</p>
                    <div class="panel-body">
                    @if(Session::has('success'))
                        <i class="fa fa-check-circle"></i>
                    @else
                        <form id="register-form" class="form" method="post" action="">
                        @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="email" name="email" placeholder="Địa chỉ email" class="form-control"  type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="recover-submit" class="btn btn-lg btn-success btn-block" value="Gửi mã xác nhận" type="submit">
                            </div>
                        </form>
                    @endif
                    </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
  @endsection