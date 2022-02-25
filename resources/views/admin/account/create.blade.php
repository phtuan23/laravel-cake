@extends('layouts.admin')
@section('title','Thêm mới tài khoản')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-address-card"></i> Quản lý tài khoản quản trị</h3>
                    <span>@yield('title')</span>
                </div>
                <div class="card-block">
                    <form action="{{route('account.store')}}" method="POST" enctype="multipart/form-data" id="addform">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Tên đăng nhập</label>
                                    <input autocomplete="off" type="text" name="name" class="form-control" placeholder="NHẬP TÊN ĐĂNG NHẬP">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Email</label>
                                    <input autocomplete="off" type="text" name="email" class="form-control" placeholder="NHẬP EMAIl">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Mật khẩu</label>
                                    <input autocomplete="off" type="password" name="password" class="form-control" placeholder="NHẬP MẬT KHẨU">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Xác nhận mật khẩu</label>
                                    <input autocomplete="off" type="password" name="cf_password" class="form-control" placeholder="XÁC NHẬN MẬT KHẨU">
                                </div>
                            </div>
                            <div class="form-group ml-3">
                                <button class="btn btn-sm btn-success mt-4 btn-save"><i class='fas fa-check-circle'></i>Lưu</button>
                                <button type="button" class="btn btn-sm btn-secondary mt-4" onclick="document.getElementById('addform').reset();return false"><i class='fas fa-redo'></i>Làm mới</button>
                                <a href="{{route('account.index')}}" class="btn btn-sm btn-info mt-4"><i class="fa fa-window-close"></i>Hủy</a>
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
                var data = $("#addform").serialize();
                var url = $("#addform").attr("action");
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