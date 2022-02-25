@extends('layouts.main')
@section('title','Shop')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <br>
            <section class="mb-5 text-center">

                <h4><i class="fa fa-edit"></i> ĐỔi mật khẩu</h4>
                <br>
                <form role="form" action="{{route('cus.password',$customer->id)}}" method="post">
                    @csrf @method('put')
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-control-label">Mật khẩu hiện tại*</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="password" name="cr_password">
                            @error('cr_password')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-control-label">Mật khẩu mới*</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="password" name="password">
                            @error('password')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-control-label">Xác nhận mật khẩu mới*</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="password" name="cf_password">
                            @error('cf_password')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row text-right">
                        <label class="col-lg-4 col-form-label form-control-label"></label>
                        <div class="col-lg-8">
                            <button class="btn btn-success btn-change-password">Đổi mật khẩu</button>
                            <input type="reset" class="btn btn-secondary" value="Cancel">
                        </div>
                    </div>
                    <div class="text-right">
                    <u><a href="{{route('cus.profile')}}"><i class="fa fa-arrow-left"></i>  Quay lại</a></u>
                </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(".btn-change-password").click(function(e){
                e.preventDefault();
                var data = $(this).closest("form").serialize();
                var url = $(this).closest("form").attr("action");
                $.ajax({
                    url : url,
                    type : "POST",
                    data : data,
                    success : function(res){
                        console.log(res);
                        if(res.status==false){
                            Swal.fire({
                                icon : res.icon,
                                html : res.message
                            });
                        }else{
                            window.location = res.url
                        }
                        
                    }
                });
            });
        }); 
    </script>
@endsection