@extends('layouts.admin')
@section('title','Chỉnh sửa tài khoản')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-address-card"></i> Quản lý tài khoản</h3>
                    <span>@yield('title')</span>
                </div>
                <div class="card-block">
                    <form action="{{route('account.update',$account->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Tên đăng nhập</label>
                                    <input type="text" name="name" class="form-control" value="{{$account->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$account->email}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Xác nhận mật khẩu</label>
                                    <input autocomplete="off" type="password" name="cf_password" class="form-control" placeholder="Xác nhận mật khẩu">
                                </div>
                            </div>
                            <div class="form-group ml-3">
                                <div class="form-group">
                                    <button class="btn btn-sm btn-success mt-4 btn-save"><i class='fas fa-check-circle'></i>Lưu</button>
                                    <a href="{{route('account.index')}}" class="btn btn-sm btn-info mt-4"><i class="fa fa-window-close"></i>hủy</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Basic Form Inputs card end -->
        </div>
    </div>
</div>

@stop()

@section('js')
    <script>
        $(document).ready(function(){
            $(".btn-save").click(function(e){
                e.preventDefault();
                var data = $(this).closest('form').serialize();
                var url = $(this).closest('form').attr("action");
                $.ajax({
                    url : url,
                    type : "POST",
                    data : data,
                    success : function(res){
                        if(res.status==false){
                            Swal.fire({
                                title: res.title,
                                html: res.message,
                                icon: res.icon
                            });
                        }else{
                            window.location = "{{route('account.index')}}"
                        }
                    }
                })
            })
        })
    </script>
@endsection