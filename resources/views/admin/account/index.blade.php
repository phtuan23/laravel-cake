@extends('layouts.admin')
@section('title','Tài khoản quản trị')
@section('main')
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body p-0">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Basic table card start -->
                <div class="card">
                    <h4 class="p-3"><i class="fas fa-user"></i> @yield('title')</h4>
                    <div class="card-header">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                            <button class="btn btn-primary btn-sm btn-search"><i class="fa fa-search"></i></button>
                            <a href="{{route('account.create')}}" class="btn btn-success btn-sm ml-2">THÊM MỚI</a>
                        </form>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-trash close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive" id="data">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th width="60" class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">TÊN ĐĂNG NHẬP</th>
                                        <th class="font-weight-bold">EMAIl</th>
                                        <th class="font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $acc)
                                    <tr class="text-center">
                                        <td>{{$acc->id}}</td>
                                        <td>{{$acc->name}}</td>
                                        <td>{{$acc->email}}</td>
                                        <td class="text-right">
                                            <a href="{{route('account.edit',$acc->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            @if(auth()->user()->id!=$acc->id)
                                            <a href="{{route('account.destroy',$acc->id)}}" class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="clearfix">
                            {{$accounts->appends(request()->all())->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            // delete
            $(document).on('click',".btn-delete",function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý!',
                    cancelButtonText: 'Hủy'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : url,
                            type : 'GET',
                            success: function(res){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Xóa thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#data").load(location.href + " #data>*");
                            }
                        })
                    }
                });
            });

            // search

            $(document).on('click',".btn-search",function(e){
                e.preventDefault();
                var search = $("input[name='search']").val();
                var url = location.href + "?search=" + search;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(res){
                        $("#data").load(url + " #data>*");
                    }
                })
            })
        });
    </script>
@endsection