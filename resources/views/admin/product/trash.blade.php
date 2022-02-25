@extends('layouts.admin')
@section('title','Thùng rác')
@section('main')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body p-0">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Basic table card start -->
                <div class="card">
                    <h4 class="p-3"><i class="fas fa-trash"></i> @yield('title')</h4>
                    @if($trashs->count() > 0)
                    <div class="card-header">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search_string" class="form-control" placeholder="Search...">
                            </div>
                            <button class="btn btn-info btn-sm ml-1"><i class="fa fa-search"></i></button>
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
                    <div class="card-block table-border-style" id="main-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th width="60" class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">TÊN SP</th>
                                        <th class="font-weight-bold">ẢNH </th>
                                        <th class="font-weight-bold">GIÁ</th>
                                        <th class="font-weight-bold">GIÁ KM</th>
                                        <th class="font-weight-bold">TRẠNG THÁI</th>
                                        <th class="font-weight-bold">DANH MỤC</th>
                                        <th class="font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trashs as $trash)
                                    <tr class="text-center">
                                        <td>{{$trash->id}}</td>
                                        <td>{{$trash->name}}</td>
                                        <td>
                                            <img src="{{url('public/upload')}}/{{$trash->image}}" width="60">
                                        </td>
                                        <td>{{number_format($trash->price)}}</td>
                                        <td>{{number_format($trash->sale_price)}}</td>
                                        <td>
                                            @if($trash->status==1)
                                            <span class="badge badge-success">Public</span>
                                            @else
                                            <span class="badge badge-danger">Private</span>
                                            @endif
                                        </td>
                                        <td>{{$trash->category->name}}</td>
                                        <td class="text-right">
                                            <a href="{{route('product.restore',$trash->id)}}" class="btn btn-sm btn-success btn-restore"><i class="ti-share-alt"></i></a>
                                            <a href="{{route('product.remove',$trash->id)}}" class="btn btn-sm btn-danger btn-remove"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{$trashs->appends(request()->all())->links()}}
                        </div>
                    </div>
                    @else 
                    <div class="p-3 text-center">
                        <h4>Không có dữ liệu</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $(document).on('click','.btn-restore',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Khôi phục dữ liệu?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 51, 51)',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : href,
                        type : 'GET',
                        success: function(res){
                            $("#main-content").load(location.href + " #main-content>*");
                            Swal.fire({
                                icon : 'success',
                                html : 'Đã khôi phục lại dữ liệu'
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click','.btn-remove',function(e){
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
                        type : 'GET',
                        success: function(res){
                            $("#main-content").load(location.href + " #main-content>*");
                            Swal.fire({
                                icon : 'success',
                                html : 'Đã xóa thành công'
                            });
                        }
                    });
                }
            });
        })
    });
</script>
@endsection