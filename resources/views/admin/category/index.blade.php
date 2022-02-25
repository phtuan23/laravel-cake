@extends('layouts.admin')
@section('title','Danh mục')
@section('main')
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body p-0">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Basic table card start -->
                <div class="card">
                    <h4 class="p-2"><i class="fas fa-list"></i> @yield('title')</h4>
                    <div class="card-header">
                        <form class="form-inline" id="form-search">
                            <div class="form-group mr-1">
                                <input type="text" name="search" class="form-control" placeholder="Search...">
                            </div>
                            <button class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                            <a href="{{route('category.create')}}" class="btn btn-success btn-sm ml-2"> Thêm mới</a>
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
                    <div class="card-block table-border-style" id="list-category">
                        <div class="table-responsive">
                            <table class="table" >
                                <thead>
                                    <tr class="text-center">
                                        <th width="60" class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">DANH MỤC</th>
                                        <th class="font-weight-bold" width="150">SỐ SẢN PHẨM</th>
                                        <th class="font-weight-bold">TRẠNG THÁI</th>
                                        <th class="font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                    <tr class="text-center">
                                        <td>{{$cat->id}}</td>
                                        <td>{{$cat->name}}</td>
                                        <td>{{$cat->products()->count()}}</td>
                                        <td>
                                            @if($cat->status==1)
                                            <span class="badge badge-success">Hiển thị</span>
                                            @else
                                            <span class="badge badge-danger">Ẩn</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="{{route('category.edit',$cat->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('category.destroy',$cat->id)}}" class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{$categories->appends(request()->all())->links()}}
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
        $(document).on('click','.btn-delete',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Bạn có chắc muốn xóa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 51, 51)',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : href,
                        method : "DELETE",
                        data : {_token : "{{csrf_token()}}"},
                        success : function(res){
                            if(res.status==false){
                                Swal.fire({
                                    icon : 'warning',
                                    html : 'Không thể xóa danh mục hiện tại'
                                });
                            }else{
                                $("#list-category").load(location.href + " #list-category>*");
                                Swal.fire({
                                    icon : 'success',
                                    html : 'Đã chuyển vào thùng rác'
                                });
                            }
                        }
                    });
                }
            });
        });


        $(document).on('submit','#form-search',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = location.href + "?" + data;
            $.ajax({
                url : url,
                type : 'GET',
                success : function (res){
                    $("#list-category").load(url + " #list-category>*");
                }
            });
        });

        $(document).on('click','.pagination a',function (e){
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url : href,
                type : 'GET',
                success : function (res){
                    $("#list-category").load(href + " #list-category>*");
                }
            });
        });
    });
</script>
@endsection